@extends('layouts.app')

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                ADVERTISEMENT
                <small>In this panel you set or approved for advertisement</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-pink">14 For Approval</span> Official Events
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-cyan">99 Upcoming</span> Personal Events
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                CALENDAR
                <small>Show the event in a calendar</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-pink">14 New</span> Official Events
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-cyan">99 Unread</span> Personal Events
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                ATTENDANCE
                <small>In this panel you set the user attendance for each event</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-pink">14 Attendees</span> Official
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-cyan">99 Confirmed</span> Confirmation
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-teal">0</span> Expected
                </a>
                <a href="javascript:void(0);" class="list-group-item">
                  <span class="badge bg-blue">0</span> Decline
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                MANAGE NOTIFICATIONS
                <small>you panel for notification management</small>
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
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Notification Settings </a>
                <a href="javascript:void(0);" class="list-group-item"> Approved Events </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modals')
  <div id="notification" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Accept Invitation</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          ...
        </div>
      </div>
    </div>
  </div>
  <div id="webknights" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Janica Liz De Guzman</h4>
        </div>
        <div class="modal-body">
          <p>System Creator</p>
          <p>janicalizdeguzman at gmail dot com</p>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
@endsection
