<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if ($loginClass == 'login-page')
    <title>{{ config('app.name', 'EventScheduler') }}</title>
  @else
    @yield('title')
  @endif

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


    @if ($loginClass == 'login-page')
      @yield('login')
    @else
      @include ('templates/top-navigation')

      @include ('templates/sidebar')

      @yield('content')

      @yield('modals')
    @endif


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

  <div id="webknights" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Janica Liz De Guzman</h4>
        </div>
        <div class="modal-body">
          <p>System Creator</p>
          <p>janicalizdeguzman at gmail dot com</p>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>

  @routes

  <script src="{{ asset('js/jquery.min.js') }}?v=3.2.1"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}?v=3.3.7"></script>
  <script src="{{ asset('js/waves.js') }}"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  @yield('js')

</body>
</html>
