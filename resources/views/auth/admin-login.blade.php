@extends('layouts.master')

@section('content')
  <div class="login-box">
    <div class="logo">
        <a href="#">Event<b>Scheduler</b></a>
        <small>Admin Login</small>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_in" id="sign_in" role="form" method="POST" action="{{ route('admin.login.submit') }}">
          {{ csrf_field() }}
          <div class="msg">Sign in to start your session as ADMIN</div>
          <div class="input-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <span class="input-group-addon"><i class="material-icons">person</i></span>
            <div class="form-line">
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Username" required autofocus>
              @if ($errors->has('email'))
                <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
              @endif
            </div>
          </div>
          <div class="input-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <span class="input-group-addon"><i class="material-icons">lock</i></span>
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
            <div class="col-xs-6 col-xs-offset-6 align-right">
              <a href="{{ route('admin.password.request') }}">Forgot Password?</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{asset('js/jquery.validate.js')}}"></script>
  <script src="{{asset('js/sign-in.js')}}"></script>
@endsection
