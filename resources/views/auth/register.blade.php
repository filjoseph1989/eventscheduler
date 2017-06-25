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
                <div class="form-group">
                    <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                    <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                </div>

                <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                <div class="m-t-25 m-b--5 align-center">
                    <a href="sign-in.html">You already have a membership?</a>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
      <div class="body">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="first_name">
                <label class="form-label">First Name</label>
                @if ($errors->has('first_name'))
                  <span class="help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="last_name">
                <label class="form-label">Last Name</label>
                @if ($errors->has('last_name'))
                  <span class="help-block"> <strong>{{ $errors->first('last_name') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="middle_name">
                <label class="form-label">Middle Name</label>
                @if ($errors->has('middle_name'))
                  <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('suffix_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="suffix_name">
                <label class="form-label">Suffix Name</label>
                @if ($errors->has('suffix_name'))
                  <span class="help-block"> <strong>{{ $errors->first('suffix_name') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('user_account_id') ? ' has-error' : '' }}">
              <div class="form-line">
                <select class="form-control show-tick" name="user_account_id">
                  <option value="0">-- Account Type --</option>
                  <option value="1">Admin</option>
                  <option value="2">Organization Adviser</option>
                  <option value="3">Organization Head</option>
                  <option value="4">Organization Member</option>
                  <option value="5">OSA Personnel</option>
                </select>
                @if ($errors->has('user_account_id'))
                  <span class="help-block"> <strong>{{ $errors->first('user_account_id') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
              <div class="form-line">
                <select class="form-control show-tick" name="course_id">
                  <option value="0">-- Course --</option>
                  <option value="1">BSCS</option>
                  <option value="2">Food Technology</option>
                  <option value="3">BS Biology</option>
                  <option value="4">BACA</option>
                  <option value="5">BA Anthropology</option>
                </select>
                @if ($errors->has('course_id'))
                  <span class="help-block"> <strong>{{ $errors->first('course_id') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
              <div class="form-line">
                <select class="form-control show-tick" name="department_id">
                  <option value="0">-- Department --</option>
                  <option value="1">College of Science and Mathematics</option>
                  <option value="2">College of Humanities and Social Science</option>
                  <option value="3">Department of Architecture</option>
                  <option value="4">School of Management</option>
                </select>
                @if ($errors->has('department_id'))
                  <span class="help-block"> <strong>{{ $errors->first('department_id') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('position_id') ? ' has-error' : '' }}">
              <div class="form-line">
                <select class="form-control show-tick" name="position_id">
                  <option value="0">-- Position --</option>
                  <option value="1">Chairman</option>
                  <option value="2">Faculty</option>
                  <option value="3">OSA Staff</option>
                  <option value="4">Vice-Chairman</option>
                  <option value="5">Secretary</option>
                </select>
                @if ($errors->has('position'))
                  <span class="help-block"> <strong>{{ $errors->first('position') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="account_number">
                <label class="form-label">Account Number</label>
                @if ($errors->has('account_number'))
                  <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="email">
                <label class="form-label">Email</label>
                @if ($errors->has('email'))
                  <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="password" class="form-control" name="password">
                <label class="form-label">Password</label>
                @if ($errors->has('password'))
                  <span class="help-block"> <strong>{{ $errors->first('password') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('facebook_username') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="facebook_username">
                <label class="form-label">Facebook Username</label>
                @if ($errors->has('facebook_username'))
                  <span class="help-block"> <strong>{{ $errors->first('facebook_username') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('twitter_username') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="twitter_username">
                <label class="form-label">Twitter Username</label>
                @if ($errors->has('twitter_username'))
                  <span class="help-block"> <strong>{{ $errors->first('twitter_username') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('instagram_username') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="instagram_username">
                <label class="form-label">Instagram Username</label>
                @if ($errors->has('instagram_username'))
                  <span class="help-block"> <strong>{{ $errors->first('instagram_username') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="mobile_number">
                <label class="form-label">Mobile Username</label>
                @if ($errors->has('mobile_number'))
                  <span class="help-block"> <strong>{{ $errors->first('mobile_number') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="status">
                <label class="form-label">Status</label>
                @if ($errors->has('status'))
                  <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
            <button type="submit" class="btn btn-success" name="button">
              <i class="material-icons">save</i> SAVE
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <!--
  <script src="{{ asset('js/jquery.validate.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sign-up.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/basic-form-elements.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/demo.js') }}" charset="utf-8"></script>
  -->
@endsection
