@extends('layouts.master')

@section('page-title', 'User Registration')

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
                  <h2 id="heading-schedule">User Account Registration</h2>
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
              <form class="" role="form" method="POST" action="{{ route('user-account.registered') }}">
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
