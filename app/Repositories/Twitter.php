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
        $contenedorJSON = "";
        $count = 0;
        
        do {
            $url = 'https://api.twitter.com/1.1/search/tweets.json';
            if ($lastIdTweet == "") {
                $getfield = '?geocode=' . $lat . ',' . $lon . ',' . $radio . '&count=100';
            } else {
                $getfield = '?geocode=' . $lat . ',' . $lon . ',' . $radio . '&max_id=' . ($lastIdTweet) . "&count=100";
            }

            $requestMethod = 'GET';
            $twitter = new TwitterAPIExchange($this->oauth);
            $json = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();

            $contenedorJSON[$count] = $json;

            $count++;
            $pages--;
        } while ($pages > 0);
        
        return $contenedorJSON;
    }

    function getInfoTwitter($contenedorJson) 
    {
        //Make data
        $rawdata = [];
        $rawdata[0]["fetch"] = "Mon May 06 20:01:29 +0000 2019";
        $rawdata[0]["image"] = "<a href=\"https://twitter.com/TwitterDev\" target=\"_blank\">"
                . "<img src=\"https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg\"></a>";
        $rawdata[0]["image_url"] = "https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg";
        $rawdata[0]["name"] = "<a target=\"_blank\" href=\"http://www.twitter.com/TwitterDev\">@TwitterDev</a>";
        $rawdata[0]["tweet"] = "Todays new update means that you can finally add Pizza Cat to your Retweet with comments! "
                . "Learn more about this ne… https://t.co/Rbc9TF2s5X";
        $rawdata[0]["latitud"] = "13.7467";
        $rawdata[0]["longitud"] = "100.5315";

        $rawdata[1]["fetch"] = "Mon May 06 20:01:29 +0000 2019";
        $rawdata[1]["image"] = "<a href=\"https://twitter.com/TwitterDev\" target=\"_blank\">"
                . "<img src=\"https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg\"></a>";
        $rawdata[1]["image_url"] = "https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg";
        $rawdata[1]["name"] = "<a target=\"_blank\" href=\"http://www.twitter.com/TwitterDev\">@TwitterDev1</a>";
        $rawdata[1]["tweet"] = "Test 1";
        $rawdata[1]["latitud"] = "13.7469";
        $rawdata[1]["longitud"] = "100.5350";
        
        $rawdata[2]["fetch"] = "Mon May 06 20:01:29 +0000 2019";
        $rawdata[2]["image"] = "<a href=\"https://twitter.com/TwitterDev\" target=\"_blank\">"
                . "<img src=\"https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg\"></a>";
        $rawdata[2]["image_url"] = "https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg";
        $rawdata[2]["name"] = "<a target=\"_blank\" href=\"http://www.twitter.com/TwitterDev\">@TwitterDev2</a>";
        $rawdata[2]["tweet"] = "Terminal 21";
        $rawdata[2]["latitud"] = "13.7379";
        $rawdata[2]["longitud"] = "100.5605";
        
        $rawdata[3]["fetch"] = "Mon May 06 20:01:29 +0000 2019";
        $rawdata[3]["image"] = "<a href=\"https://twitter.com/TwitterDev\" target=\"_blank\">"
                . "<img src=\"https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg\"></a>";
        $rawdata[3]["image_url"] = "https://pbs.twimg.com/profile_images/880136122604507136/xHrnqf1T_normal.jpg";
        $rawdata[3]["name"] = "<a target=\"_blank\" href=\"http://www.twitter.com/TwitterDev\">@TwitterDev3</a>";
        $rawdata[3]["tweet"] = "Siriraj Piyamaharajkarun Hospital";
        $rawdata[3]["latitud"] = "13.7599";
        $rawdata[3]["longitud"] = "100.4859";
        
        return $rawdata;
        
        $count = 0;
        $rawdata = [];
        $json = [];
         
        for ($i = 0; $i < count($contenedorJson); $i++) {
            $json = json_decode($contenedorJson[$i]);
            $num_items = count($json->statuses);
            
            for ($j = 0; $j < $num_items; $j++) {
                $user = $json->statuses[$j];
                $url_image = $user->user->profile_image_url_https; 
                $screen_name = $user->user->screen_name; 
                $image = "<a href='https://twitter.com/" . $screen_name . "' target=_blank><img src=" . $url_image . "></img></a>";
                $tweet = isset($user->text) && !empty($user->text) ? $this->filter_tweet($user->text) : $user->text; 

                if (!empty($user->geo->coordinates[0])) {
                    $latitud = $user->geo->coordinates[0];
                    $longitud = $user->geo->coordinates[1];
                } else {
                    $latitud = 0;
                    $longitud = 0;
                }

                $rawdata[$count]["fetch"] = $user->created_at;
                $rawdata[$count]["image"] = $image;
                $rawdata[$count]["image_url"] = $url_image;
                $rawdata[$count]["name"] = "<a target=\"_blank\" href=\"http://www.twitter.com/$screen_name\">@$screen_name</a>";
                $rawdata[$count]["tweet"] = $tweet;
                $rawdata[$count]["latitud"] = $latitud;
                $rawdata[$count]["longitud"] = $longitud;
                $count++;
            }
        }
        
        return $rawdata;
    }

    function getCoordinates($city) 
    {
        $url = 'http://api.openweathermap.org/data/2.5/find?q=$city';
        $getfield = '?q=' . $city;

        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($this->oauth);
        $html = $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();

        $json = json_decode($html);
        $lat = $json->list[0]->coord->lat;
        $lon = $json->list[0]->coord->lon;

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
