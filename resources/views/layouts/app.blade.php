<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @guest
    <title>{{ config('app.name', 'EventAdvertiser') }}</title>
  @else
    @yield('title')
  @endguest

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.8" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}?v=1" rel="stylesheet">
  @yield('css')
  <link href="{{ asset('css/style.css') }}?v=1.5.2" rel="stylesheet">

  <script>
    window.Laravel = <?php echo json_encode([
      'base_url'  => \URL::to('/'),
    ]); ?>
  </script>
</head>

@if (session('loginClass'))
  @php $loginClass = session('loginClass') @endphp
@endif

@if(session('account') == 'osa')
<body class="{{ isset($loginClass) ? $loginClass : "" }}" style="background-color:#C5CAE9; ">
@elseif(session('account') == 'org-head')
<body class="{{ isset($loginClass) ? $loginClass : "" }}" style="background-color:#FFCCBC; ">
@elseif(session('account') == 'org-member')
<body class="{{ isset($loginClass) ? $loginClass : "" }}" style="background-color:#E0F2F1; ">
@else
<body class="{{ isset($loginClass) ? $loginClass : "" }}">
@endif
  @guest
    @yield('login')
  @else
    @include ('templates/top-navigation')

    @include ('templates/sidebar')

    @yield('content')

    @yield('modals')
  @endguest

  {{--  Authors modals  --}}
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
          <p><a href="mailto:janicalizdeguzman@gmail.com">janicalizdeguzman@gmail.com</a></p>
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
  <script src="{{ asset('js/axios.js') }}"></script>
  @yield('js')

</body>
</html>
