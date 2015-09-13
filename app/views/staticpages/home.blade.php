@extends('layouts.master')

@section('title')
  Home Page
@stop

@section('content')
  <div class="row section topspace">
    <div class="col-md-12">
      <p class="lead text-center text-muted">
        Welcome to the website of the Sheffield based folk musician Patrick Rose, 
	winner of the John Birmingham Cup Song Writing Competition 2015
      </p>
    </div>
  </div>
  <div class="row section featured topspace">
    <h2 class="section-title">
      <span>
        About
      </span>
    </h2>
    <div class="row">
      <div class="col-sm-6">
	<h3 class="text-center">
	  Biography
	</h3>
        <p>
	  A self taught singer, whose guitar playing has been described as
          "soothing" and music called "Yorkshire bred if not Yorkshire born".
          He is well known on the Sheffield scene for his songwriting
	  and ceilidh calling.
	</p>
	<p class="text-center">
          {{ link_to_route("about", "Learn More", null, array('class' => 'btn btn-action')) }}
	</p>
      </div>
      <div class="col-sm-6">
	<h3 class="text-center">
	  Shop
	</h3>
        <p>
          Overall, this is an album which shows plenty of promise
          and good old-fashioned Yorkshire heart <br />
	  {{ link_to(
	      "http://brightyoungfolk.com/gigs/paradise-square-patrick-rose/record-detail.aspx",
	      "Lucy Houlden"
	    ) }}, Bright Young Folk on
          {{ link_to(
	      "http://patrickrose.bandcamp.com/paradise-square",
	      "Paradise Square"
	    ) }}
        </p>
	<div class="visible-sm"><br />
	</div>
	<p class="text-center">
	  {{ link_to("http://patrickrose.bandcamp.com", "Visit the shop", array('class' => 'btn btn-action')) }}
	</p>
      </div>
    </div>
  </div>
  <div class="row section featured topspace">
    <h2 class="section-title">
      <span>
      {{ link_to_route("blog.index", "Blog", null) }}
      </span>
    </h2>
    <div class="row">
      @foreach($blogs as $blog)
        <div class="col-md-3 col-sm-6">
	  <h3>{{ ucwords($blog->title) }}</h3>
	  <div class="home-page-blog-text">
	    {{ $blog->present()->getFirstParagraph() }}
	  </div>
	  <p class="text-center">
            {{ link_to_route("blog.show", "Read more", $blog->slug, ['class' => 'btn btn-action']) }}
	  </p>
        </div>
      @endforeach
    </div>
  </div>
@stop
