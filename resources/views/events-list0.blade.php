@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'List of Events') }}</title>
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
              <h2>
                {{ ucwords($title) }} Events
                <small>Display organizations in the system</small>
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
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <th><a href="#">Title</a></th>
                      <th>Venue</th>
                      <th>Organizer</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <?php foreach ($events as $key => $event): ?>
                        <tr data-event="{{ $event->id }}">
                          <td><a href="#" data-target="#event" data-toggle="modal">{{ $event->title }}</a></td>
                          <td><a href="#">{{ $event->venue }}</a></td>
                          <td>
                            <?php if ($event['organization']->count() > 0): ?>
                              <?php $organization = $event['organization'][0]; ?>
                              {{ $organization->organization->name }}
                            <?php else: ?>
                              No Organization
                            <?php endif; ?>
                          </td>
                          <td>
                            {{ date('M d, Y', strtotime($event->date_start)) }} {{ date('h:i A', strtotime($event->date_start_time)) }}
                          </td>
                          <td>
                            {{ date('M d, Y', strtotime($event->date_end)) }} {{ date('h:i A', strtotime($event->date_end_time)) }}
                          </td>
                          <td>Upcoming</td>
                          <td><a href="#">Attend</a>|<a href="#">Decline</a></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <th><a href="#">Title</a></th>
                      <th>Venue</th>
                      <th>Organizer</th>
                      <th>Start</th>
                      <th>End</th>
                      <th>Status</th>
                      <th>Action</th>
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
  <div id="event" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="event" aria-hidden="true">
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
            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingOne_1">
                <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseOne_1" aria-expanded="false" aria-controls="collapseOne_1" class="collapsed">
                    Kadayawan sa UP
                  </a>
                </h4>
              </div>
              <div id="collapseOne_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_1" aria-expanded="false" style="height: 0px;">
                <div class="panel-body">
                  <p>Venue: University Gymnasium</p>
                  <p>
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute,
                    non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                    single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                    helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table,
                    raw denim aesthetic synth nesciunt you probably haven't heard of them
                    accusamus labore sustainable VHS.
                  </p>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingTwo_1">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseTwo_1" aria-expanded="false" aria-controls="collapseTwo_1">
                    Configure Social Notification
                  </a>
                </h4>
              </div>
              <div id="collapseTwo_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo_1" aria-expanded="false">
                <div class="panel-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <th>Advertising Options</th>
                      <th colspan="2">Reminders</th>
                      <th>Audience</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="facebook">
                              <label>OFF<input type="checkbox" name="facebook" checked><span class="lever switch-col-indigo"></span>ON</label> Facebook
                            </div>
                          </div>
                        </td>
                        <td>
                          <select class="form-control show-tick" name="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                          </select>
                        </td>
                        <td>
                          <select class="form-control show-tick" name="">
                            <option value="">day</option>
                            <option value="">week</option>
                            <option value="">month</option>
                            <option value="">year</option>
                          </select>
                        </td>
                        <td>
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
                              <label>OFF<input type="checkbox" name="twitter" checked><span class="lever switch-col-indigo"></span>ON</label> Twitter
                            </div>
                          </div>
                        </td>
                        <td rowspan="4" colspan="3">Occuppied</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="email">
                              <label>OFF<input type="checkbox" name="email" checked><span class="lever switch-col-indigo"></span>ON</label> Email
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="demo-switch">
                            <div class="switch" id="mobile">
                              <label>OFF<input type="checkbox" name="mobile" checked><span class="lever switch-col-indigo"></span>ON</label> Mobile
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading" role="tab" id="headingThree_1">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#collapseThree_1" aria-expanded="false" aria-controls="collapseThree_1">
                    Additional Messages
                  </a>
                </h4>
              </div>
              <div id="collapseThree_1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_1" aria-expanded="false">
                <div class="panel-body">
                  <div class="row clearfix">
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <textarea rows="4" class="form-control no-resize" id="facebook_msg" name="facebook_msg" placeholder="Additional message for Facebook Notification"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <textarea rows="4" class="form-control no-resize" id="twitter_msg" name="twitter_msg" placeholder="Additional message for Twitter notification"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <textarea rows="4" class="form-control no-resize" id="email_msg" name="email_msg" placeholder="Additional message for email notification"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-12 col-md-12">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <textarea rows="4" class="form-control no-resize" id="sms_msg" name="sms_msg" placeholder="Additional message for mobile message"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" data-color="green" class="btn bg-green waves-effect">Save Changes</button>
          <button type="button" data-color="green" class="btn bg-green waves-effect">Request Approval</button>
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
@endsection
