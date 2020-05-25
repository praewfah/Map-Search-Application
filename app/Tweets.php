<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    protected $fillable = [
        'city', 
        'created_at', 
        'tweet_content', 
        'tweet_time', 
        'tweet_owner', 
        'tweet_profile_img', 
        'tweet_other'
    ];
    
}
