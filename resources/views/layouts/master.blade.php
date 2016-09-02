<!DOCTYPE html>
<html>
  <head>
    <title>@yield("title") - Patrick Rose</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}" />
    <link rel="stylesheet" href="{{ asset("css/styles.css") }}" />
    <link rel="stylesheet" href="http://yandex.st/highlightjs/8.0/styles/default.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <header id="header">
      <div id="head" class="parallax" parallax-speed="2">
        <h1 id="logo" class="text-center">
          <img class="img-circle" src="{{ asset('img/header.jpg') }}">
          <span class="title">Patrick Rose</span>
          <span class="tagline">
            Singer, Guitarist, Caller<br />
            <div class="email">
              <a href="mailto:whoelse@patrickrosemusic.co.uk">
                whoelse@patrickrosemusic.co.uk
                <span class="mobile-email glyphicon glyphicon-envelope"></span></a>
            </div>
          </span>

        </h1>
      </div>
      @include('partials/_navigation')
    </header>
    <main>
      <div class="container">

        <div class="main-text">
          @if (Session::has("flash_message"))
            <div class='flash-message'>
              {{ Session::get('flash_message') }}
            </div>
          @endif
          
          @yield("content")

        </div>
      </div>
    </main>

    <br />

    <footer id="underfooter">
      <div class="container">
        <div class="row">

          <div class="col-md-6 widget">
            <div class="widget-body">
              <p>
                Copyright &copy; {{ date('Y') }} Patrick Rose<br>
                Design: <a href="http://www.gettemplate.com" rel="designer">Initio by GetTemplate</a> </p>
              </p>
            </div>
          </div>

          <div class="col-md-6 widget">
            <div class="widget-body">
              <p class="text-right">
		<a href="https://www.youtube.com/channel/UC97Cz0kjQFSuLglsZFpzZ0w" title="YouTube"><i class="fa fa-2x fa-youtube"></i></a>
		<a href="https://twitter.com/DrugCrazed" title="Twitter"><i class="fa fa-2x fa-twitter"></i></a>
		<a href="https://www.facebook.com/PatrickRoseMusic" title="Facebook"><i class="fa fa-2x fa-facebook"></i></a>
		<a href="https://www.bandcamp.com/PatrickRose" title="Shop"><i class="fa fa-2x fa-shopping-cart"></i></a>
              </p>
            </div>
          </div>

        </div> <!-- /row of widgets -->
      </div>
    </footer>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/fading.js') }}"></script>
    <script src="{{ asset('assets/js/initio.js') }}"></script>
    <script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
  </body>
</html>
