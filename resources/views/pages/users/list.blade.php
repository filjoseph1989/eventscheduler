@extends('layouts.master')

@section('page-title', 'List of Users')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
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
        <?php if (session('status')): ?>
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        <?php endif; ?>

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF USERS </h2>
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
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                  <thead>
                    <tr>
                      <th>Account Number</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @if (isset($users))
                      @foreach ($users as $usersKey => $usersvalue)
                        <tr>
                          <td>{{ $usersvalue->account_number }}</td>
                          <td>{{ $usersvalue->first_name }}</td>
                          <td>{{ $usersvalue->last_name }}</td>
                          <td>{{ $usersvalue->email }}</td>
                          <td>{{ $usersvalue->mobile_number }}</td>
                          <td>
                            <a href="#" class="users-delete" data-type="cancel"> <i class="material-icons">delete</i> </a>
                            <a href="#" class="users-edit" data-toggle="modal" data-target="#edit-user"> <i class="material-icons">mode_edit</i> </a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Account Number</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Mobile</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                </table>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-user">
                  <i class="material-icons">add</i> Add New
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
  <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="">Edit User Name</h4>
        </div>
        <div class="modal-body">
            <div class="form-group form-float form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="first_name">
                <label class="form-label">First Name</label>
                @if ($errors->has('first_name'))
                  <span class="help-block"> <strong>{{ $errors->first('first_name') }}</strong> </span>
                @endif
              </div>
            </div>
            <div class="form-group form-float form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="middle_name">
                <label class="form-label">Middle Name</label>
                @if ($errors->has('middle_name'))
                  <span class="help-block"> <strong>{{ $errors->first('middle_name') }}</strong> </span>
                @endif
              </div>
            </div>
            <div class="form-group form-float form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="last_name">
                <label class="form-label">Last Name</label>
                @if ($errors->has('last_name'))
                  <span class="help-block"> <strong>{{ $errors->first('last_name') }}</strong> </span>
                @endif
              </div>
            </div>
            <div class="form-group form-float form-group{{ $errors->has('suffix') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="suffix">
                <label class="form-label">Suffix</label>
                @if ($errors->has('suffix'))
                  <span class="help-block"> <strong>{{ $errors->first('suffix') }}</strong> </span>
                @endif
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>
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
                <div class="form-group form-float form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="password" class="form-control" name="confirm_password">
                    <label class="form-label">Confirm Password</label>
                    @if ($errors->has('confirm_password'))
                    <span class="help-block"> <strong>{{ $errors->first('confirm_password') }}</strong> </span>
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
  <script type="text/javascript">
    $("#user-registration").validate();
  </script>
@endsection
