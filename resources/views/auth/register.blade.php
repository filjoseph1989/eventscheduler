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
          <div class="alert alert-warning hidden" id="user-errors" role="alert"></div>
          <div class="alert alert-success hidden" id="user-success" role="alert"></div>
          <div class="card">
            <div class="header">
              <h2> Add New User
                <small>Form to add new system user</small>
              </h2>
            </div>
            <div class="body">
              <div class="row clearfix" id="input1">
                <form class="" action="{{ route('User.store') }}" method="post">
                  {{ csrf_field() }}
                  <div class="col-lg-2 col-md- col-sm-2 col-xs-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Student Number" value="" pattern="^(20[0-9]{2})-([0-9]{5})$" required autofocus>
                        <input type="hidden" id="password" name="password" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full name" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group form-float form-group">
                      <div class="form-line">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <div class="form-group form-float form-group">
                      <div class="form-group form-float">
                        <div class="form-line focused">
                          <select class="form-control show-tick" id="course_id" name="course_id">
                            <option value="{{ old('course_id') }}" id="course-option">- Select Course -</option>
                            @foreach ($courses as $key => $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
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
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <button type="button" class="btn btn-success" name="button">Remove</button>
                    <button type="button" class="btn btn-success user-details" name="button">Save</button>
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
      <form class="" action="{{ route('User.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-lg-2 col-md- col-sm-2 col-xs-2">
          <div class="form-group form-float form-group">
            <div class="form-line">
              <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Student Number" value="" pattern="^(20[0-9]{2})-([0-9]{5})$" required autofocus>
              <input type="hidden" id="password" name="password" value="">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="form-group form-float form-group">
            <div class="form-line">
              <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full name" value="" required>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="form-group form-float form-group">
            <div class="form-line">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" required>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <div class="form-group form-float form-group">
            <div class="form-group form-float">
              <div class="form-line focused">
                <select class="form-control show-tick" id="course_id" name="course_id">
                  <option value="{{ old('course_id') }}" id="course-option">- Select Course -</option>
                  @foreach ($courses as $key => $course)
                  <option value="{{ $course->id }}">{{ $course->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
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
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
          <button type="button" class="btn btn-success remove" name="button" data-remove="templateremoveid">Remove</button>
          <button type="button" class="btn btn-success user-details" name="button">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.7"></script>
  <script type="text/javascript">
    (function() {
      $(document).on('click', '.user-details', function() {
        var url  = $(this).parents('form').attr('action');
        var data = $(this).parents('form').serialize();

        if ($('#account_number').val() == '' ||
            $('#full_name').val() == '' ||
            $('#email').val() == '' ||
            $('#course_id').val() == '' ||
            $('#position_id').val() == '') {
          swal('Error!', "Please fill up the empty input field", 'error');
        } else {
          axios_post(url, data, function($details) {
            swal('Error!', $details.message, 'error');
            if ($details.message != undefined) {
            }
            if ($details.error_account_number != undefined || $details.error_account_number != null) {
              $message = "Student Number should be in the following format (20XX-XXXXX) where X are natural numbers, not " + $details.error_account_number;
              swal('Error!', $message, 'error');
            }
            if ($details.error_account_number != undefined || $details.error_account_number != null) {
              swal('Error!', $details.error_account_number, 'error');
            }
            if ($details.error_email != undefined || $details.error_email != null) {
              swal('Error!', $details.error_email, 'error');
            }
            if ($details.error_course != undefined || $details.error_course != null) {
              swal('Error!', $details.error_course, 'error');
            }
            if ($details.error_position != undefined || $details.error_position != null) {
              swal('Error!', $details.error_position, 'error');
            }

            if ($details.success != undefined || $details.success != null) {
              swal('Great!', $details.message, 'success');
            }
          });
        }
      });

      /**
       * Make http request using post
       * but since we're using laravel not only put
       * but put, patch and delete too
       *
       * @param  {string}   url
       * @param  {object}   data
       * @param  {Function} callback
       * @return {void}
       */
      var axios_post = function(url, data, callback)
      {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        axios.post(url, data)
          .then(function (response) {
            callback(response.data);
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    })();
  </script>
@endsection
