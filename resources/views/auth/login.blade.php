@extends('layouts.master')

@section('content')
  <div class="login-box">
    <div class="logo">
      <a href="#"><b>Event</b>Scheduler</a>
    </div>
    <div class="card">
      <div class="body">
        <form class="form-horizontal" id="sign_in" role="form" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="msg">Sign in to start your session</div>
          <div class="input-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <span class="input-group-addon"> <i class="material-icons">person</i> </span>
            <div class="form-line">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Username" required autofocus>
              @if ($errors->has('email'))
                <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
              @endif
            </div>
          </div>
          <div class="input-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon"> <i class="material-icons">lock</i> </span>
            <div class="form-line">
              <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
              @if ($errors->has('password'))
                <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 p-t-5">
              <input type="checkbox" name="remember" class="filled-in chk-col-pink" id="rememberme" {{ old( 'remember') ? 'checked' : '' }}>
              <label for="rememberme">Remember Me</label>
            </div>
            <div class="col-xs-4">
              <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
            </div>
          </div>
          <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
              <a href="sign-up.html">Register Now!</a>
            </div>
            <div class="col-xs-6 align-right">
              <a class="btn btn-link" href="{{ route('password.request') }}"> Forgot Your Password? </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.validate.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/admin.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sign-in.js') }}" charset="utf-8"></script>
@endsection
