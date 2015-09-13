<!DOCTYPE html>
<html>
<head>
    <title>@yield("title") - Patrick Rose</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ HTML::style("css/main.css") }}
    {{ HTML::style("css/styles.css") }}
    <link rel="stylesheet" href="http://yandex.st/highlightjs/8.0/styles/default.min.css">
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
    {{ HTML::script('assets/js/jquery.min.js') }}
    {{ HTML::script('assets/js/bootstrap.js') }}
    {{ HTML::script('assets/js/fading.js') }}
    {{ HTML::script('assets/js/initio.js') }}
    <script src="http://yandex.st/highlightjs/8.0/highlight.min.js" />
    <script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
