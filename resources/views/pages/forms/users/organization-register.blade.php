@extends('layouts.master')

@section('page-title', 'Organization Registration')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
  <link rel="stylesheet" href="{{ asset('css/waitMe.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
  @include('pages.top-nav')

  @if (isset($login_type) and $login_type == 'user'))
      @include('pages.users.sidebar')
  @elseif (isset($login_type) and $login_type == 'admin')
      @include('pages.admin.sidebar')
  @endif

  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                  <h2 id="heading-schedule">Organization Registration</h2>
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
              <form class="" role="form" method="POST" action="{{ route('user.organization.registered') }}">
                  {{ csrf_field() }}

                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="name">
                        <label class="form-label">Name</label>
                        @if ($errors->has('name'))
                          <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="status">
                        <label class="form-label">Status</label>
                        @if ($errors->has('status'))
                          <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="url">
                        <label class="form-label">Url</label>
                        @if ($errors->has('url'))
                          <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('date_started') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="date_started">
                        <label class="form-label">Date Active</label>
                        @if ($errors->has('date_started'))
                          <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group{{ $errors->has('date_expired') ? ' has-error' : '' }}">
                      <div class="form-line">
                        <input type="text" class="form-control" name="date_expired">
                        <label class="form-label">Date Inactive</label>
                        @if ($errors->has('date_expired'))
                          <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button href="" type="submit" class="btn btn-success" name="button">
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

@section('footer')
  <script src="{{ asset('js/bootstrap-select.js') }}" charset="utf-8"></script>
@endsection
