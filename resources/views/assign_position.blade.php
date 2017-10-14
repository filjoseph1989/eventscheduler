@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Assign Position To Existing User') }}</title>
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
              <h2> Assign Position
                <small>Form to assign position to existing user</small>
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
              <form class="" id="add-user-form" action="{{ route('User.existing.assignPosition') }}" method="GET">
                {{ csrf_field() }}
                <div class="row clearfix" id="input1">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="hidden" class="form-control" id="existing_user" name="existing_user" placeholder="" value="{{ $existing_user }}">
                        <input type="text" class="form-control" id="account_number" name="account_number" placeholder="{{ $existing_user[0]['account_number'] }}" value="{{ $existing_user[0]['account_number'] }}" readonly>
                        {{--  @if ($errors->has('account_number'))
                          <span class="help-block"> <strong>{{ $errors->first('account_number') }}</strong> </span>
                        @endif  --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="{{ $existing_user[0]['full_name'] }}" value="{{ $existing_user[0]['full_name'] }}" readonly>
                        {{--  @if ($errors->has('full_name'))
                          <span class="help-block"> <strong>{{ $errors->first('full_name') }}</strong> </span>
                        @endif  --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="email" name="email" placeholder="{{ $existing_user[0]['email'] }}" value="{{ $existing_user[0]['email'] }}" readonly>
                        {{--  @if ($errors->has('email'))
                          <span class="help-block"> <strong>{{ $errors->first('email') }}</strong> </span>
                        @endif  --}}
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-group form-float">
                      <div class="form-line focused">
                        <select class="form-control show-tick" id="position_id" name="position_id">
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

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}"></script>
  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
@endsection
