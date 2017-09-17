@extends('layouts.master')

@section('page-title', 'Add New Organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-colorpicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
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
                <h2> Add New Organization</h2>
              </div>
              <div class="body">
                <form class="" action="{{ route('osa-personnel.org-store') }}" method="post">
                  {{ csrf_field() }}
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name of the organization" autofocus value="{{ old('name') }}">
                          @if ($errors->has('name'))
                            <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <textarea class="form-control no-resize" name="description" id="description" placeholder="Description">{{ old('description') }}</textarea>
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
                          <input type="text" class="form-control" id="url" name="url" placeholder="URL of the organization" value="{{ old('url') }}">
                          @if ($errors->has('url'))
                            <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="logo" name="logo" placeholder="Select the logo" value="{{ old('logo') }}">
                          @if ($errors->has('logo'))
                            <span class="help-block"> <strong>{{ $errors->first('logo') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="color" name="color" placeholder="Select the color" value="{{ old('color') }}">
                          @if ($errors->has('color'))
                            <span class="help-block"> <strong>{{ $errors->first('color') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input class="form-control event-datepicker" type="text" name="date_started" id="date_started" placeholder="Date Started" value="{{ old('date_started') }}">
                          @if ($errors->has('date_started'))
                            <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input class="form-control event-datepicker" type="text" name="date_expired" id="date_expired" placeholder="Date Expired" value="{{ old('date_expired') }}">
                          @if ($errors->has('date_expired'))
                            <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <select class="form-control show-tick" name="status" id="status">
                            <option value="">-- Please select status--</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group">
                        <button type="submit" name="save" class="btn btn-success">
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
@endsection

@section('footer')
  <script src="{{ asset('js/bootstrap-colorpicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-select.js') }}"></script>
  <script src="{{ asset('js/app.js') }}?v=0.32" charset="utf-8"></script>
@endsection
