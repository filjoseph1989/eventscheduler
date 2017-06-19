<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'LIZ') }}</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/waves.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  @yield('style')
</head>
<body class="theme-red">

  @yield('content')

  <!-- Jquery Core Js -->
  <script src="{{ asset('js/jquery.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/waves.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/admin.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.countTo.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/raphael.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/morris.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/Chart.bundle.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.flot.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.flot.resize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.flot.pie.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.flot.categories.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.flot.time.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.sparkline.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/index.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/demo.js') }}" charset="utf-8"></script>

  @yield('footer')
</body>
</html>
