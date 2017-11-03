@extends('layouts.app')

@section('title')
  <title>List of Users</title>
@endsection

@section('css')
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-select.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('status') }}
            </div>
          @endif
          <div class="card">
            <div class="header">
              <h2> System Members
                @if (isset($id) and $id == 'active')
                  <small>List of active users</small>
                @elseif(isset($id) and $id == 'inactive')
                  <small>List of inactive users</small>
                @else
                  <small>List of all users</small>
                @endif
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('User.show', 'active') }}">Active System Members</a></li>
                    <li><a href="{{ route('User.show', 'inactive') }}">Inactive System Members</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <table class="table table-bordered table-striped table-hover {{-- $class --}}">
                <thead>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Position</th>
                  <th>User Type</th>
                  <th>Organization</th>
                  <th>Status</th>
                  @if (isset($filter) and $filter === true)
                    <th>Action</th>
                  @endif
                </thead>
                <tbody>
                  @if (isset($users))
                    @foreach ($users as $key => $us)
                      @foreach ($us as $key => $user)
                        <tr>
                            <td><a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->user->id }}">{{ $user->user->full_name }}</a></td>                        
                          <td>
                                <a href="#" class="user-course" data-toggle="modal" data-target="#modal-course" data-course-id="{{ isset($user->user->course->id) ? $user->user->course->id : '' }}">
                                  {{ isset($user->user->course->name) ? $user->user->course->name : 'No Assign Course Yet' }}
                                </a>
                          </td>
                          
                          <td>
                                @if (count($user) == 0)
                                  No Position
                                @else
                                  @foreach ($user->user->organizationGroup as $key => $pos)
                                    <a href="#" class="user-position" data-toggle="modal" data-target="#modal-position" data-position-id="{{ $pos->position->id }}">{{ $pos->position->name }}</a>
                                    @if (count($user) > 1)
                                      {{--  <br>  --}}
                                    @endif
                                  @endforeach
                                @endif
                          </td>
                          <td>
                            @if( $user->user_type_id == 3 )
                              OSA staff
                            @elseif( $user->user_type_id == 2 )
                              Org member
                            @else
                              Org head
                            @endif
                          </td>
                          <td>
                                @if ($user->count() == 0)
                                  No organization
                                @else
                                  @foreach ($user->user->organizationGroup as $key => $pos)
                                    <a href="#" class="user-organization" data-toggle="modal" data-target="#modal-organization" data-organization-id="{{ $pos->organization->id }}">{{ $pos->organization->name }}</a>
                                    @if (count($user) > 1)
                                      {{--  <br>  --}}
                                    @endif
                                  @endforeach
                                @endif
                          </td>
                            <td><a href="#">{{ $user->user->status == 'true' ? 'Active' : 'Inactive' }}</a></td>
                          @if (isset($filter) and $filter === true)
                            <td>
                              @if (isset($id) and $id == 'inactive')
                                <a href="#" onclick="event.preventDefault(); document.getElementById('form-activate').submit();">Activate</a>
                              @else
                                <a href="#" onclick="event.preventDefault(); document.getElementById('form-deactivate').submit();">Deactivate</a>
                              @endif

                              @if (Auth::user()->user_type_id == 2)
                                | <a href="#" class="user-edit" data-route="{{ route('User.edit', $user->id ) }}" data-toggle="modal" data-target="#modal-edit">Edit</a>
                              @elseif (Auth::user()->user_type_id == 1)
                                | <a href="#" class="user-edit" data-route="{{ route('User.edit', $user->user->id ) }}" data-toggle="modal" data-target="#modal-edit">Edit</a>                              
                              @endif

                              {{--  Forms  --}}
                              <form id="form-activate" action="{{ route('User.update', $user->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="status" value="true">
                              </form>
                              <form id="form-deactivate" action="{{ route('User.update', $user->id) }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="status" value="false">
                              </form>
                            </td>
                          @endif
                        </tr>
                      @endforeach
                    @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modals')
  <div id="profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="full-name"></h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td id="account-number"></td>
              </tr>
              <tr>
                <td id="course"></td>
              </tr>
              <tr>
                <td id="email"></td>
              </tr>
              <tr>
                <td id="account"></td>
              </tr>
              <tr>
                <td id="mobile-number"></td>
              </tr>
              <tr>
                <td id="organizations"></td>
              </tr>
              <tr>
                <td id="positions"></td>
              </tr>
              <tr>
                <td id="facebook"></td>
              </tr>
              <tr>
                <td id="twitter"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-course" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="modal-course-title"></h4>
        </div>
        <div class="modal-body">
          <div id="modal-course-content">&nbsp;</div>
          <div id="modal-course-sourse">&nbsp;</div>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-organization" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="modal-organization-title"></h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td class="" id="modal-organization-acronym"></td>
              </tr>
              <tr>
                <td class="" id="modal-organization-description"> </td>
              </tr>
              <tr>
                <td class="" id="modal-organization-aniversary"> </td>
              </tr>
              <tr>
                <td class="" id="modal-organization-color"> </td>
              </tr>
              <tr>
                <td class="" id="modal-organization-status"> </td>
              </tr>
              <tr>
                <td class="" id="modal-organization-url"> </div>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
        </div>
        <div class="modal-body">
          <form class="" id="modal-edit-user-form" action="" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="from_modal_user_edit" value="true">
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group">
                  <div class="form-line">
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter student full name" value="{{ old('full_name') }}" required autofocus>
                    @if ($errors->has('full_name'))
                      <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group">
                  <div class="form-line">
                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter student account number" value="{{ old('account_number') }}" required>
                    @if ($errors->has('account_number'))
                      <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float">
                  <div class="form-line focused" id="modal-edit-course"> </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float">
                  <div class="form-line focused" id="modal-edit-user-account"> </div>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="button">
                    <i class="material-icons">save</i> Save
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-position" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="modal-position-title"></h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td class="" id="modal-position-description"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.8"></script>
@endsection
