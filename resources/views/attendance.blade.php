@extends('layouts.app')

@section('title')
  <title>Attendance</title>
@endsection

@section('css')
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> List of Attendance for each Events
                <small>Display different attendace for each events</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    @if ($eventType == 'Official' || $eventType == 'university' || $eventType == 'organizations')
                      <li><a href = "{{ route('Attendances.show', 'university') }}">University Events</a></li>
                      <li><a href = "{{ route('Attendances.show', 'organizations') }}">Organizations Events</a></li>
                    @endif ($eventType == 'Local')

                    @foreach ($user_orgs as $key => $user_org)
                      <li><a href = "{{ route('attendance.showWithinEachOrg', $user_org->organization->id) }}">My Org: {{ $user_org->organization->name }} Events</a></li>
                    @endforeach
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <th>Title</th>
                      <th>Official Attendance</th>
                      <th>Expected Attendance</th>
                      <th>Confirmed Attendance</th>
                      <th>Declined Attendance</th>
                    </thead>
                    <tbody>
                      <?php if (! empty($events)): ?>
                        @foreach ($events as $key => $event)
                          <tr data-event="{{ $event->id }}" data-route="{{ route('Event.edit', $event->id) }}" data-action="{{ route('Event.update', $event->id) }}">
                            <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ ucwords($event->title) }}</a></td>
                            <td><a href="{{ route('official.attendance', $event->id) }}" class="btn btn-success">View</a></td>
                            <td><a href="{{ route('expected.attendance', $event->id) }}" class="btn btn-success">View</a></td>
                            <td><a href="{{ route('confirmed.attendance', $event->id) }}" class="btn btn-success">View</a></td>
                            <td><a href="{{ route('declined.attendance', $event->id) }}" class="btn btn-success">View</a></td>
                          </tr>
                        @endforeach
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modals')
  <div id="modal-event" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="event" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="event-title">Event Information</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th class="modal-event" id="modal-event-title">Event Title</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="modal-event" id="modal-event-venue"></td>
              </tr>
              <tr>
                <td class="modal-event" id="modal-event-description"></td>
              </tr>
              <tr>
                <td class="modal-event" id="modal-event-organization"></td>
              </tr>
              <tr>
                <td class="modal-event" id="modal-event-category"></td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link waves-effect pull-right" data-dismiss="modal">CLOSE</button>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
@endsection
