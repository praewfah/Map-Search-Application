<?php

namespace App\Http\Controllers;

use App\Tweets;
use Illuminate\Http\Request;

use App\Repositories\Twitter;
use App\Repositories\TwitterAPIExchange;

class TweetsController extends Controller
{
    const RADIUS = "50km";
    const LIMIT = 200;

    public $city;
    
    public function __construct()
    {
        $this->city = isset($_GET["city"]) ? $_GET["city"] : null;  
    }
    
    public function index()
    {
        $content = null;
        $twitter = new Twitter(config('app.twitter')); // init oauth

        $histories = $this->getHistory($this->city);
        if ($histories) { // not over 1 hour.
            $content[] = $histories->tweets_data;
            $coor = [
                'latitud' => $histories->latitude, 
                'longitud' => $histories->longitude
            ];
        } 
        
        if (!isset($content) || empty($content)){ // get new from API
            $coor = $twitter->getCoordinates($this->city);
            $content = $twitter->getJsonGeoTweets($coor["latitud"], $coor["longitud"], self::RADIUS, self::LIMIT);
            
            // re-cache
            $this->delete(); 
            $this->create($coor, $content); 
        }
        
        $data = $twitter->getInfoTwitter($content); //phares Json
        
        return [
            'data' => $data,
            'coor' => $coor,
            'beaches' => $this->setBeaches($data)
        ];
    }
 
    public function getHistories(){
        return Tweets::select('city')
                ->orderBy('created_at', 'desc')
                ->limit(15)
                ->get();
    }

    private function getHistory() 
    {
        $content = false;
        $histories = Tweets::select('tweets_data', 'latitude', 'longitude')
                ->where([['city', '=', $this->city]])
                ->whereRaw("(created_at > (convert_tz(NOW(), '+00:00', '+07:00')) - INTERVAL 1 HOUR)") 
                ->get();
        
        foreach ($histories as $row) {
            if (isset($row->tweets_data) && !empty($row->tweets_data)) {
                $content = new \stdClass();
                $content->latitude = $row->latitude;
                $content->longitude = $row->longitude;
                $content->tweets_data = base64_decode($row->tweets_data);
            } 
        }
        
        return $content;
    }
    
    private function create($coor, $content) {
        return Tweets::create([ //store
                'city' => $this->city,
                'created_at' => date('Y-m-d H:i:s'),
                'latitude' => isset($coor["latitud"]) ? $coor["latitud"] : 0,
                'longitude' => isset($coor["longitud"]) ? $coor["longitud"] : 0,
                'tweets_data' => $content
            ]);
    }
    
    private function delete() {
        return Tweets::where('city', $this->city)
                ->delete(); 
    }

    private function setBeaches($data)
    {
        $beaches = [];
        for ($i = 0; $i < count($data); $i++) {
            $latitud = str_replace(",", ".", $data[$i]["latitud"]);
            $longitud = str_replace(",", ".", $data[$i]["longitud"]);
            $name = str_replace("'", "", $data[$i]["name"]);
            
            if ($latitud == 0 && $longitud == 0) {
                continue;
            } else {
                $beaches[] = [$name, $latitud, $longitud, $i];
            }
        }
        return $beaches;
    }
 
}