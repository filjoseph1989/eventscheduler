@extends('layouts.master')

@section('page-title', 'List of Users')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
    {{-- list all users on user dashboard --}}

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar')
    @endif

    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
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
                <h2> LIST OF USERS </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);">Action</a></li>
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
                      <th>Status</th>
                      <th>Account Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @if (isset($data))
                      @foreach ($data as $usersKey => $usersvalue)
                        <tr data-id="{{ $usersvalue->id }}">
                          <td>{{ $usersvalue->account_number }}</td>
                          <td>{{ $usersvalue->first_name }}</td>
                          <td>{{ $usersvalue->last_name }}</td>
                          <td>{{ $usersvalue->email }}</td>
                          <td>{{ $usersvalue->mobile_number }}</td>
                          <td>{{ $usersvalue->status == 1 ? 'active' : 'inactive'  }}</td>
                          <td>{{ $usersvalue->u_acc_name }}</td>
                          <td>
                            <a href="#" class="osa-add-org" data-orgs="{{$organizations}}" data-positions="{{$positions}}" data-id="{{ $usersvalue->user_id }}" data-toggle="modal" data-target="#change-position">
                              <i class="material-icons">bubble_chart</i>
                            </a>
                            <a href="#" class="osa-user-account-edit" data-orgs="{{$org_grps}}" data-user-accounts="{{$user_accounts}}" data-id="{{ $usersvalue->user_id }}" data-toggle="modal" data-target="#change-user-account">
                              <i class="material-icons">mode_edit</i>
                            </a>
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
                      <th>Status</th>
                      <th>Account Type</th>
                      <th>Position</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
  <div class="modal fade" id="change-position" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" action="{{ route('user.update.position') }}" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" id="osa-user-id" value="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Add User Position</h4>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <select class="form-control show-tick" name="position_id" id="position-name">
                  <option value="0">-- Select Position --</option>
                  @foreach ($positions as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            </br>
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {{--
                  This wil contain the list of organization filled using ajax

                  Since, we already get the list of organizations from the OsaAccountController@showAllUserList
                  all we need to do is to display it here as dropdown
                                      -liz
                --}}
                <select class="form-control show-tick" name="organization_id" id="organization-name">
                  <option value="0">-- Select Organization --</option>
                  @foreach ($organizations as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"> <i class="material-icons">save</i>Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="material-icons">close</i> Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <div class="modal fade" id="change-user-account" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" action="#" method="post">
          {{ csrf_field() }}
          <input type="hidden" name="id" id="osa-user-id" value="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Edit User's Account Type</h4>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <select class="form-control show-tick" name="user_account_id" id="user-account-name">
                  <option value="0">-- Select User Account --</option>
                  @foreach ($user_accounts as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            </br>
            <div class="row clearfix">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {{--
                  This wil contain the list of organization filled using ajax

                  Since, we already get the list of organizations from the OsaAccountController@showAllUserList
                  all we need to do is to display it here as dropdown
                                      -liz
                --}}
                <select class="form-control show-tick" name="organization_id" id="organization-name">
                  <option value="0">-- Select Organization --</option>
                  @foreach ($organizations as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"> <i class="material-icons">save</i>Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="material-icons">close</i> Close</button>
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
  <script src="{{ asset('js/app.js') }}?v=0.8" charset="utf-8"></script>
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
