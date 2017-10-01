@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Home Page') }}</title>
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
          <div class="card">
            <div class="header">
              <h2> System Members
                <small>List of users</small>
              </h2>
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
              @php extract($help::dataTableClass($users)) @endphp
              <table class="table table-bordered table-striped table-hover {{ $class }}">
                <thead>
                  <th>Name</th>
                  <th>Course</th>
                  <th>Position</th>
                  <th>Organization</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  @if (isset($users))
                    @foreach ($users as $key => $user)
                      <tr>
                        <td><a href="#" class="user-name" data-toggle="modal" data-target="#profile" data-user-id="{{ $user->id }}">{{ $user->full_name }}</a></td>
                        <td><a href="#" class="user-course" data-toggle="modal" data-target="#modal-course" data-course-id="{{ $user->course->id }}">{{ $user->course->name }}</a></td>
                        <td>
                          @if ($user->organizationGroup->count() == 0)
                            No Position
                          @else
                            @foreach ($user->organizationGroup as $key => $pos)
                              <a href="#" class="user-position" data-position-id="{{ $pos->position->id }}">{{ $pos->position->name }}</a>
                              @if ($user->organizationGroup->count() > 1)
                                <br>
                              @endif
                            @endforeach
                          @endif
                        </td>
                        <td>
                          @if ($user->organizationGroup->count() == 0)
                            No Organization
                          @else
                            @foreach ($user->organizationGroup as $key => $org)
                              <a href="#" class="user-organization" data-toggle="modal" data-target="#modal-organization" data-organization-id="{{ $org->organization->id }}">{{ $org->organization->name }}</a>
                              @if ($user->organizationGroup->count() > 1)
                                <br>
                              @endif
                            @endforeach
                          @endif
                        </td>
                        <td><a href="#">{{ $user->status == 'true' ? 'Active' : 'Inactive' }}</a></td>
                      </tr>
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
          <h4 class="modal-title" id="full-name">Katherine Mcnamara</h4>
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
@endsection

@section('js')
  <script src="{{ asset('js/bootstrap-select.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery-datatable.js') }}"?v=0.1></script>
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
  <script src="{{ asset('js/app.js') }}"?v=2.2></script>
@endsection
