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
                    @if ($eventType == 0)
                      <li><a href = "{{ route('Attendances.show', 'university') }}">University Events</a></li>
                      <li><a href = "{{ route('Attendances.show', 'organizations') }}">Organizations Events</a></li>
                    @endif
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
                      @foreach ($events as $key => $event)
                        <tr data-event="{{ $event->id }}" data-route="{{ route('Event.edit', $event->id) }}" data-action="{{ route('Event.update', $event->id) }}">
                          <td><a href="#" class="event-title" data-target="#modal-event" data-toggle="modal">{{ $event->title }}</a></td>
                          <td><button type="submit" class="event-title" data-target="#modal-official" data-toggle="modal">View</button></td> 
                          <td><button type="submit" class="event-title" data-target="#modal-expected"  data-toggle="modal">View</button></td> 
                          <td><button type="submit" class="event-title" data-target="#modal-confirmed" data-toggle="modal">View</button></td> 
                          <td><button type="submit" class="event-title" data-target="#modal-attendance"  data-toggle="modal">View</button></td>                                                 
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th><a href="#">Title</a></th>
                      {{--  <th>Venue</th>
                      <th>Organizer</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Status</th>
                      @if ($eventType == 1)
                        <th>Approve</th>
                      @endif
                      @if ($eventType == 'true' or $eventType == 'false')
                        <th> Is Approve</th>
                      @endif  --}}
                      <th>Official Attendance</th>                      
                      <th>Expected Attendance</th>                      
                      <th>Confirmed Attendance</th>                      
                      <th>Declined Attendance</th> 
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
                </div>
              </div>
            </div>

            {{-- Issue 14 --}}
            <div class="panel">
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
                      <th colspan="2">Reminders</th> {{-- Issue 4 --}}
                      <th>Audience</th> {{-- Issue 15 --}}
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="facebook">
                              <label>OFF<input type="checkbox" name="facebook" checked><span class="lever switch-col-teal"></span>ON</label> Facebook
                            </div>
                          </div>
                        </td>
                        <td>
                          {{-- Issue 4 --}}
                          <select class="form-control show-tick" name="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                          </select>
                        </td>
                        <td>
                          {{-- Issue 4 --}}
                          <select class="form-control show-tick" name="">
                            <option value="">day</option>
                            <option value="">week</option>
                            <option value="">month</option>
                            <option value="">year</option>
                          </select>
                        </td>
                        <td>
                          {{-- Issue 15 --}}
                          <select class="form-control show-tick" name="">
                            <option value="">University</option>
                            <option value="">Organization</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="twitter">
                              <label>OFF<input type="checkbox" name="twitter" checked><span class="lever switch-col-teal"></span>ON</label> Twitter
                            </div>
                          </div>
                        </td>
                        <td rowspan="4" colspan="3">Occuppied</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="email">
                              <label>OFF<input type="checkbox" name="email" checked><span class="lever switch-col-teal"></span>ON</label> Email
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="mobile">
                              <label>OFF<input type="checkbox" name="mobile" checked><span class="lever switch-col-teal"></span>ON</label> Mobile
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                    <button type="button" id="modal-event-notification" data-color="green" class="btn bg-teal waves-effect pull-right">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>

            {{-- Issue 14 --}}
            <div class="panel">
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
                            <label for="twitter_msg">Twitter Message</label>
                            <textarea rows="2" class="form-control no-resize" id="twitter_msg" name="twitter_msg" placeholder="Additional message for Twitter notification"></textarea>
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
                    <button type="button" id="modal-additional-messages" data-color="teal" class="btn bg-teal waves-effect pull-right">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-color="green" class="btn bg-teal waves-effect" data-toggle="tooltip" data-placement="top" title="Request for advertisement approval">Request Approval</button>
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>

  {{--  official attendance  --}}
    <div id="modal-official" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="event" aria-hidden="true">
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
                </div>
              </div>
            </div>

            {{-- Issue 14 --}}
            <div class="panel">
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
                      <th colspan="2">Reminders</th> {{-- Issue 4 --}}
                      <th>Audience</th> {{-- Issue 15 --}}
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="facebook">
                              <label>OFF<input type="checkbox" name="facebook" checked><span class="lever switch-col-teal"></span>ON</label> Facebook
                            </div>
                          </div>
                        </td>
                        <td>
                          {{-- Issue 4 --}}
                          <select class="form-control show-tick" name="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                          </select>
                        </td>
                        <td>
                          {{-- Issue 4 --}}
                          <select class="form-control show-tick" name="">
                            <option value="">day</option>
                            <option value="">week</option>
                            <option value="">month</option>
                            <option value="">year</option>
                          </select>
                        </td>
                        <td>
                          {{-- Issue 15 --}}
                          <select class="form-control show-tick" name="">
                            <option value="">University</option>
                            <option value="">Organization</option>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="twitter">
                              <label>OFF<input type="checkbox" name="twitter" checked><span class="lever switch-col-teal"></span>ON</label> Twitter
                            </div>
                          </div>
                        </td>
                        <td rowspan="4" colspan="3">Occuppied</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="email">
                              <label>OFF<input type="checkbox" name="email" checked><span class="lever switch-col-teal"></span>ON</label> Email
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="mobile">
                              <label>OFF<input type="checkbox" name="mobile" checked><span class="lever switch-col-teal"></span>ON</label> Mobile
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                    <button type="button" id="modal-event-notification" data-color="green" class="btn bg-teal waves-effect pull-right">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>

            {{-- Issue 14 --}}
            <div class="panel">
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
                            <label for="twitter_msg">Twitter Message</label>
                            <textarea rows="2" class="form-control no-resize" id="twitter_msg" name="twitter_msg" placeholder="Additional message for Twitter notification"></textarea>
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
                    <button type="button" id="modal-additional-messages" data-color="teal" class="btn bg-teal waves-effect pull-right">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-color="green" class="btn bg-teal waves-effect" data-toggle="tooltip" data-placement="top" title="Request for advertisement approval">Request Approval</button>
          <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
    </div>
  </div>
@endsection
  
@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
  <script src="{{ asset('js/bootstrap-select.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}"?v=0.1></script>
  <script src="{{ asset('js/jquery-datatable.js') }}"?v=0.1></script>
  <script src="{{ asset('js/bootstrap-select.js') }}"?v=0.1></script>
  <script src="{{ asset('js/sweetalert.min.js') }}"?v=0.1></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}"?v=0.1></script>
  <script src="{{ asset('js/app.js') }}?v=2.1" charset="utf-8"></script>
@endsection