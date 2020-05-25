<?php

Use App\Map;
use Illuminate\Http\Request;

Route::view('/{path?}', 'app');

//Route::group(['middleware' => ['web']], function () {
//    Route::get('/', 'Controller@index');
//});