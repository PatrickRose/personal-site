@extends('layouts.master')

@section('title')
    Home Page
@stop

@section('content')
    <div class="home-page">
        <div class="header">
            <h1>
                Patrick Rose <br />
                <small>
                    Singer, Guitarist, Caller<br />
                    <a href="mailto:whoelse@patrickrosemusic.co.uk">whoelse@patrickrosemusic.co.uk</a>
                </small>
            </h1>
        </div>
    </div>
    <div class="home-text">
        <p class="home-lead">
            Welcome to the website of the Sheffield based folk musician Patrick Rose
        </p>

        <div class="row">
            <div class="col-md-4">
                <div class="header">
                    <h4>
                        About Patrick
                    </h4>
                </div>
                <div class="home-info">
                    <p>
                        A self taught singer, who's guitar playing has been described as "soothing" and music
                        called "Yorkshire bred if not Yorkshire born".
                    </p>
                    <p>
                        He is well known on the Sheffield folk scene as a singer of chorus songs and ceilidh caller.
                    </p>
                    {{ link_to_route("about", "Learn More", null, array('class' => 'btn btn-block btn-blog')) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="header">
                    <h4>
                        Patrick's Blog
                        <small>
                            Recent posts...
                        </small>
                    </h4>
                </div>
                <div class="home-info">
                    <ul>
                        @foreach($blogs as $blog)
                            <li>{{ link_to_route('blog.show', ucwords($blog->title), $blog->slug) }} </li>
                        @endforeach
                    </ul>
                    {{ link_to_route("blog.index", "Read More", null, array('class' => 'btn btn-block btn-blog')) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="header">
                    <h4>
                        Patrick's Shop
                    </h4>
                </div>
                <div class="home-info">
                    <p>
                        Buy Patrick's albums from Bandcamp.
                    </p>
                    <blockquote>
                        Overall, this is an album which shows plenty of promise
                        and good old-fashioned Yorkshire heart
                        <footer>
                            {{ link_to("http://brightyoungfolk.com/gigs/paradise-square-patrick-rose/record-detail.aspx",
                            "Lucy Houlden") }}, Bright Young Folk on
                            {{ link_to("http://patrickrose.bandcamp.com/paradise-square", "Paradise Square") }}
                        </footer>
                    </blockquote>
                    {{ link_to("http://patrickrose.bandcamp.com", "Visit the shop", array('class' => 'btn btn-block btn-blog')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
@stop