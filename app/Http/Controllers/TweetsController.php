<?php

namespace App\Http\Controllers;

use App\Tweets;
use App\History;
use Illuminate\Http\Request;

use App\Repositories\Twitter;
use App\Repositories\TwitterAPIExchange;

class TweetsController extends Controller
{
    public function index()
    {
        if(isset($_GET["city"])){
            $city = $_GET["city"];
        } else {
            $city = "Bangkok";
        }
        
        $twitter = new Twitter(config('app.twitter')); // oauth
        $histories = $this->getHistory($city);
                
        if($histories->count()) { // not over 1 hour.
            foreach ($histories as $row) {
                $latitud = $row->latitude;
                $longitude = $row->longitude;
                $contenedorJSON[] = base64_decode($row->tweets);
            }
            
            $coor = ['latitud'=>$latitud,'longitud'=>$longitude];
            
        } else { // get new from API
            
            $coor = $twitter->getCoordinates($city);
            $contenedorJSON = $twitter->getJsonGeoTweets($coor["latitud"], $coor["longitud"], "50km", 200);
            
            //store
            //Tweets::replicating();
        }
        
        $data = $twitter->getInfoTwitter($contenedorJSON);
        
        return [
            'data' => $data,
            'coor' => $coor,
            'beaches' => $this->setBeaches($data)
        ];
    }
 
    private function getHistory($city) {
        return History::select('tweets', 'latitude', 'longitude')
                ->where([['city', '=', $city]])
                ->whereRaw("(created_at > (convert_tz(NOW(), '+00:00', '+07:00')) - INTERVAL 1 HOUR)") // time zone TH
                ->get();
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
