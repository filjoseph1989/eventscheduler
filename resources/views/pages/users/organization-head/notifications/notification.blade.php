@extends('layouts.master')

@section('page-title', 'Manage Notification')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
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
            {!! session('status') !!}
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
                <h2>
                  Events You Created
                  <small>Choose event for notification, user search for easy filtering</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);">All Events</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="body">
                <table class='table table-bordered table-striped table-hover dataTable js-exportable'>
                  <thead>
                    {{-- issue: universal search function--}}
                    <tr>
                      <th>Event Title</th>
                      <th>Event Type</th>
                      <th>Calendar</th>
                      <th>Organization</th>
                      <th>When</th>
                      <th>Where</th>
                      <th>Notifiable</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($events))
                      @foreach ($events as $usersKey => $usersvalue)
                        <tr>
                          <td>{{ $usersvalue->event }}</td>
                          <td>{{ $usersvalue->event_type_name }}</td>
                          <td>{{ $usersvalue->event_category_name }}</td>
                          <td>{{ $usersvalue->organization_name }}</td>
                          <td>{{ $usersvalue->date}} {{$usersvalue->time}}</td>
                          <td>{{ $usersvalue->venue }}</td>
                          <td>{{ ($usersvalue->status > 0) ? 'YES' : 'NOT' }}</td>
                          <td>{{ $usersvalue->created_at }}</td>
                          <td>{{ $usersvalue->updated_at }}</td>
                          <td>
                            <a href="#" class="events-delete delete">
                              <i class="material-icons">delete</i>
                            </a>
                            <a href="#" class="events-edit" title="Send announcement about this event" data-toggle="modal" data-target="#edit-events">
                              <i class="material-icons">share</i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Event Title</th>
                      <th>Event Type</th>
                      <th>Calendar</th>
                      <th>Organization</th>
                      <th>When</th>
                      <th>Where</th>
                      <th>Notifiable</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </tfoot>
                </table>
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
  <div class="modal fade" id="edit-events" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" action="{{ route('event.notify') }}" method="post">
          {{csrf_field()}}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Updated the Media Notification</h4>
          </div>
          <div class="modal-body">
            <div class="switch" id="facebook">
              <label>OFF<input type="checkbox" name='facebook' checked><span class="lever switch-col-indigo"></span>ON</label>
              Facebook
            </div>
            <div class="switch" id="twitter">
              <label>OFF<input type="checkbox" name='twitter' checked><span class="lever switch-col-blue"></span>ON</label>
              Twitter
            </div>
            <div class="switch" id="email">
              <label>OFF<input type="checkbox" name='email' checked><span class="lever switch-col-teal"></span>ON</label>
              Email
            </div>
            <div class="switch" id="sms">
              <label>OFF<input type="checkbox" name='sms' checked><span class="lever switch-col-red"></span>ON</label>
              SMS (temporary demo, should be for osa dashboard when osa user approves an event, status => 1)
            </div>
            <div class="switch" id="facebook-message">
              <div class="form-line">
                <input type="text" class="form-control" name="fb_message" value="">
                <label class="form-label">Facebook Message</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="material-icons">info</i> Notify</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
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
  <script src="{{ asset('js/dialogs.js') }}?v=0.3" charset="utf-8"></script>
@endsection
