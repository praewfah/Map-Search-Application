<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    protected $fillable = [
        'city', 
        'fetch', 
        'image', 
        'image_url', 
        'name', 
        'tweet', 
        'latitud',
        'longitud',
        'created_at', 
    ];
}
