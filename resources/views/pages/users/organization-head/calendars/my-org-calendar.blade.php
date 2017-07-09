@extends('layouts.master')

@section('page-title', 'Manage Notification')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}?v=0.1">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.print.css') }}?v=0.1">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
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
                  My Organization Calendar
                  <small>Dropdown to choose the what specific organization among your organizations</small>
                  <small>Enable Add Event Functionality if you are the head of that org</small>
                </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="{{ route('university-calendar') }}">University Calendar</a></li>
                      <li><a href="{{ route('all-organization-calendar') }}">All Organizations Calendar</a></li>
                      <li><a href="{{ route('my-organization-calendar') }}">My Organization Calendar</a></li>
                      <li><a href="{{ route('my-personal-calendar') }}">My Personal Calendar</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="body">
                <div id='calendar'></div>
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
  <div class="modal fade" id="add-event" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="add-event-form" action="{{ route('event.new') }}" method="POST">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Create Event</h4>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group form-float form-group{{ $errors->has('event') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" id="event" name="event" placeholder="Name of the event" value="{{ old('event') }}" required="true" autofocus>
                    @if ($errors->has('event'))
                      <span class="help-block"> <strong>{{ $errors->first('event') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <textarea rows="4" class="form-control no-resize" id="description" placeholder="Description of the event">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                      <span class="help-block"> <strong>{{ $errors->first('description') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" id="venue" placeholder="Venue" name="" value="{{ old('venue') }}">
                    @if ($errors->has('venue'))
                      <span class="help-block"> <strong>{{ $errors->first('venue') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_start') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control event-datepicker" id="date_start" name="date_start" placeholder="Select Date Start" value="{{ old('date_start') }}">
                    @if ($errors->has('date_start'))
                      <span class="help-block"> <strong>{{ $errors->first('date_start') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_start_time') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control event-timepicker" id="date_start_time" name="date_start_time" placeholder="Select Time Start" value="{{ old('date_start_time') }}">
                    @if ($errors->has('date_start_time'))
                      <span class="help-block"> <strong>{{ $errors->first('date_start_time') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control event-datepicker" id="date_end" name="date_end" placeholder="Select Date End" value="{{ old('date_end') }}">
                    @if ($errors->has('date_end'))
                      <span class="help-block"> <strong>{{ $errors->first('date_end') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_end_time') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control event-timepicker" id="date_end_time" name="date_end_time" placeholder="Select Time End" value="{{ old('date_end_time') }}">
                    @if ($errors->has('date_end_time'))
                      <span class="help-block"> <strong>{{ $errors->first('date_end_time') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float">
                  <div class="form-line">
                    <select class="form-control show-tick" id="whole-day" name="whole_day">
                      <option value="0">-- Whole day? --</option>
                      <option value="1">YES</option>
                      <option value="0">NO</option>
                    </select>
                    @if ($errors->has('event_type'))
                      <span class="help-block"> <strong>{{ $errors->first('event_type') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('event_type') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <select class="form-control show-tick" id="event-type" name="event_id">
                      <option value="0">-- Select type of event--</option>
                      @foreach ($event_type as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('event_type'))
                      <span class="help-block"> <strong>{{ $errors->first('event_type') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('event_categories') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <select class="form-control show-tick" id="event-type" name="event_id">
                      <option value="0">-- Select type of event--</option>
                      @foreach ($event_categories as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('event_categories'))
                      <span class="help-block"> <strong>{{ $errors->first('event_categories') }}</strong></span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="save-event" class="btn btn-primary"> <i class="material-icons">save</i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="material-icons">close</i>
              Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery-ui-1.10.2.custom.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/basic-form-elements.js') }}?v=0.2" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/master.js') }}?v=0.4" charset="utf-8"></script>
@endsection
