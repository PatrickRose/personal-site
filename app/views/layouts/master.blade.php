<!DOCTYPE html>
<html>
<head>
    <title>@yield("title") - Patrick Rose</title>
    {{ HTML::style("assets/css/main.min.css") }}
</head>
<body>
    <div class="container">
        @include('partials/_navigation')

        @if (Session::has("flash_message"))
            <div class='flash-message'>{{ Session::get('flash_message') }}</div>
        @endif

        @yield("content")
    </div>
</body>
</html>