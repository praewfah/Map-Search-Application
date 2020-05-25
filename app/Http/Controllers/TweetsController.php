<?php

namespace App\Http\Controllers;

use App\Tweets;
use App\Histories;
use Illuminate\Http\Request;

use App\Repositories\Twitter;
use App\Repositories\TwitterAPIExchange;

class TweetsController extends Controller
{
    const RADIUS = "5km";
    const LIMIT = 50;

    public $city;
    
    public function __construct()
    {
        $this->city = isset($_GET["city"]) ? $_GET["city"] : null;  
    }
    
    public function index()
    {
        $content = null;
        $settings= [
            'twitter' => config('app.twitter'),
            'owm_appid' => config('app.owm_appid')
        ];
        
        $twitter = new Twitter($settings); // init oauth

        $histories = $this->getHistory($this->city);
        if ($histories) { 
            $data = $histories->tweets->data;
            $coor = [
                'latitud' => $histories->latitude, 
                'longitud' => $histories->longitude
            ];
        } 
        
        // get new data from API
        if (!isset($content) || empty($content)) { 
            $coor = $twitter->getCoordinates($this->city);
            $content = $twitter->getJsonGeoTweets($coor["latitud"], $coor["longitud"], self::RADIUS, self::LIMIT);
            $data = $twitter->getInfoTwitter($this->city, $content); 

            // re-cache
            $this->deleteHistory(); 
            $this->addHistory($coor, $data); 
        }
        
        return [ 'data' => $data, 'coor' => $coor, 'beaches' => $this->setBeaches($data) ];
    }
 
    public function getHistories(){
        return Histories::select('city')
                ->orderBy('created_at', 'desc')
                ->limit(15)
                ->get();
    }

    private function getHistory() 
    {
        $content = false;
        $histories = Histories::select('latitude', 'longitude', 'city')
                ->where([['city', '=', $this->city]])
                ->whereRaw("(created_at > (convert_tz(NOW(), '+00:00', '+07:00')) - INTERVAL 1 HOUR)") 
                ->get();
        
        foreach ($histories as $row) {
            $tweets = Tweets::where([['city', '=', $row->city]])->get();
            $content = new \stdClass();
            $content->city = $row->city;
            $content->latitude = $row->latitude;
            $content->longitude = $row->longitude;
            
            $content->tweets = new \stdClass();
            foreach ($tweets as $key => $tweet) {
                $content->tweets->data[$key] = $tweet;
            } 
        }
        
        return $content;
    }
    
    private function addHistory($coor, $content) 
    {
        if (Histories::create([ //store
            'city' => $this->city,
            'created_at' => date('Y-m-d H:i:s'),
            'latitude' => isset($coor["latitud"]) ? $coor["latitud"] : 0,
            'longitude' => isset($coor["longitud"]) ? $coor["longitud"] : 0,
        ])) {
            return Tweets::insert($content);
        }
        
        return (false);
    }
    
    private function deleteHistory() 
    {
        //echo $this->city ; die();
        if (Histories::where('city', $this->city)->delete())
            return Tweets::where('city', $this->city)->delete(); 
        
        return (false);
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
                $beaches[] = [
                    'name'=>$name, 
                    'latitud'=>$latitud, 
                    'longitud'=>$longitud, 
                    'zIndex'=>$i,
                    'shape_coord'=>$data[$i]["shape_coord"],
                    'shape_type'=>$data[$i]["shape_type"],
                ];
            }
        }
        return $beaches;
    }
 
}