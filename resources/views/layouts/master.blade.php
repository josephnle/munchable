<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Munchable</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('bower_components/jPushMenu/css/jPushMenu.css') }}">
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
<!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Left menu element-->
<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left munchable-left-menu">
    <h3>Munchable</h3>
    <a href="{{ action('PlacesController@search') }}">Home</a>
    @if(\Auth::check())
        <a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>
    @else
        <a href="{{ action('Auth\AuthController@getLogin') }}">Login / Register</a>
    @endif
</nav>
<!-- Right menu element-->

<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <span class="menu-icon">
            <a class="toggle-menu menu-left push-body">
                <i class="fa fa-bars fa-2x"></i>
            </a>
        </span>
        <a class="navbar-brand logo logo-centered" href="#">Munchable</a>
    </div><!-- /.container-fluid -->
</nav>

@yield('content')

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
<script type="text/javascript" src="{{ asset('bower_components/jPushMenu/js/jPushMenu.js') }}"></script>
<script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>

</body>
</html>