@extends('layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/waitMe.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
  <div class="signup-box">
    <div class="logo">
      <a href="javascript:void(0);">Event<b>Scheduler</b></a>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_up" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="msg">Register a new membership</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="first_name" placeholder="Name" required autofocus>
                        @if ($errors->has('first_name'))
                          <span class="help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                        @if ($errors->has('last_name'))
                          <span class="help-block"> <strong>{{ $errors->first('last_name') }}</strong> </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" required>
                        @if ($errors->has('middle_name'))
                          <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="suffix_name" placeholder="Suffix" required>
                        @if ($errors->has('suffix_name'))
                          <span class="help-block"> <strong>{{ $errors->first('suffix_name') }}</strong> </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">account_balance_wallet</i>
                    </span>
                    <div class="form-line">
                        <input id="account_number" type="text" class="form-control" name="account_number" placeholder="Account Number" value="{{ old('account_number') }}" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <select class="form-control show-tick" name="course">
                            <option value="0">-- Course --</option>
                            <option value="1">BS in Computer Science</option>
                            <option value="2">Food Technology</option>
                            <option value="3">BS Biology</option>
                            <option value="4">BACA</option>
                            <option value="5">BA Anthropology</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <select class="form-control show-tick" name="department">
                          <option value="0">-- Department --</option>
                          <option value="1">College of Science and Mathematics</option>
                          <option value="2">College of Humanities and Social Science</option>
                          <option value="3">Department of Architecture</option>
                          <option value="4">School of Management</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </span>
                    <div class="form-line">
                        <input id="facebook_username" type="text" class="form-control" name="facebook_username" placeholder="Facebook" value="{{ old('facebook_username') }}" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    </span>
                    <div class="form-line">
                        <input id="twitter_username" type="text" class="form-control" name="twitter_username" placeholder="Twitter" value="{{ old('twitter_username') }}" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input id="instagram_username" type="text" class="form-control" name="instagram_username" placeholder="Instagram" value="{{ old('instagram_username') }}" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </span>
                    <div class="form-line">
                        <input id="mobile_number" type="text" class="form-control" name="mobile_number" placeholder="Modile Number" value="{{ old('mobile_number') }}" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                    <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                </div>
                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>
                <div class="m-t-25 m-b--5 align-center">
                    <a href="{{ route('login') }}">You already have a membership?</a>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.validate.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sign-up.js') }}" charset="utf-8"></script>
@endsection
