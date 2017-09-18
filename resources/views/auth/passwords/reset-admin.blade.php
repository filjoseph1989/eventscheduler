@extends('layouts.master')

@section('content')
  <div class="signup-box">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <div class="logo">
      <a href="javascript:void(0);">Event<b>Scheduler</b></a>
      <small>Administrator forgot password</small>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_up" method="POST" action="{{ route('admin.password.set') }}">
          {{ csrf_field() }}
          <div class="msg">Reset Password</div>
          <input type="hidden" name="token" value="{{ $token }}">
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">email</i>
            </span>
            <div class="form-line">
              <input type="email" class="form-control" id="email" name="email" value="{{ $email or old('email') }}" placeholder="Email Address" required autofocus>
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
              <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Confirm Password" required>
              @if ($errors->has('password_confirmation'))
              <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <button class="btn btn-block btn-lg bg-custom-pink waves-effect" type="submit">Reset Password</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.validate.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sign-up.js') }}" charset="utf-8"></script>
@endsection
