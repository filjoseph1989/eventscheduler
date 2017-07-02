@extends('layouts.master')

@section('page-title', 'List of Organizations')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/waitMe.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
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
            {{ session('status') }}
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


      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Add New Organization </h2>
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
                <form class="" id="organization-registration" role="form" method="POST" action="{{ route('admin.organization.register') }}">
                  {{ csrf_field() }}
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="true" autofocus>
                          <label class="form-label">Organization Name</label>
                          @if ($errors->has('name'))
                          <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="form-control" name="url" value="{{ old('url') }}" required="true" autofocus>
                          <label class="form-label">URL</label>
                          @if ($errors->has('url'))
                            <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group{{ $errors->has('date_started') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="datepicker form-control" name="date_started" value="{{ old('date_started') }}" required="true" placeholder="Date Started">
                          @if ($errors->has('date_started'))
                            <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group{{ $errors->has('date_expired') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="datepicker form-control" name="date_expired" value="{{ old('date_expired') }}" required="true" placeholder="Date Expired">
                          @if ($errors->has('date_expired'))
                          <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <select class="form-control" name="status">
                            <option value="0">-- Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                          @if ($errors->has('status'))
                          <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <button type="submit" class="btn btn-success">
                        <i class="material-icons">save</i> Save
                      </button>
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
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });
  </script>
@endsection
