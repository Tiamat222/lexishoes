<!DOCTYPE html>
<html>
  <head>
  <title>Big shope A Ecommerce Category Flat Bootstarp Resposive Website Template | Home :: w3layouts</title>
  <link href="{{ url('front-template/dist/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ url('front-template/dist/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />	
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
  <script src="{{ url('front-template/dist/js/jquery.min.js') }}"></script>
</head>
<body> 
  <!-- Header -->
  @include('layouts.front-layouts.header')
  <!-- Container -->
  @include('layouts.front-layouts.container')
  <!-- Footer -->
  @include('layouts.front-layouts.footer')
</body>
</html>