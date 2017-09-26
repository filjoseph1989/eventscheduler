<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Home Page') }}</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/bootstrap.css') }}?v=3.3.8" rel="stylesheet">
  <link href="{{ asset('css/waves.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/animate.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-material-datetimepicker.css') }}?v=1.0.1" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}?v=1.0.1" rel="stylesheet">

  {{-- Remove Me --}}
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
</head>
<body class="theme-brown">

  @include ('templates/top-navigation')

  @include ('templates/sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                Add New Events
                <small>This form used to register new event in the system</small>
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
                <div class="col-sm-8 col-sm-offset-2">
                  <form class="" id="add-event-form" action="" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title of the event" value="" required autofocus>
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" id="description" name="description" required placeholder="Description of the event"></textarea>
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue" value="" required>
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-datepicker" id="date_start" name="date_start" placeholder="Select Date Start" value="" data-dtp="dtp_mR6wO">
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-timepicker" id="date_start_time" name="date_start_time" placeholder="Select Time Start" value="" data-dtp="dtp_Ty5Ak">
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-datepicker" id="date_end" name="date_end" placeholder="Select Date End" value="" data-dtp="dtp_WVmA7">
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-timepicker" id="date_end_time" name="date_end_time" placeholder="Select Time End" value="" data-dtp="dtp_Cymge">
                      </div>
                    </div>
                    <div class="form-group form-float">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="whole-day" name="whole_day">
                          <option value="0" id="whole_day-option">-- Whole day? --</option>
                          <option value="1">YES</option>
                          <option value="0">NO</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="event_type_id" name="event_type_id">
                          <option value="0" id="event_type_id-option">-- Select type of event--</option>
                          <option value="2">Conference</option>
                          <option value="3">Symposium</option>
                          <option value="4">Siminar</option>
                          <option value="5">Workshop</option>
                          <option value="6">Sample 2</option>
                          <option value="7">Sample 3</option>
                          <option value="8">Sample 4</option>
                          <option value="9">Sample 5</option>
                          <option value="10">Sample 6</option>
                          <option value="11">Sample 7</option>
                          <option value="12">Sample 8</option>
                          <option value="13">Sample 9</option>
                          <option value="14">Sample 10</option>
                          <option value="15">Sample 11</option>
                          <option value="16">Sample 12</option>
                          <option value="17">Sample 13</option>
                          <option value="18">Sample 14</option>
                          <option value="19">Sample 15</option>
                          <option value="20">Sample 16</option>
                          <option value="21">Sample 17</option>
                          <option value="22">Sample 18</option>
                          <option value="23">Sample 19</option>
                          <option value="24">Sample 20</option>
                          <option value="25">Sample 21</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float form-group">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="event_category_id" name="event_category_id">
                          <option value="0" id="event_category_id-option">-- Select audience for this event --</option>
                          <option value="1">public view</option>
                          <option value="2">within organizations</option>
                          <option value="3">all organizations</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float form-group" id="form-event-organization">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="organization_id" name="organization_id">
                          <option value="0" id="organization-option">-- Select Organization --</option>
                          <option value="2">Alpha Phi Omega</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group form-float form-group" id="form-event-semester">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="semester" name="semester">
                          <option value="0" id="semester-option">-- Select Semester --</option>
                          <option value="first">First Semester</option>
                          <option value="second">Second Semester</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <h4>Notification</h4>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="demo-switch">
                      <div class="switch" id="facebook">
                        <label>OFF<input type="checkbox" name="notify_via_facebook" checked><span class="lever switch-col-indigo"></span>ON</label> Facebook
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" id="description" name="additional_msg_facebook" required placeholder="Additional message in the facebook notification"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="demo-switch">
                      <div class="switch" id="twitter">
                        <label>OFF<input type="checkbox" name="notify_via_twitter" checked><span class="lever switch-col-blue"></span>ON</label> Twitter
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="demo-switch">
                      <div class="switch" id="email">
                        <label>OFF<input type="checkbox" name="notify_via_email" checked><span class="lever switch-col-teal"></span>ON</label> Email
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" id="description" name="additional_msg_email" required placeholder="Additional message in the email notification"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="demo-switch">
                      <div class="switch" id="phone">
                        <label>OFF<input type="checkbox" name="notify_via_sms" checked><span class="lever switch-col-pink"></span>ON</label> Phone
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" id="description" name="additional_msg_sms" required placeholder="Additional message in the SMS notification"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <button type="submit" class="btn btn-primary">
                        <i class="material-icons">save</i> Save
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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

  <script src="{{ asset('js/jquery.min.js') }}?v=3.2.2"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}?v=3.3.8"></script>
  <script src="{{ asset('js/waves.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}?v=0.1"></script>
  <script src="{{ asset('js/autosize.js') }}"?v=0.1></script>
  <script src="{{ asset('js/moment.js') }}"?v=0.1></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}"?v=0.1></script>
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
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
</body>
</html>
