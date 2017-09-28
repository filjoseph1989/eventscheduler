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
              <form class="" id="add-event-form" action="{{ route('Event.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
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
                        <input type="text" class="form-control event-datepicker" id="date_start" name="date_start" placeholder="Select Date Start" value="" data-dtp="dtp_mR6wO">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-timepicker" id="date_start_time" name="date_start_time" placeholder="Select Time Start" value="" data-dtp="dtp_Ty5Ak">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-datepicker" id="date_end" name="date_end" placeholder="Select Date End" value="" data-dtp="dtp_WVmA7">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control event-timepicker" id="date_end_time" name="date_end_time" placeholder="Select Time End" value="" data-dtp="dtp_Cymge">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="whole-day" name="whole_day">
                          <option value="0" id="whole_day-option">-- Whole day? --</option>
                          <option value="1">YES</option>
                          <option value="0">NO</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="button">
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
@endsection

@section('js')
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
@endsection
