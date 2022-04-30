<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ url('admin-template/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin-template/dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea:not(.log-area)', selector:'textarea:not(.inner-order-comment)'});</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts.admin-layouts.navbar')
    <!-- Main Sidebar Container -->
    @include('layouts.admin-layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- Footer -->
    @include('layouts.admin-layouts.footer')
  </div>
  <script src="{{ url('admin-template/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('admin-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ url('admin-template/dist/js/adminlte.js') }}"></script>
  <script src="{{ url('admin-template/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ url('admin-template/plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ url('admin-template/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ url('admin-template/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <script src="{{ url('admin-template/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="{{ url('admin-template/dist/js/custom-scripts.js') }}"></script>
  @stack('category')
  @stack('attribute-values')
  @stack('products')
  @stack('import')
  @stack('admin-profile')
  @stack('settings')
  @stack('admin')
  @stack('customers')
  @stack('order')
</body>
</html>
