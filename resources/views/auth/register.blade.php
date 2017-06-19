@extends('layouts.master') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Register</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <select class="" name="user_account">
              <option value="0">Account Type</option>
              <option value="1">Admin</option>
              <option value="2">Organization Adviser</option>
              <option value="3">Organization Head</option>
              <option value="4">Organization Member</option>
              <option value="5">OSA Personnel</option>
            </select>

            <select class="" name="position">
              <option value="0">Position</option>
              <option value="1">Chairman</option>
              <option value="2">Faculty</option>
              <option value="3">OSA Staff</option>
              <option value="4">Vice-Chairman</option>
              <option value="5">Secretary</option>
            </select>

            <div class="form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
              <label for="account_number" class="col-md-4 control-label">Username</label>

              <div class="col-md-6">
                <input id="account_number" type="text" class="form-control" name="account_number" value="{{ old('account_number') }}" required autofocus>
                @if ($errors->has('account_number'))
                  <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
              <label for="first_name" class="col-md-4 control-label">First Name</label>

              <div class="col-md-6">
                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                @if ($errors->has('first_name'))
                  <span class="help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
              <label for="last_name" class="col-md-4 control-label">Last Name</label>

              <div class="col-md-6">
                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
                @if ($errors->has('last_name'))
                  <span class="help-block"> <strong>{{ $errors->first('last_name') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
              <label for="middle_name" class="col-md-4 control-label">Middle Name</label>

              <div class="col-md-6">
                <input id="middle_name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" required autofocus>
                @if ($errors->has('middle_name'))
                  <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('suffix_name') ? ' has-error' : '' }}">
              <label for="suffix_name" class="col-md-4 control-label">Suffix Name</label>

              <div class="col-md-6">
                <input id="suffix_name" type="text" class="form-control" name="suffix_name" value="{{ old('suffix_name') }}" required autofocus>
                @if ($errors->has('suffix_name'))
                  <span class="help-block"> <strong>{{ $errors->first('suffix_name') }}</strong> </span>
                @endif
              </div>
            </div>
            <select class="" name="course">
              <option value="0">Course</option>
              <option value="1">BSCS</option>
              <option value="2">Food Technology</option>
              <option value="3">BS Biology</option>
              <option value="4">BACA</option>
              <option value="5">BA Anthropology</option>
            </select>

            <select class="" name="department">
              <option value="0">Department</option>
              <option value="1">College of Science and Mathematics</option>
              <option value="2">College of Humanities and Social Science</option>
              <option value="3">Department of Architecture</option>
              <option value="4">School of Management</option>
            </select>

            <div class="form-group{{ $errors->has('facebook_username') ? ' has-error' : '' }}">
              <label for="facebook_username" class="col-md-4 control-label">Facebook Username</label>

              <div class="col-md-6">
                <input id="facebook_username" type="text" class="form-control" name="facebook_username" value="{{ old('facebook_username') }}" required autofocus>
                @if ($errors->has('facebook_username'))
                  <span class="help-block"> <strong>{{ $errors->first('facebook_username') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('twitter_username') ? ' has-error' : '' }}">
              <label for="twitter_username" class="col-md-4 control-label">Twitter Username</label>

              <div class="col-md-6">
                <input id="twitter_username" type="text" class="form-control" name="twitter_username" value="{{ old('twitter_username') }}" required autofocus>
                @if ($errors->has('twitter_username'))
                  <span class="help-block"> <strong>{{ $errors->first('twitter_username') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('instagram_username') ? ' has-error' : '' }}">
              <label for="instagram_username" class="col-md-4 control-label">Instagram Username</label>

              <div class="col-md-6">
                <input id="instagram_username" type="text" class="form-control" name="instagram_username" value="{{ old('instagram_username') }}" required autofocus>
                @if ($errors->has('instagram_username'))
                  <span class="help-block"> <strong>{{ $errors->first('instagram_username') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
              <label for="mobile_number" class="col-md-4 control-label">Mobile Number</label>

              <div class="col-md-6">
                <input id="mobile_number" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" required autofocus>
                @if ($errors->has('mobile_number'))
                  <span class="help-block"> <strong>{{ $errors->first('mobile_number') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Password</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                  <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Register
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
