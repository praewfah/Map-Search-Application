<?php

namespace App\Repositories;

use App\Repositories\TwitterAPIExchange;

class Twitter 
{
    /**
     * @var string
     */
    private $oauth;

    public function __construct(array $settings)
    {
        $this->oauth = $settings;
    }
    
    function getJsonGeoTweets($lat, $lon, $radio, $num_tweets)
    {
        $pages = (int) $num_tweets / 100;
        $lastIdTweet = "";
        $contenedorJSON = [];
        $count = 0;
        
        do {
            $url = 'https://api.twitter.com/1.1/search/tweets.json';
            if ($lastIdTweet == "") {
                $getfield = '?geocode=' . $lat . ',' . $lon . ',' . $radio . '&count=100';
            } else {
                $getfield = '?geocode=' . $lat . ',' . $lon . ',' . $radio . '&max_id=' . ($lastIdTweet) . "&count=100";
            }

            $requestMethod = 'GET';
            $twitter = new TwitterAPIExchange($this->oauth['twitter']);
            $json = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();
            
            $contenedorJSON[$count] = $json;

            $count++;
            $pages--;
        } while ($pages > 0);
        
        return $contenedorJSON;
    }

    function getInfoTwitter($city, $contenedorJson) 
    {
        $count = 0;
        $rawdata = $json = [];
         
        for ($i = 0; $i < count($contenedorJson); $i++) {
            $json = json_decode($contenedorJson[$i]);
            $num_items = count($json->statuses);
            
            for ($j = 0; $j < $num_items; $j++) {
                $user = $json->statuses[$j];
                
                $url_image = $user->user->profile_image_url_https; 
                $screen_name = $user->user->screen_name; 
                $image = "<a href='https://twitter.com/".$screen_name."' target=_blank><img src=".$url_image."></img></a>"; 

                $shape = [];
                if (!empty($user->place->bounding_box->coordinates)) {
                    foreach ($user->place->bounding_box->coordinates as $coordinates) {
                        $coord = '';
                        if (count($coordinates))
                            foreach ($coordinates as $coordinate) {
                                $longitud = $coordinate[0];
                                $latitud = $coordinate[1];
                                $coord .= $coordinate[1] . ', ' . $coordinate[0];
                            }
                    }
                    $shape['coord'] = rtrim($coord, ', ');
                    $shape['type'] = $user->place->bounding_box->type;
                } else {
                    $latitud = 0;
                    $longitud = 0;
                }

                $rawdata[$count]["city"] = $city;
                $rawdata[$count]["fetch"] = $user->created_at;
                $rawdata[$count]["image"] = $image;
                $rawdata[$count]["image_url"] = $url_image;
                $rawdata[$count]["name"] = "<a target=\"_blank\" href=\"http://www.twitter.com/$screen_name\">@$screen_name</a>";
                $rawdata[$count]["tweet"] = !empty($user->text) ? $this->filter_tweet($user->text) : $user->text; ;
                $rawdata[$count]["latitud"] = $latitud;
                $rawdata[$count]["longitud"] = $longitud;
                $rawdata[$count]["shape_coord"] = !empty($shape['coord']) ? $shape['coord'] : '';
                $rawdata[$count]["shape_type"] =  !empty($shape['type']) ? $shape['type'] : '';
                
                $count++;
            }
        }
       
        return $rawdata;
    }

    function getCoordinates($city) 
    {
        $html = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='. $city .'&APPID='. $this->oauth['owm_appid']);
        $json = json_decode($html);
        
        $lat = $json->coord->lat;
        $lon = $json->coord->lon;

        $coor["latitud"] = $lat;
        $coor["longitud"] = $lon;
           
        return $coor;
    }
    
    function filter_tweet($tweet) 
    {
        $tweet = str_replace("'", "", $tweet);
        $tweet = str_replace("\n", "", $tweet);

        return $tweet ;
    }

}
