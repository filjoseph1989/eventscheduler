<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'EventScheduler') }}</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.8" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v=1" rel="stylesheet">
  @yield('css')

</head>

<body class="{{ isset($loginClass) ? $loginClass : "" }}">

    @include ('templates/top-navigation')

    @include ('templates/sidebar')

    @if ($loginClass == 'login-page')
      @yield('login')
    @else
      @yield('content')
    @endif

    @yield('modals')

  {{--
    @guest
      @yield('login')
    @else
      @include ('templates/top-navigation')

      @include ('templates/sidebar')

      @yield('content')

      @yield('modals')
    @endguest
  --}}

  <script src="{{ asset('js/jquery.min.js') }}?v=3.2.1"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}?v=3.3.7"></script>
  <script src="{{ asset('js/waves.js') }}"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
  @yield('js')

</body>
</html>
