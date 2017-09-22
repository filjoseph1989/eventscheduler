@extends('layouts.master')

@section('page-title', 'Add Member To The Organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-colorpicker.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar') 
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if (session('status_warning'))
          <div class="alert alert-warning">{{ session('status_warning') }}</div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Add Member Information</h2>
              </div>
              <div class="body">
                {{-- <form class="" action="{{ route('org-head.members.search') }}" method="post">
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      {{ csrf_field() }}
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="search" name="search" placeholder="Search..." autofocus>
                          @if ($errors->has('name'))
                            <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </form> --}}
                <form id="sign_up" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="msg">Register a new org. membership</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required autofocus>
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
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
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
                        <input type="text" class="form-control" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name') }}" >
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
                        <input type="text" class="form-control" name="suffix_name" value="{{ old('suffix_name') }}" placeholder="Suffix">
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
                        <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
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
                        <input type="password" class="form-control" name="password_confirmation" minlength="6" placeholder="Confirm Password" required>
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
                    <span class="input-group-addon sign-in">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>
                    </span>
                    <div class="form-line">
                        <input id="facebook_username" type="text" class="form-control" name="facebook_username" placeholder="Facebook" value="{{ old('facebook_username') }}">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    </span>
                    <div class="form-line">
                        <input id="twitter_username" type="text" class="form-control" name="twitter_username" placeholder="Twitter" value="{{ old('twitter_username') }}">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </span>
                    <div class="form-line">
                        <input id="instagram_username" type="text" class="form-control" name="instagram_username" placeholder="Instagram" value="{{ old('instagram_username') }}">
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon sign-in">
                      <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input id="mobile_number" type="text" class="form-control" name="mobile_number" placeholder="Modile Number" value="{{ old('mobile_number') }}" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <select class="form-control show-tick" name="user_account_id">
                            <option value="0">-- Account Type --</option>
                            <option value="4">Organization Member</option>
                        </select>
                        @if ($errors->has('user_account_id'))
                        <span class="help-block"> <strong>{{ $errors->first('user_account_id') }}</strong> </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <select class="form-control show-tick" name="course_id">
                            <option value="0">-- Course --</option>
                            <option value="1">Course Not Applicable</option>
                            <option value="2">BS in Computer Science</option>
                            <option value="3">Food Technology</option>
                            <option value="4">BS Biology</option>
                            <option value="5">BACA</option>
                            <option value="6">BA Anthropology</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <select class="form-control show-tick" name="department_id">
                            <option value="0">-- Department --</option>
                            <option value="1">College of Science and Mathematics</option>
                            <option value="2">College of Humanities and Social Science</option>
                            <option value="3">Department of Architecture</option>
                            <option value="4">School of Management</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-block btn-lg bg-custom-pink waves-effect" type="submit">REGISTER THIS PERSON</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
@endsection

@section('footer')
  <script src="{{ asset('js/bootstrap-colorpicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
  <script type="text/javascript">
    $('.event-datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });
    $('.event-timepicker').bootstrapMaterialDatePicker({
      format: 'HH:mm',
      clearButton: true,
      date: false
    });
    $('#color').colorpicker();
  </script>
@endsection
