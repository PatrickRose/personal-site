<?php

Route::get('blog/feed', [ "as" => "rss",
                     "uses" => "StaticPagesController@feedPage"]);

Route::resource('sessions', 'SessionsController', array("only" => array("create", "store")));
Route::resource('blog', 'BlogsController');

Route::get('tag/{tag}', array(
    'uses' => 'BlogsController@tagged',
    'as' => 'blog.tag'
));
Route::get("tag", array(
    'uses' => 'TagsController@index',
    'as' => 'tag.index'
));

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

Route::get('about', array(
    'uses' => 'StaticPagesController@aboutPage',
    'as' => 'about'
));

Route::resource('gigs', 'GigsController');
