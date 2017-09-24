<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.7" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v=0.20" rel="stylesheet">

</head>

<body class="login-page">

  <div class="login-box">
    <div class="logo">
      <a href="#">Event<b>Scheduler</b></a>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_in" id="sign_in" role="form" method="POST" action="">
          <input type="hidden" name="_token" value="rLIDLgwY8WFbxr9cMU4XbmxScMXAYKGkKUo84mbZ">
          <div class="msg">Sign in to start your session</div>
          <div class="input-group form-group">
            <span class="input-group-addon"><i class="material-icons">person</i></span>
            <div class="form-line">
              <input type="email" class="form-control" id="email" name="email" value="" placeholder="Username" required autofocus>
            </div>
          </div>
          <div class="input-group form-group">
            <span class="input-group-addon"><i class="material-icons">lock</i></span>
            <div class="form-line">
              <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 p-t-5">
              <input type="checkbox" name="remember" class="filled-in chk-col-pink" id="rememberme" >
              <label for="rememberme">Remember Me</label>
            </div>
            <div class="col-xs-4">
              <button class="btn btn-block bg-custom-pink waves-effect" type="submit">SIGN IN</button>
            </div>
          </div>
          <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
              <a href="">Register Now!</a>
            </div>
            <div class="col-xs-6 align-right">
              <a href="">Forgot Password?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/jquery.min.js') }}?v=3.2.1"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}?v=3.3.7"></script>
  <script src="{{ asset('js/waves.js') }}"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
  <script src="{{ asset('js/jquery.validate.js') }}"></script>
  <script src="{{ asset('js/sign-in.js') }}"></script>
</body>
</html>
