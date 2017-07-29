@extends('layouts.master')

@section('page-title', 'Create New Event')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif
        @if (session('status_warning'))
          <div class="alert alert-warning">{{ session('status_warning') }}</div>
        @endif
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> NEW EVENTS </h2>
              </div>
              <div class="body">
                <form class="" id="add-event-form" action="{{ route('org-adviser.event.new') }}" method="POST">
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      {{ csrf_field() }}
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" name="from_calendar" value="1">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="title" name="title" placeholder="Title of the event" value="{{ old('title') }}" required autofocus>
                          @if ($errors->has('title'))
                            <span class="help-block"> <strong>{{ $errors->first('title') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <textarea rows="4" class="form-control no-resize" id="description" name="description" required placeholder="Description of the event">{{ old('description') }}</textarea>
                          @if ($errors->has('description'))
                            <span class="help-block"> <strong>{{ $errors->first('description') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue" value="{{ old('venue') }}" required>
                          @if ($errors->has('venue'))
                            <span class="help-block"> <strong>{{ $errors->first('venue') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control event-datepicker" id="date_start" name="date_start" placeholder="Select Date Start" value="{{ old('date_start') }}" data-dtp="dtp_mR6wO">
                          @if ($errors->has('date_start'))
                            <span class="help-block"> <strong>{{ $errors->first('date_start') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control event-timepicker" id="date_start_time" name="date_start_time" placeholder="Select Time Start" value="{{ old('date_start_time') }}" data-dtp="dtp_Ty5Ak">
                          @if ($errors->has('date_start_time'))
                            <span class="help-block"> <strong>{{ $errors->first('date_start_time') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control event-datepicker" id="date_end" name="date_end" placeholder="Select Date End" value="{{ old('date_end') }}" data-dtp="dtp_WVmA7">
                          @if ($errors->has('date_end'))
                            <span class="help-block"> <strong>{{ $errors->first('date_end') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control event-timepicker" id="date_end_time" name="date_end_time" placeholder="Select Time End" value="{{ old('date_end_time') }}" data-dtp="dtp_Cymge">
                          @if ($errors->has('date_end_time'))
                            <span class="help-block"> <strong>{{ $errors->first('date_end_time') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float">
                        <div class="form-line focused">
                          <select class="form-control show-tick" id="whole-day" name="whole_day">
                            <option value="0">-- Whole day? --</option>
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line focused">
                          <select class="form-control show-tick" id="event-type" name="event_type_id">
                            <option value="0">-- Select type of event--</option>
                            @foreach ($event_type as $key => $value)
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line focused">
                          <select class="form-control show-tick" id="event-category" name="event_category_id">
                            <option value="0">-- Select audience for this event--</option>
                            @foreach ($event_category as $key => $value)
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group form-float form-group" id="form-event-organization">
                        <div class="form-line focused">
                          <select class="form-control show-tick" id="event-organization" name="organization_id">
                            <option value="0">-- Select Organization --</option>
                            @foreach ($organization as $key => $value)
                              <option value="{{ $value->organization->id }}">{{ $value->organization->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group form-float form-group" id="form-event-semester">
                        <div class="form-line focused">
                          <select class="form-control show-tick" id="event-organization" name="semester">
                            <option value="0">-- Select Semester --</option>
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
@endsection

@section('modal')
  <div class="modal fade" id="view-event" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="view-event-title">{{-- Events title goes here --}}</h4>
        </div>
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Column</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody id="event-details">
                  {{-- Event Content Here --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="material-icons"></i> Close
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="add-event-form" action="{{ route('event.new') }}" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Create New Event</h4>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="from_calendar" value="1">
                <div class="form-group form-float form-group">
                  <div class="form-line">
                    <input type="text" class="form-control" id="event" name="event" placeholder="Name of the event" value="" required="true" autofocus="">
                  </div>
                </div>
                <div class="form-group form-float form-group">
                  <div class="form-line">
                    <textarea rows="4" class="form-control no-resize" id="description" name="description" placeholder="Description of the event"></textarea>
                  </div>
                </div>
                <div class="form-group form-float form-group">
                  <div class="form-line">
                    <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue" value="">
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
                      <option value="0">-- Whole day? --</option>
                      <option value="1">YES</option>
                      <option value="0">NO</option>
                    </select>
                  </div>
                </div>
                <div class="form-group form-float form-group">
                  <div class="form-line focused">
                    <select class="form-control show-tick" id="event-type" name="event_type_id">
                      <option value="0">-- Select type of event--</option>
                      <option value="1">Conference</option>
                      <option value="2">Symposium</option>
                      <option value="3">Siminar</option>
                      <option value="4">Workshop</option>
                    </select>
                  </div>
                </div>
                <div class="form-group form-float form-group">
                  <div class="form-line focused">
                    <select class="form-control show-tick" id="event-category" name="event_category_id">
                      <option value="0">-- Select audience for this event--</option>
                      <option value="1">public view</option>
                      <option value="2">within organizations</option>
                      <option value="3">among organizations</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">
              <i class="material-icons">save</i> Save
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="material-icons">close</i> Close
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.14" charset="utf-8"></script>
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
