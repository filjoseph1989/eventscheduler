@extends('layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/waitMe.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
  <div class="signup-box">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <div class="logo">
      <a href="javascript:void(0);">Event<b>Scheduler</b></a>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_up" method="POST" action="{{ route('password.email') }}">
          {{ csrf_field() }}
          <div class="msg">Reset Password</div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">email</i>
            </span>
            <div class="form-line">
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>

              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Send Password Reset Link</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.validate.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sign-up.js') }}" charset="utf-8"></script>
@endsection
