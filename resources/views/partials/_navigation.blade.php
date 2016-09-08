<nav class="navbar navbar-default navbar-sticky">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    </div>

    <div class="navbar-collapse collapse">

      <ul class="nav navbar-nav">
        <li @if (Route::currentRouteName() == 'home')class="active"@endif><a href="{{ route('home') }}">Home</a></li>
        <li @if (Route::currentRouteName() == 'about')class="active"@endif><a href="{{ route('about') }}">About</a></li>
        <li @if (Route::currentRouteName() == 'gigs.index')class="active"@endif><a href="{{ route('gigs.index') }}">Gigs</a></li>
        <li @if (Route::currentRouteName() == 'blog.index')class="active"@endif><a href="{{ route('blog.index') }}">Blog</a></li>
        <li @if (Route::currentRouteName() == 'songs.index')class="active"@endif><a href="{{ route('songs.index') }}">Songs</a></li>
        <li><a href="{{ route(Auth::check() ? 'logout' : 'login') }}">{{ Auth::check() ? 'Logout' : 'Login' }}</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
