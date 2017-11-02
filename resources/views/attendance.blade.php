@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Attendance') }}</title>
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
              <h2> Events for List of Attendance
                <small>Display events in the system</small>
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
                      <th><a href="#">Title</a></th>
                      <th>Official Attendance</th>
                      <th>Expected Attendance</th>
                      <th>Confirmed Attendance</th>
                      <th>Declined Attendance</th>
                    </thead>
                    <tbody>
                      @foreach ($events as $key => $ev)
                        @foreach ($ev as $key => $event)
                          <tr data-event="{{ $event->id }}" data-route="{{ route('Event.edit', $event->id) }}" data-action="{{ route('Event.update', $event->id) }}">
                            <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ $event->title }}</a></td>
                            <td><button type="submit" class="btn btn-success event-attendance-official" data-target="#modal-attendances" data-toggle="modal">View</button></td>
                            <td><button type="submit" class="btn btn-success event-attendance-expected" data-target="#modal-attendances"  data-toggle="modal">View</button></td>
                            <td><button type="submit" class="btn btn-success event-attendance-confirmed" data-target="#modal-attendances" data-toggle="modal">View</button></td>
                            <td><button type="submit" class="btn btn-success event-attendance-declined" data-target="#modal-attendances"  data-toggle="modal">View</button></td>
                          </tr>
                        @endforeach
                      @endforeach
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
  <div id="modal-attendances" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">{{-- MUST SHOW WHAT TYPE OF ATTENDANCE--}} Attendance</h4>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="event-attendees">
              {{-- User's data here --}}
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          ...
        </div>
      </div>
    </div>
  </div>

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
          <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">

            <div class="panel">
              <div class="panel-heading" role="tab" id="headingOne_1">
                <h4 class="panel-title">
                  <a id="modal-event-title" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1" class="collapsed">
                    Event Title
                  </a>
                </h4>
              </div>
              <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                  <p id="modal-event-ptitle">&nbsb;</p>
                  <p id="modal-event-venue">&nbsb;</p>
                  <p id="modal-event-description">&nbsb;</p>
                  <p id="modal-event-organization">&nbsb;</p>
                  <p id="modal-event-category">&nbsb;</p>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>

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
