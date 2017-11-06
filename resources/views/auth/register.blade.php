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
          @if (! is_null(session('status')))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          @if (! is_null(session('status_position')))
            <div class="alert alert-warning" role="alert">
              {{ session('status_position') }}
            </div>
          @endif

          @if (! is_null(session('status_warning')))
            <div class="alert alert-warning" role="alert">
              {{ session('status_message') }}
              {{--  <ul>
                @foreach ($user_return as $key => $user)
                  <li>{{ $user['account_number'] }} or {{ $user['email'] }}</li>
                @endforeach
              </ul>  --}}
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
                    {{-- Options here --}}
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <form class="" id="add-user-form" action="{{ route('User.store') }}" method="POST">
                {{ csrf_field() }}

                @if (Auth::user()->user_type_id == '3')
                  @php $class = "col-lg-2 col-md-2 col-sm-2 col-xs-2" @endphp
                @else
                  @php @$class = "col-lg-3 col-md-3 col-sm-3 col-xs-3" @endphp
                @endif

                <div class="row clearfix" id="input1">
                  <div class="{{ $class }}">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="account_number" name="account_number[]" placeholder="Student number" value="" pattern="^(20[0-9]{2})-([0-9]{5})$" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="{{ $class }}">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name[]" placeholder="Full name" value="" pattern="^[\\p{L} .'-]+$" required>
                      </div>
                    </div>
                  </div>
                  <div class="{{ $class }}">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="email" class="form-control" id="email" name="email[]" placeholder="Email" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="{{ $class }}">
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

                  {{--  This part will be display once the loggedin acccount is osa  --}}
                  @if (Auth::user()->user_type_id == 3)
                    <div class="{{ $class }}">
                      <div class="form-group form-float form-group">
                        <div class="form-group form-float">
                          <div class="form-line focused">
                            <select class="form-control show-tick" id="user_type_id" name="user_type_id[]">
                              <option value="" id="">- Select Account -</option>
                              @foreach ($accounts as $key => $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="{{ $class }}">
                      <div class="form-group form-float form-group">
                        <div class="form-group form-float">
                          <div class="form-line focused">
                            <select class="form-control show-tick" id="organization_id" name="organization_id[]">
                              <option value="" id="">- Organizations -</option>
                              @foreach ($organizations as $key => $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
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
    <div class="{{ $class }}">
      <div class="form-group form-float form-group">
        <div class="form-line">
          <input type="text" class="form-control" name="account_number[]" placeholder="Student number" value="" required>
        </div>
      </div>
    </div>
    <div class="{{ $class }}">
      <div class="form-group form-float form-group">
        <div class="form-line">
          <input type="text" class="form-control" name="full_name[]" placeholder="Full name" value="" required>
        </div>
      </div>
    </div>
    <div class="{{ $class }}">
      <div class="form-group form-float form-group">
        <div class="form-line">
          <input type="text" class="form-control" name="email[]" placeholder="Email" value="" required>
        </div>
      </div>
    </div>
    @if (Auth::user()->user_type_id == 1)
      <?php $class = "col-lg-2 col-md-2 col-sm-2 col-xs-2"; ?>
    @endif
    <div class="{{ $class }}">
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
    @if (Auth::user()->user_type_id == 1)
      <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        <i class="material-icons remove" data-remove="templateremoveid">close</i>
      </div>
    @endif
    @if (Auth::user()->user_type_id == 3)
      <div class="{{ $class }}">
        <div class="form-group form-float form-group">
          <div class="form-group form-float">
            <div class="form-line focused">
              <select class="form-control show-tick" id="user_type_id" name="user_type_id[]">
                <option value="{{ old('position_id') }}" id="position-option">- Select Account -</option>
                @foreach ($accounts as $key => $account)
                  <option value="{{ $account->id }}">{{ $account->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="{{ $class }}">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group form-float form-group">
              <div class="form-group form-float">
                <div class="form-line focused">
                  <select class="form-control show-tick" id="organization_id" name="organization_id[]">
                    <option value="" id="">- Organizations -</option>
                    @foreach ($organizations as $key => $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-1">
            <i class="material-icons remove" data-remove="templateremoveid">close</i>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}"></script>
  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
@endsection
