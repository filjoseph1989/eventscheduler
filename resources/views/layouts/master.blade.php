<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'LIZ') }}</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}?v=0.15">
  <link rel="stylesheet" href="{{ asset('css/waves.css') }}?v=0.15">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}?v=0.15">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=0.15">

  @yield('style')

  <script>
    window.Laravel = <?php echo json_encode([ 'csrfToken' => csrf_token(), ]) ?>;
  </script>
</head>

<body class="{{ session('class') }}">

  @yield('content')

  <script src="{{ asset('js/jquery.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/waves.js') }}" charset="utf-8"></script>

  @yield('footer')

</body>
</html>
