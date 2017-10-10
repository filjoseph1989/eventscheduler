@extends('layouts.app')

@section('login')
  <div class="login-box">
    <div class="logo">
      <a href="#">Event<b>Scheduler</b></a>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_in" id="sign_in" role="form" method="POST" action="{{ route('my.login') }}">
          {{ csrf_field() }}
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
              <a href="{{ route('register') }}">Register Now!</a>
            </div>
            <div class="col-xs-6 align-right">
              <a href="">Forgot Password?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/jquery.validate.js') }}"></script>
  <script src="{{ asset('js/sign-in.js') }}"></script>
@endsection
