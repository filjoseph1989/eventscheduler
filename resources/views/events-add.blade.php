@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Add Events') }}</title>
@endsection

@section('css')
  <link href="{{ asset('css/bootstrap-material-datetimepicker.css') }}?v=1.0.1" rel="stylesheet">
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('status') }}
            </div>
          @endif
          @if (session('status_warning'))
            <div class="alert alert-warning" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Dismiss alert">
                <span aria-hidden="true">&times;</span>
              </button>
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
              <h2> Add New Events
                <small>This form used to register new event in the system</small>
              </h2>
            </div>
            <div class="body">
              <form class="" id="add-event-form" action="{{ route('Event.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title of the event" value="{{ old('title') }}" required autofocus>
                        <input type="hidden" class="form-control" id="user_id" name="user_id"  value="{{ Auth::id() }}" required>
                        @if ($errors->has('title'))
                          <span class="help-block"> <strong>{{ $errors->first('title') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" id="description" name="description" required placeholder="Description of the event">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                          <span class="help-block"> <strong>{{ $errors->first('description') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue" value="{{ old('venue') }}" required>
                        @if ($errors->has('vanue'))
                          <span class="help-block"> <strong>{{ $errors->first('vanue') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-datepicker" id="date_start" name="date_start" placeholder="Select Date Start" value="{{ old('date_start') }}">
                        @if ($errors->has('date_start'))
                          <span class="help-block"> <strong>{{ $errors->first('date_start') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-timepicker" id="date_start_time" name="date_start_time" placeholder="Select Time Start" value="{{ old('date_start_time') }}">
                        @if ($errors->has('date_start_time'))
                          <span class="help-block"> <strong>{{ $errors->first('date_start_time') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-datepicker" id="date_end" name="date_end" placeholder="Select Date End" value="{{ old('date_end') }}">
                        @if ($errors->has('date_end'))
                          <span class="help-block"> <strong>{{ $errors->first('date_end') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-timepicker" id="date_end_time" name="date_end_time" placeholder="Select Time End" value="{{ old('date_end_time') }}">
                        @if ($errors->has('date_end_time'))
                          <span class="help-block"> <strong>{{ $errors->first('date_end_time') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="category" name="category">
                          <option value="{{ old('category') }}" id="event-category-option">-- Select Event Category --</option>
                          @if(Auth::user()->user_type_id != 2)
                            <option value="university"> University </option>
                            <option value="organization"> Organizations </option>
                          @endif
                          @if(Auth::user()->user_type_id == 1)
                            {{--  user_type_id == 1 is org-head, because only the organization-head can create within organization events  --}}
                            <option value="within"> My Organization </option>
                          @endif
                          <option value="personal"> Personal </option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/autosize.js') }}?v=0.1"></script>
  <script src="{{ asset('js/moment.js') }}?v=0.1"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}?v=0.1"></script>
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.24"></script>
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
