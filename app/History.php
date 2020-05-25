<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'city', 
        'created_at', 
        'latitude', 
        'longitude'
        ];
}
