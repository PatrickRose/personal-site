<?php

namespace PatrickRose\Http\Controllers;

use Illuminate\Http\Request;

use PatrickRose\Http\Requests;

class StaticPagesController extends Controller
{
    public function homePage()
    {
        return \View::make("staticpages.home", ['blogs' => []]);
    }

    public function aboutPage()
    {
        return \View::make('staticpages.about');
    }

    public function gigPage()
    {
        return \View::make('staticpages.gigs', []);
    }

    public function feedPage()
    {
        return \Response::view('staticpages.rss', compact("blogs"), 200)->header("Content-Type", "application/atom+xml; charset=UTF-8");
    }
}
