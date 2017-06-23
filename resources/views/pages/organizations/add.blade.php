@extends('layouts.master')

@section('page-title', 'User Registration')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
  @include('pages.top-nav')

  @include('pages.sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                  <h2 id="heading-schedule">Register Organization</h2>
                </div>
              </div>
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
              <form class="" role="form" method="POST" action="">
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="name">
                        <label class="form-label">Organization Name</label>
                        @if ($errors->has('name'))
                          <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                          <div class="form-line">
                              <input type="text" class="form-control" name="url">
                              <label class="form-label">URL</label>
                              @if ($errors->has('url'))
                              <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                              @endif
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('date_started') ? ' has-error' : '' }}">
                        <div class="form-line">
                            <input type="text" class="datepicker form-control" name="date_started" placeholder="Date Started">
                            @if ($errors->has('date_started'))
                                <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                            @endif
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('date_expired') ? ' has-error' : '' }}">
                        <div class="form-line">
                            <input type="text" class="datepicker form-control" name="date_expired" placeholder="Date Expired">
                            @if ($errors->has('date_expired'))
                                <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                            @endif
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                          <div class="form-line">
                              <select class="form-control show-tick" name="status">
                                  <option value="0">-- Status --</option>
                                  <option value="0">Active</option>
                                  <option value="1">Inactive</option>
                              </select>
                              @if ($errors->has('status'))
                              <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                              @endif
                          </div>
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

@section('footer')
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    <script src="{{asset('js/autosize.js')}}"></script>
    <script src="{{asset('js/moment.js')}}"></script>
    <script src="{{asset('js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('js/basic-form-elements.js')}}"></script>
@endsection
