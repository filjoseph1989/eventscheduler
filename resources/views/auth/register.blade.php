@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Add User') }}</title>
@endsection

@section('css')
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
              <h2> Add New User
                <small>Form to add new system user</small>
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
              <form class="" id="add-user-form" action="" method="POST">
                {{ csrf_field() }}
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter student full name" value="{{ old('full_name') }}" required autofocus>
                        @if ($errors->has('full_name'))
                          <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="accoun_number" name="accoun_number" placeholder="Enter student account number" value="{{ old('accoun_number') }}" required>
                        @if ($errors->has('accoun_number'))
                          <span class="help-block"> <strong>{{ $errors->first('accoun_number') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter student email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-sm-8 col-sm-offset-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter student mobile number" value="{{ old('mobile_number') }}" required>
                        @if ($errors->has('mobile_number'))
                          <span class="help-block"> <strong>{{ $errors->first('mobile_number') }}</strong> </span>
                        @endif
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
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
@endsection
