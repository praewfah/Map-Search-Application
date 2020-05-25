<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    protected $fillable = [
        'city', 
        'created_at', 
        'latitude', 
        'longitude',
        'tweets_data'
    ];
}
