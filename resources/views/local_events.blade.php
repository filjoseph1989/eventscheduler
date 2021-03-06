@extends('layouts.app')

@section('title')
  <title>Local Events</title>
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
              {{ session('status') }}
            </div>
          @endif

          <div class="card">
            <div class="header">
              @if(session('account') != 'osa')
                <h2> Local Events
                  <small>Display the local events</small>
                </h2>
              @else
                <h2> Personal Events
                  <small>Display the personal events</small>
                </h2>
              @endif
            </div>
            <div class="body">
              <a href="{{ route('Event.create') }}" type="button" data-color="violet" class="btn bg-teal waves-effect pull-right"  style="margin-left:10px;">Create Event</a>
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                          <th>Title</th>
                          <th>Venue</th>
                          <th>Organizer</th>
                          <th>Date Start</th>
                          <th>Date End</th>
                          <th>Status</th>
                          <th>Approve Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (count($eventsWithin) > 0)
                        @foreach ($eventsWithin as $key => $localEvents)
                          @foreach ($localEvents as $key => $event)
                            <?php $event = (object)$event; ?>
                            <tr data-event="{{ $event->id }}"
                              data-event-type = "{{ $event->event_type_id }}"
                              data-route="{{ route('Event.edit', $event->id) }}"
                              data-action="{{ route('Event.update', $event->id) }}"
                              data-organization-id="{{ $event->organization_id }}"
                              data-user-type-id="{{ Auth::user()->user_type_id }}"
                              data-approval="{{ $event->is_approve }}">
                              <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ ucwords($event->title) }}</a></td>
                              <td>{{ $event->venue }}</td>
                              <td><?php $event->organization = (object)$event->organization; ?>{{ $event->organization->name }}</td>
                              <td>{{ date('M d, Y', strtotime($event->date_start)) }} {{ date('h:i A', strtotime($event->date_start_time)) }}</td>
                              <td>{{ date('M d, Y', strtotime($event->date_end)) }} {{ date('h:i A', strtotime($event->date_end_time)) }}</td>
                              <td>{{ $event->status }}</td>
                              <td>{{ $event->is_approve == 'true' ? 'Approved' : 'Not Yet Approved' }}</td>
                            </tr>
                          @endforeach
                        @endforeach
                      @endif

                      @if (count($eventsPersonal) > 0)
                        @foreach ($eventsPersonal as $key => $event)
                          <?php $event = (object)$event; ?>
                          <tr data-event="{{ $event->id }}"
                              data-event-type = "{{ $event->event_type_id }}"
                              data-route="{{ route('PersonalEvent.edit', $event->id) }}"
                              data-action="{{ route('PersonalEvent.update', $event->id) }}"
                              data-user-type-id="{{ Auth::user()->user_type_id }}"
                              data-approval="{{ $event->is_approve }}"
                              data-personal="true">
                            <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ ucwords($event->title) }}</a></td>
                            <td>{{ $event->venue }}</td>
                            <td>Personal</td>
                            <td>{{ date('M d, Y', strtotime($event->date_start)) }}, {{ date('h:i A', strtotime($event->date_start_time)) }}</td>
                            <td>{{ date('M d, Y', strtotime($event->date_end)) }}, {{ date('h:i A', strtotime($event->date_end_time)) }}</td>
                            <td>{{ $event->status }}</td>
                            <td>{{ $event->is_approve == 'true' ? 'Approved' : 'Not Yet Approved' }}</td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>Title</th>
                          <th>Venue</th>
                          <th>Organizer</th>
                          <th>Date Start</th>
                          <th>Date End</th>
                          <th>Status</th>
                          <th>Approve Status</th>
                        </tr>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          <h4 class="modal-title" id="event-title">Event Information</h4>
        </div>
        <div class="modal-body">
          <div class="panel-group" id="accordion_1" role="tablist" aria-multiselectable="true">
            <div class="panel">
              <div class="panel-heading" role="tab" id="headingOne_1">
                <h4 class="panel-title">
                  <a id="modal-event-title" role="button"
                    href="#collapseOne_1"
                    class="collapsed"
                    data-toggle="collapse"
                    data-parent="#accordion_1"
                    aria-expanded="false"
                    aria-controls="collapseOne_1">
                    Event Title
                  </a>
                </h4>
              </div>
              <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                  <p id="modal-event-ptitle">&nbsp;</p>
                  <p id="modal-event-venue">&nbsp;</p>
                  <p id="modal-event-description">&nbsp;</p>
                  <p id="modal-event-organization">&nbsp;</p>
                  <p id="modal-event-category">&nbsp;</p>
                </div>
              </div>
            </div>

            @if ($account == 'org-head' || $account == 'osa')
              <div class="panel social-media-notification">
                <div class="panel-heading" role="tab" id="headingTwo_1">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false" aria-controls="collapseTwo_1">
                      Configure Social Notification
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1" aria-expanded="false">
                  <div class="panel-body">
                    <form class="" action="" method="post">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <th>Advertising Options</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="demo-switch">
                                <div class="switch" id="facebook" data-personal="true">
                                  <label> OFF <input type="checkbox" name="facebook" checked> <span class="lever switch-col-teal"></span> ON </label> Facebook
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="demo-switch">
                                <div class="switch" id="twitter" data-personal="true">
                                  <label>OFF<input type="checkbox" name="twitter" checked><span class="lever switch-col-teal"></span>ON</label> Twitter
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="demo-switch">
                                <div class="switch" id="email" data-personal="true">
                                  <label>OFF<input type="checkbox" name="email" checked><span class="lever switch-col-teal"></span>ON</label> Email
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="demo-switch">
                                <div class="switch" id="sms" data-personal="true">
                                  <label>OFF<input type="checkbox" name="sms" checked><span class="lever switch-col-teal"></span>ON</label> Mobile
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
              <div class="panel social-media-notification">
                <div class="panel-heading" role="tab" id="headingThree_1">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false" aria-controls="collapseThree_1">
                      Additional Messages
                    </a>
                  </h4>
                </div>
                <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false">
                  <div class="panel-body">
                    <form class="" id="form-additional-message" action="" method="post">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <input type="hidden" name="addition_message" value="true">
                      <div class="row clearfix">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group form-float form-group">
                            <div class="form-line">
                              <label for="facebook_msg">Facebook Message</label>
                              <textarea rows="2" class="form-control no-resize" id="facebook_msg" name="facebook_msg" placeholder="Additional message for Facebook Notification"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row clearfix">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group form-float form-group">
                            <div class="form-line">
                              <label for="email_msg">Email Message</label>
                              <textarea rows="2" class="form-control no-resize" id="email_msg" name="email_msg" placeholder="Additional message for email notification"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row clearfix">
                        <div class="col-sm-12 col-md-12">
                          <div class="form-group form-float form-group">
                            <div class="form-line">
                              <label for="sms_msg">Mobile Message</label>
                              <textarea rows="2" class="form-control no-resize" id="sms_msg" name="sms_msg" placeholder="Additional message for mobile message"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="submit" id="modal-additional-messages" data-personal="true" data-color="teal" class="btn bg-teal waves-effect pull-right">Save Changes</button>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval hidden" id="modal-advertise-local-events" data-toggle="tooltip" data-placement="top" title="Advertise Local Events"
            onclick="event.preventDefault(); document.getElementById('modal-advertise-local-events-form').submit();">
            Advertise
          </button>
          <form class="" id="modal-advertise-local-events-form" action="" method="post" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" id="advertise_id" name="id" value="">
            <input type="hidden" id="advertise_category" name="category" value="">
          </form>
          @if ($account == 'org-head')
            <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval" id="modal-request-approval" data-toggle="tooltip" data-placement="top" title="Request for advertisement approval"
              onclick="event.preventDefault(); document.getElementById('modal-request-approval-form').submit();">
              Request Approval
            </button>
            <form class="" id="modal-request-approval-form" action="" method="post" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" id="id" name="id" value="">
            </form>
          @endif
          @if ($account == 'org-member')
            <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval" id="modal-attend" data-toggle="tooltip" data-placement="top" title="Attenda this event"
              onclick="event.preventDefault(); document.getElementById('modal-attend-form').submit();">
              Attend
            </button>
            <form class="" id="modal-attend-form" action="" method="post" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
            </form>
          @endif
          @if ($account == 'osa')
            {{-- <button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval" id="modal-request-approval" data-toggle="tooltip" data-placement="top" title="Request for advertisement approval"
              onclick="event.preventDefault(); document.getElementById('modal-request-approval-form').submit();">
              Request Approval
            </button>  --}}
            <form class="" id="modal-request-approval-form" action="" method="post" style="display: none;">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <input type="hidden" id="id" name="id" value="">
            </form>
          @endif
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
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
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.31" charset="utf-8"></script>
@endsection
