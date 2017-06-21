@extends('layouts.master')

@section('page-title', 'User Registration')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
  <link rel="stylesheet" href="{{ asset('css/waitMe.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
  @include('pages.top-nav')

  @include('pages.sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>WELCOME</h2>
      </div>
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                  <h2 id="heading-schedule">User Registration</h2>
                </div>
              </div>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <form class="" role="form" method="POST" action="{{ route('register') }}">
                <div class="row clearfix">
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
                        @if ($errors->has('user_account'))
                          <span class="help-block"> <strong>{{ $errors->first('user_account') }}</strong> </span>
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
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  <script src="{{ asset('js/bootstrap-select.js') }}" charset="utf-8"></script>
@endsection
