<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AdminLTE 3 | Dashboard 2</title>
  <link rel="stylesheet" href="{{ url('admin-template/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin-template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin-template/dist/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts.admin-layouts.navbar')
    <!-- Main Sidebar Container -->
    @include('layouts.admin-layouts.sidebar')
    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
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
  @stack('treeview')
  @stack('adminSettings')
</body>
</html>
