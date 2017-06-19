<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
  <!-- Favicon-->
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
  <link href="{{asset('css/waves.css')}}" rel="stylesheet" />
  <link href="{{asset('css/animate.css')}}" rel="stylesheet" />
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  @yield('style')
</head>

<body class="{{ session('class') }}">

  @yield('content')

  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.js')}}"></script>
  <script src="{{asset('js/waves.js')}}"></script>
  <script src="{{asset('js/jquery.validate.js')}}"></script>
  <script src="{{asset('js/admin.js')}}"></script>
  <script src="{{asset('js/sign-in.js')}}"></script>


  <!-- <script src="{{ asset('js/bootstrap-select.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.countTo.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/raphael.min.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/morris.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/Chart.bundle.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.flot.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.flot.resize.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.flot.pie.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.flot.categories.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.flot.time.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/jquery.sparkline.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/index.js') }}" charset="utf-8"></script> -->
  <!-- <script src="{{ asset('js/demo.js') }}" charset="utf-8"></script> -->

  @yield('footer')
</body>

</html>
