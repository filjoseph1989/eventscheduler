@extends('layouts.master')

@section('page-title', 'Edit Organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-colorpicker.css') }}">
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
                <h2> Update {{ $organization->name }} Information</h2>
              </div>
              <div class="body">
                <form class="" action="{{ route('osa-personnel.org-update') }}" method="post">
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $organization->id }}">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name of the organization" value="{{ old('name') != null ? old('name') : $organization->name }}" required autofocus>
                          @if ($errors->has('name'))
                            <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="description" name="description" placeholder="Description of the organization" value="{{ old('description') != null ? old('description') : $organization->description }}">
                          @if ($errors->has('description'))
                            <span class="help-block"> <strong>{{ $errors->first('description') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="url" name="url" placeholder="URL of the organization" value="{{ old('url') != null ? old('url') : $organization->url }}">
                          @if ($errors->has('url'))
                            <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="color" name="color" placeholder="Color of the organization" value="{{ old('color') != null ? old('color') : $organization->color }}">
                          @if ($errors->has('color'))
                            <span class="help-block"> <strong>{{ $errors->first('color') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control event-datepicker" id="date_started" name="date_started" placeholder="Select Date Start" value="{{ old('date_started') != null ? old('date_started') : $organization->date_started }}" data-dtp="dtp_mR6wO">
                          @if ($errors->has('date_started'))
                            <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control event-datepicker" id="date_expired" name="date_expired" placeholder="Select Date Start" value="{{ old('date_expired') != null ? old('date_expired') : $organization->date_expired }}" data-dtp="dtp_mR6wO">
                          @if ($errors->has('date_expired'))
                            <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <select class="form-control" name="status">
                            {{-- First Option --}}
                            @if ($organization->status == 'active')
                              <option value="active">Active</option>
                            @else
                              <option value="inactive">Inactive</option>
                            @endif

                            {{-- Second Option --}}
                            @if ($organization->status == 'active')
                              <option value="inactive">Inactive</option>
                            @else
                              <option value="active">Active</option>
                            @endif
                          </select>
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <button type="submit" class="btn btn-success" name="button"><i class="material-icons">save</i> Save</button>
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
@endsection

@section('footer')
  <script src="{{ asset('js/bootstrap-colorpicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
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
    $('#color').colorpicker();
  </script>
@endsection
