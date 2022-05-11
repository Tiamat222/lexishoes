<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ url('front-template/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('front-template/dist/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('front-template/dist/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ url('front-template/dist/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ url('front-template/dist/css/animate.css') }}" rel="stylesheet">
	<link href="{{ url('front-template/dist/css/main.css') }}" rel="stylesheet">
	<link href="{{ url('front-template/dist/css/responsive.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ url('front-template/dist/js/html5shiv.js') }}"></script>
    <script src="{{ url('front-template/dist/js/respond.min.js') }}"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ url('front-template/dist/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('front-template/dist/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('front-template/dist/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('front-template/dist/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('front-template/dist/images/ico/apple-touch-icon-57-precomposed.png') }}">
  </head>
<body>
  @include('layouts.front-layouts.header')
  @yield('content')
  @include('layouts.front-layouts.footer')
  <script src="{{ url('front-template/dist/js/jquery.js') }}"></script>
  <script src="{{ url('front-template/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('front-template/dist/js/jquery.scrollUp.min.js') }}"></script>
  <script src="{{ url('front-template/dist/js/price-range.js') }}"></script>
  <script src="{{ url('front-template/dist/js/jquery.prettyPhoto.js') }}"></script>
  <script src="{{ url('front-template/dist/js/main.js') }}"></script>
  @stack('auth')
  @stack('profile')
  @stack('password')
</body>
</html>