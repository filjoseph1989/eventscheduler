@extends('layouts.app')

@section('title')
  <title>Add User</title>
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
            </div>
            <div class="body">
              <div class="row clearfix" id="input1">
                <form class="" action="" method="post">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="account_number" name="account_number[]" placeholder="Student Number (20XX-XXXXX)" value="" pattern="^(20[0-9]{2})-([0-9]{5})$" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name[]" placeholder="Full name" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="email" class="form-control" id="email" name="email[]" placeholder="Email" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
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
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <button type="button" class="btn btn-success" name="button">Remove</button>
                    <button type="button" class="btn btn-success" name="button">Save</button>
                  </div>
                </form>
              </div>
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <button id="b1" class="btn btn-success add-field" type="button" data-toggle="tooltip" data-placement="top" title="Add Form Field">+</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modals')
  <div class="" id="registration-form-template" style="display:none;">
    <div class="row clearfix" id="templateid">
      <form class="" action="" method="post">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
          <div class="form-group form-float form-group">
            <div class="form-line">
              <input type="text" class="form-control" id="account_number" name="account_number[]" placeholder="Student Number (20XX-XXXXX)" value="" pattern="^(20[0-9]{2})-([0-9]{5})$" required autofocus>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
          <div class="form-group form-float form-group">
            <div class="form-line">
              <input type="text" class="form-control" id="full_name" name="full_name[]" placeholder="Full name" value="" required>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="form-group form-float form-group">
            <div class="form-line">
              <input type="email" class="form-control" id="email" name="email[]" placeholder="Email" value="" required>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
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
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-success remove" name="button" data-remove="templateremoveid">Remove</button>
          <button type="button" class="btn btn-success" name="button">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
@endsection
