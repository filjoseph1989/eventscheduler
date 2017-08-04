@extends('layouts.master')

@section('page-title', 'List of Users')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
    @include('pages.top-nav')

    @if (session('login_type') and session('login_type') == 'admin')
        @include('pages.admin.sidebar')
    @elseif (session('login_type') and session('login_type') == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Add New User </h2>
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
                <form class="" id="user-registration" role="form" method="POST" action="{{ route('admin.user.register') }}">
                  {{ csrf_field() }}
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required="true" autofocus>
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
                          <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
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
                          <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" >
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
                          <input type="text" class="form-control" name="suffix_name" value="{{ old('suffix_name') }}">
                          <label class="form-label">Suffix Name</label>
                          @if ($errors->has('suffix_name'))
                          <span class="help-block"> <strong>{{ $errors->first('suffix_name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}">
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
                          <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                          <label class="form-label">Email</label>
                          @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('facebook_username') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="form-control" name="facebook_username" value="{{ old('facebook_username') }}">
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
                          <input type="text" class="form-control" name="twitter_username" value="{{ old('twitter_username') }}">
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
                          <input type="text" class="form-control" name="instagram_username" value="{{ old('instagram_username') }}">
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
                          <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}">
                          <label class="form-label">Mobile Number</label>
                          @if ($errors->has('mobile_number'))
                          <span class="help-block"> <strong>{{ $errors->first('mobile_number') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('user_account_id') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <select class="form-control show-tick" id="user_account" name="user_account_id">
                            <option value="0">-- Select User Account --</option>
                            <?php foreach ($user_account as $key => $value): ?>
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            <?php endforeach; ?>
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
                          <select class="form-control show-tick" name="course_id" required>
                            <option value="">-- Select Course --</option>
                            <?php foreach ($course as $key => $value): ?>
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            <?php endforeach; ?>
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
                          <select class="form-control show-tick" name="department_id" required>
                            <option value="0">-- Select Department --</option>
                            <?php foreach ($department as $key => $value): ?>
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            <?php endforeach; ?>
                          </select>
                          @if ($errors->has('department_id'))
                            <span class="help-block"> <strong>{{ $errors->first('department_id') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <select class="form-control" name="status">
                            <option value="0">-- Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                          @if ($errors->has('status'))
                          <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <button type="submit" class="btn btn-success">
                          <i class="material-icons">save</i> Save
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <footer class="admin-footer">
            @component('components.who')
            @endcomponent
          </footer>
        </div>
      </div>
    </section>
@endsection

@section('modal')
  <!-- modal for editing user information -->
  <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="user-update" role="form" method="POST" action="{{ route('admin.user.edit') }}">
          {{ csrf_field() }}
            <input type="hidden" name="id" id="user_id">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Edit User Name</h4>
            </div>
            <div class="modal-body">
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"value="{{ old('first_name') }}" required="true" autofocus>
                      @if ($errors->has('first_name'))
                        <span class="help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                      @if ($errors->has('last_name'))
                        <span class="help-block"> <strong>{{ $errors->first('last_name') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name') }}">
                      @if ($errors->has('middle_name'))
                        <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('suffix_name') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="suffix_name" name="suffix_name" placeholder="Suffix Name" value="{{ old('suffix_name') }}" required>
                      @if ($errors->has('suffix_name'))
                        <span class="help-block"> <strong>{{ $errors->first('suffix_name') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="{{ old('account_number') }}" required>
                      @if ($errors->has('account_number'))
                        <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                        <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('facebook_username') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="facebook_username" name="facebook_username" value="{{ old('facebook_username') }}">
                      @if ($errors->has('facebook_username'))
                      <span class="help-block"> <strong>{{ $errors->first('facebook_username') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('twitter_username') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="twitter_username" name="twitter_username" placeholder="Twitter Username" value="{{ old('twitter_username') }}">
                      @if ($errors->has('twitter_username'))
                      <span class="help-block"> <strong>{{ $errors->first('twitter_username') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('instagram_username') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="instagram_username" name="instagram_username" placeholder="Instagram Username" value="{{ old('instagram_username') }}">
                      @if ($errors->has('instagram_username'))
                      <span class="help-block"> <strong>{{ $errors->first('instagram_username') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}" required>
                      @if ($errors->has('mobile_number'))
                      <span class="help-block"> <strong>{{ $errors->first('mobile_number') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group form-float form-group{{ $errors->has('user_account_id') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <select class="form-control show-tick" id="user_account_id" name="user_account_id" required>
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
                  <div class="form-group form-float form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <select class="form-control show-tick" name="course_id" required>
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
                  <div class="form-group form-float form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <select class="form-control show-tick" name="department_id" required>
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
                  <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <div class="form-line">
                      <select class="form-control" name="status">
                        <option value="0">-- Status --</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      @if ($errors->has('status'))
                      <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">
                <i class="material-icons">save</i> Save
              </button>
              <button type="button" class="btn btn-default" data-dismiss="modal">
                <i class="material-icons">close</i> Close
              </button>
            </div>
          </form>
      </div>
    </div>
  </div>

  <!-- modal for adding user information -->
  <div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="user-registration" role="form" method="POST" action="{{ route('admin.user.register') }}">
          {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Add New User</h4>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required="true" autofocus>
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
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
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
                    <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" >
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
                    <input type="text" class="form-control" name="suffix_name" value="{{ old('suffix_name') }}">
                    <label class="form-label">Suffix Name</label>
                    @if ($errors->has('suffix_name'))
                      <span class="help-block"> <strong>{{ $errors->first('suffix_name') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group{{ $errors->has('account_number') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}">
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
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                        <label class="form-label">Email</label>
                        @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                        @endif
                      </div>
                  </div>
              </div>
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('facebook_username') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" name="facebook_username" value="{{ old('facebook_username') }}">
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
                    <input type="text" class="form-control" name="twitter_username" value="{{ old('twitter_username') }}">
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
                    <input type="text" class="form-control" name="instagram_username" value="{{ old('instagram_username') }}">
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
                    <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}">
                    <label class="form-label">Mobile Number</label>
                    @if ($errors->has('mobile_number'))
                      <span class="help-block"> <strong>{{ $errors->first('mobile_number') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('user_account_id') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <select class="form-control show-tick" id="user_account" name="user_account_id">
                        <!-- <option value="0">-- Account Type --</option> -->
                        <option value="1">Unassigned User</option>
                        <!-- <option value="2">Organization Adviser</option>
                        <option value="3">Organization Head</option>
                        <option value="4">Organization Member</option>
                        <option value="5">OSA Personnel</option> -->
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
                    <select class="form-control show-tick" name="course_id" required>
                      <option value="1">Not Applicable</option>
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
                    <select class="form-control show-tick" name="department_id" required>
                      <option value="1">Not Applicable</option>
                    </select>
                    @if ($errors->has('department_id'))
                    <span class="help-block"> <strong>{{ $errors->first('department_id') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <select class="form-control" name="status">
                      <option value="0">-- Status --</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                      <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">
              <i class="material-icons">save</i> Save
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="material-icons">close</i> Close
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.flash.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jszip.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.html5.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.print.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.validate.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dialogs.js') }}?v=0.1" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.18" charset="utf-8"></script>
  <script type="text/javascript">
    $(function () {
      /**
       * Note:
       * form_validation() function is define in app.js
       * @var function
       */
      form_validation('#user-registration');
    });
  </script>
@endsection
