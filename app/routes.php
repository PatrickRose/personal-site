<?php

Route::resource('sessions', 'SessionsController', array("only" => array("create", "store")));
Route::resource('blog', 'BlogsController');

Route::get('login', array(
    'uses' => 'SessionsController@create',
    'as' => 'login',
    'before' => 'guest'
));

Route::get('logout', array(
    'uses' => 'SessionsController@destroy',
    'as' => 'logout',
    'before' => 'auth'
));

Route::get('/', array(
    'uses' => 'StaticPagesController@homePage',
    'as' => 'home'
));

Route::get('admin', array(
    'uses' => 'StaticPagesController@homePage',
    'as' => 'admin'
));