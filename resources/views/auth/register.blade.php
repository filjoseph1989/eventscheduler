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
                    {{-- Options here --}}
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <form class="" id="add-user-form" action="{{ route('User.store') }}" method="POST"> 
                {{ csrf_field() }}
                <div class="row clearfix" id="input1">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="account_number" name="account_number[]" placeholder="Enter student number" value="{{ old('account_number') }}" required autofocus>
                        @if ($errors->has('account_number'))
                          <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name[]" placeholder="Enter student full name" value="{{ old('full_name') }}" required autofocus>
                        @if ($errors->has('full_name'))
                          <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="email" name="email[]" placeholder="Enter student email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-group form-float">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="position_id" name="position_id[]">
                          <option value="{{ old('position_id') }}" id="position-option">- Select Position -</option>
                          @foreach ($positions as $key => $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="b1" class="btn btn-success add-field" type="button" data-toggle="tooltip" data-placement="top" title="Add Form Field">+</button>
                  </div>
                </div>
                <div class="row clearfix">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary pull-right" type="submit" name="save"><i class="material-icons">save</i> Save</button>
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
{{--  The following html is used for adding dynamic inputs  --}}
<div class="" id="registration-form-template" style="display:none;">
  <div class="row clearfix" id="templateid">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="form-group form-float form-group">
        <div class="form-line">
          <input type="text" class="form-control" name="account_number[]" placeholder="Enter student number" value="" required>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="form-group form-float form-group">
        <div class="form-line">
          <input type="text" class="form-control" name="full_name[]" placeholder="Enter student full name" value="" required>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <div class="form-group form-float form-group">
        <div class="form-line">
          <input type="text" class="form-control" name="email[]" placeholder="Enter student email" value="" required>
        </div>
      </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
      <div class="form-group form-float form-group">
        <div class="form-group form-float">
          <div class="form-line focused">
            <select class="form-control show-tick" name="position_id[]" required>
              <option value="" id="position-option">- Select Position -</option>
              @foreach ($positions as $key => $position)
                <option value="{{ $position->id }}">{{ $position->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
      <i class="material-icons remove" data-remove="templateremoveid">close</i>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}"></script>
  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
@endsection
