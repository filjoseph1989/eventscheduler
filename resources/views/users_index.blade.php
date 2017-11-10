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
  <?php
    /**
     * Issue 34
     * Create a function for this later
     * @param int $user
     */
    function AccounType($user) {
      switch ($user) {
        case '1':
          echo "Org Head";
          break;

        case '2':
          echo "Member";
          break;

        case '3':
          echo "Osa";
          break;
      }
    }

    /**
     * Show the user status
     * @param boolean $user
     */
    function UserStatus($user) {
      switch ($user) {
        case 'true':
          echo 'Active';
          break;

        case 'false':
          echo 'Inactive';
          break;
      }
    }
  ?>
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
              <h2>
                @if(isset($org[0]))
                  <?php if (! isset($org[0])): ?>
                    <strong>{{ $org->name }}</strong>
                  <?php else: ?>
                    <strong>{{ $org[0]->organization->name }}<br></strong>
                  <?php endif; ?>
                  <small>System Members</small>
                @else
                  System Members
                  @if (isset($id) and $id == 'active')
                    <small>List of active users</small>
                  @elseif(isset($id) and $id == 'inactive')
                    <small>List of inactive users</small>
                  @else
                    <small>List of all users</small>
                  @endif
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
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <?php if (session('account') != 'osa'): ?>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Position</th>
                      <th>User Type</th>
                      <th>Status</th>
                    <?php else: ?>
                      <th>Name</th>
                      <th>Course</th>
                      <th>User Type</th>
                      <th>Status</th>
                    <?php endif; ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $key => $user): ?>
                    <tr>
                      <?php if (session('account') != 'osa'): ?>
                        <td>
                          <a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->id }}">
                            {{ $user->full_name }}
                          </a>
                        </td>
                        <td>
                          <?php if (! is_null($user->course)): ?>
                            <a href="#" class="user-course"
                              data-toggle="modal"
                              data-target="#modal-course"
                              data-course-id="{{ $user->course->id }}">
                                {{ $user->course->name }}
                            </a>
                            <?php else: ?>
                              No Course
                            <?php endif; ?>
                        </td>
                        <td>
                          <a href="#" class="user-position"
                            data-toggle="modal"
                            data-target="#modal-position"
                            data-position-id="{{-- $user->position->id --}}">
                              {{ $user->organizationGroup[0]->position->name }}
                          </a>
                        </td>
                        <td>{{ AccounType($user->user_type_id) }}</td>
                        <td>{{ UserStatus($user->status) }}</td>
                      <?php else: ?>
                          <td>
                            <a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->id }}">
                              {{ $user->full_name }}
                            </a>
                          </td>
                          <td>
                            <a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->id }}">
                              {{ $user->course->name }}
                            </a>
                          </td>
                          <td>
                            <a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->id }}">
                              {{ $user->userType->name }}
                            </a>
                          </td>
                          <td>
                            <a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->id }}">
                              {{ ($user->status == 'true') ? 'Active' : 'Inactive' }}
                            </a>
                          </td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
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
  {{-- Simple profile for user --}}
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
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="profile-picture">
              <img class="org-logo" src="{{ asset("img/profile/profile.png") }}" alt="Profile Picture">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
              <table class="table">
                <tbody>
                  <tr> <td id="account-number"></td> </tr>
                  <tr> <td id="course"></td> </tr>
                  <tr> <td id="email"></td> </tr>
                  <tr> <td id="account"></td> </tr>
                  <tr> <td id="mobile-number"></td> </tr>
                  <tr> <td id="organizations"></td> </tr>
                  <tr> <td id="positions"></td> </tr>
                  <tr> <td id="facebook"></td> </tr>
                  <tr> <td id="twitter"></td> </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" name="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Course Information --}}
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

  {{-- Position Information --}}
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
  <script src="{{ asset('js/app.js') }}?v=2.19"></script>
@endsection
