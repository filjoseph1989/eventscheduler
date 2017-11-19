@extends('layouts.app')

@section('title')
  <title>List of Events</title>
@endsection

@section('css')
  <link href="{{ asset('css/bootstrap-material-datetimepicker.css') }}?v=1.0.1" rel="stylesheet">
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
              {{ session('status') }}
            </div>
          @endif

          @if (session('status_warning'))
            <div class="alert alert-warning" role="alert">
              {{ session('status_warning') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-warning" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Please fix the following error(s)</strong>
              <ul>
                @foreach ($errors->all() as $key => $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="card">
            <div class="header">
              <h2> {{ ucwords($title) }} Events
                <?php
                  $type               = "All the";
                  $thirdPersonAddress = "your";

                  if ($eventType == 1) {
                    $type = 'Official';
                  }
                  if ($eventType == 2) {
                    $type = 'Local';
                  }
                  if (session('account') == 'osa') {
                    $thirdPersonAddress = "";
                  }
                ?>
                <small>
                  Showing {{ $type }} events {{ $eventType != 1 ? "created by $thirdPersonAddress Organization(s)" : "" }}
                  @if (session('account') == 'org-member' and $eventType != 1)
                    , the University and other organization you'd like to attend
                  @endif
                </small>
              </h2>
              @if ($eventType == 0 AND (session('account') == 'org-head' OR session('account') == 'osa'))
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="{{ route('Event.show', 'true') }}">Approved Events</a></li>
                      <li><a href="{{ route('Event.show', 'false') }}">Disapproved Events</a></li>
                    </ul>
                  </li>
                </ul>
              @endif
            </div>
            <div class="body">
              @if ($account == 'org-head')
                <a href="{{ route('Event.create') }}" type="button" data-color="violet" class="btn bg-teal waves-effect pull-right" style="margin-left:10px;">Create Event</a>
              @endif
              @if ( session('account') == 'osa')
                <button class="bg-teal waves-effect btn pull-right" data-toggle="modal" data-target="#edit-notification-modal" style="margin-left: 10px">Edit Notification</button>
                <a href="{{ route('Event.create') }}" type="button" data-color="violet" class="btn bg-teal waves-effect pull-right"  >Create Event</a>
              @endif
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Organizer</th>
                        <th>Type</th>
                        <th>Start</th>
                        <th>End</th>
                        @if ($account != 'org-member')
                          <th>Status</th>
                        @endif
                    </thead>
                    <tbody>
                      @if( session('account') != 'org-member' )
                        @if (! is_null($events))
                          @foreach ($events as $key => $event)
                            <tr data-event="{{ $event->id }}"
                                data-route="{{ route('Event.edit', $event->id) }}"
                                data-action="{{ route('Event.update', $event->id) }}"
                                data-organization-id="{{ $event->organization_id }}"
                                data-event-type-id="{{ $event->event_type_id }}"
                                data-user-type-id="{{ Auth::user()->user_type_id }}"
                                data-approval="{{ $event->is_approve }}"
                                data-account="{{ Auth::id() }}">
                              <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ ucwords($event->title) }}</a></td>
                              <td>{{ $event->venue }}</td>
                              <td>{{ ! is_null($event->organization) ? $event->organization->name : 'University Official Event' }}</td>
                              <td>{{ $event->eventType->name }}</td>
                              <td>{{ date('M d, Y', strtotime($event->date_start)) }} {{ date('h:i A', strtotime($event->date_start_time)) }}</td>
                              <td>{{ date('M d, Y', strtotime($event->date_end)) }} {{ date('h:i A', strtotime($event->date_end_time)) }}</td>
                              @if ($account == 'org-member')
                                <td>{{ ucwords($event->status) }}</td>
                              @else
                                <td>{{ ($event->is_approve == 'true') ? 'Approved' : 'Not' }}</td>
                              @endif
                            </tr>
                          @endforeach
                        @endif
                      @else
                        @foreach ($events as $key => $event)
                          <tr data-event="{{ $event->id }}"
                              data-route="{{ route('Event.edit', $event->id) }}"
                              data-action="{{ route('Event.update', $event->id) }}"
                              data-organization-id="{{ $event->organization_id }}"
                              data-event-type-id="{{ $event->event_type_id }}"
                              data-user-type-id="{{ Auth::user()->user_type_id }}"
                              data-approval="{{ $event->is_approve }}"
                              data-account="{{ Auth::id() }}">
                            <td>
                              <a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">
                                {{ $event->title }}
                              </a>
                            </td>
                            <td>{{ $event->venue }}</td>
                            <td>{{ ! is_null($event->organization) ? $event->organization->name : 'University Official Event' }}</td>
                            <td>{{ ($event->event_type_id == 1) ? 'Official' : 'Local' }}</td>
                            <td>{{ date('M d, Y', strtotime($event->date_start)) }}</td>
                            <td>{{ date('M d, Y', strtotime($event->date_end)) }}</td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                    <tfoot>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Organizer</th>
                        <th>Type</th>
                        <th>Start</th>
                        <th>End</th>
                        @if ($account != 'org-member')
                          <th>Status</th>
                        @endif
                    </tfoot>
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
          @if ($account != 'org-member')
            <form class="" action="" method="post">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger pull-right hidden" id="delete-event" name="button">Delete</button>
            </form>
            <button type="button" class="btn btn-primary pull-right hidden" id="edit-event" name="button">Edit</button>
            <button type="button" class="btn btn-primary pull-right hidden" id="cancel-edit-event" name="button">Cancel</button>
          @endif
          <table class="table" id="modal-event-table">
            <thead>
              <tr> <th id="modal-event-title"></th> </tr>
            </thead>
            <tbody>
              <tr> <td id="modal-event-ptitle"></td> </tr>
              <tr> <td id="modal-event-venue">&nbsp;</td> </tr>
              <tr> <td id="modal-event-description">&nbsp;</td> </tr>
              <tr> <td id="modal-event-organization">&nbsp;</td> </tr>
              <tr> <td id="modal-event-category">&nbsp;</td> </tr>
            </tbody>
          </table>
          @if ($account != 'org-member')
            <form class="hidden" id="edit-event-form" action="" method="POST">
              {{ csrf_field() }}
              <div id="fields"></div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <input type="hidden" id="event-id" name="id" value="">
                      <input type="text" class="form-control" id="title" name="title" placeholder="Title of the event" value="" required autofocus>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <textarea rows="4" class="form-control no-resize" id="description" name="description" required placeholder="Description of the event"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue" value="" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <input type="text" class="form-control event-datepicker" id="date_start" name="date_start" placeholder="Select Date Start" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <input type="text" class="form-control event-timepicker" id="date_start_time" name="date_start_time" placeholder="Select Time Start" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <input type="text" class="form-control event-datepicker" id="date_end" name="date_end" placeholder="Select Date End" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float form-group">
                    <div class="form-line">
                      <input type="text" class="form-control event-timepicker" id="date_end_time" name="date_end_time" placeholder="Select Time End" value="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group form-float">
                    <div class="form-line focused" id="div-category">{{-- Options Here --}}</div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="type" value="edit-event">
              <input type="hidden" name="user_id" value="{{ Auth::id() }}">
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="form-group">
                    <button type="button" class="btn btn-primary" id="save-event" name="button">
                      <i class="material-icons">save</i> Save
                    </button>
                  </div>
                </div>
              </div>
            </form>
            <div class="hidden" id="fields-hidden">
              {{ method_field('PUT') }}
            </div>
          @endif
        </div>
        <div class="modal-footer">
          @if (session('account') == 'org-head')
            <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval hid" id="modal-request-approval" data-toggle="tooltip" data-placement="top" title="Request for advertisement approval"
              onclick="event.preventDefault(); document.getElementById('modal-request-approval-form').submit();">
              Request Approval
            </button>
            <form class="" id="modal-request-approval-form" action="" method="post" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" id="id" name="id" value="">
            </form>
          @endif
          @if (session('account') != 'osa' )
            <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval" id="modal-attend" data-toggle="tooltip" data-placement="top" title="Attenda this event"
              onclick="event.preventDefault(); document.getElementById('modal-attend-form').submit();">
              Attend
            </button>
            <form class="" id="modal-attend-form" action="" method="post" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
            </form>
          @else
            <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval hidden" id="modal-advertise-official-events" data-toggle="tooltip" data-placement="top" title="Advertise Official Events"
              onclick="event.preventDefault(); document.getElementById('modal-advertise-official-events-form').submit();">
              Advertise
            </button>
            <form class="" id="modal-advertise-official-events-form" action="" method="post" style="display: none;">
              {{ csrf_field() }}
              <input type="hidden" id="advertise_id" name="id" value="">
              <input type="hidden" id="advertise_category" name="category" value="">
            </form>
          @endif
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>
  <div id="edit-notification-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="event" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="event-title">Edit Event Notification</h4>
        </div>
        <div class="modal-body">
          <div class="list-group">
            <a href="{{ route('EventNotification.show', 1) }}" class="list-group-item"> Edit Notification Settings of Official Events </a>
            @if(Auth::user()->user_type_id != 1)
              <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"> Edit Notification Settings of Personal Events </a>
            @else
              <a href="{{ route('EventNotification.show', 2) }}" class="list-group-item"> Edit Notification Settings of Local Events </a>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/autosize.js') }}?v=0.1"></script>
  <script src="{{ asset('js/moment.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.26" charset="utf-8"></script>
  <script type="text/javascript">
    $('.event-datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });

    $('.event-timepicker').bootstrapMaterialDatePicker({
      format: 'HH:mm',
      clearButton: true,
      date: false
    });
  </script>
@endsection
