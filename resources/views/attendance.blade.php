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
              <h2>
                {{--  {{ ucwords($title) }}   --}}
                Events for List of Attendance
                <small>Display events in the system</small>
              </h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    @if ($eventType == 'official' || $eventType == 'university' || $eventType == 'organizations')
                      <li><a href = "{{ route('Attendances.show', 'university') }}">University Events</a></li>
                      <li><a href = "{{ route('Attendances.show', 'organizations') }}">Organizations Events</a></li>
                    @endif ($eventType == 'local')
                      {{--  @foreach ($user_orgs as $key => $org)  --}}
                          {{--  magwork na ni pag naa nay auth  --}}
                        {{--  <li><a href = "{{ route('Attendances.show', '{{ $org->organization_id }}') }}">My Org: {{ $value->organization->name }} Events</a></li>                      --}}
                      {{--  @endforeach  --}}
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  @php extract($helper::dataTableClass($events)); @endphp
                  <table class="table table-bordered table-striped table-hover {{ $class }}">
                    <thead>
                      <th><a href="#">Title</a></th>
                      <th>Official Attendance</th>
                      <th>Expected Attendance</th>
                      <th>Confirmed Attendance</th>
                      <th>Declined Attendance</th>
                    </thead>
                    <tbody>
                      @foreach ($events as $key => $event)
                        <tr data-event="{{ $event->id }}" data-route="{{ route('Event.edit', $event->id) }}" data-action="{{ route('Event.update', $event->id) }}">
                          <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ $event->title }}</a></td>
                          <td><button type="submit" class="btn btn-success event-attendance-official" data-target="#modal-official" data-toggle="modal">View</button></td>
                          <td><button type="submit" class="btn btn-success event-attendance-expected" data-target="#modal-expected"  data-toggle="modal">View</button></td>
                          <td><button type="submit" class="btn btn-success event-attendance-confirmed" data-target="#modal-confirmed" data-toggle="modal">View</button></td>
                          <td><button type="submit" class="btn btn-success event-attendance-declined" data-target="#modal-declined"  data-toggle="modal">View</button></td>
                        </tr>
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
  <div id="modal-official" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Official Attendance</h4>
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
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.6"></script>
@endsection
