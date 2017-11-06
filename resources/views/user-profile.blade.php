@extends('layouts.app')

@section('title')
  <title>User Profile</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (! is_null(session('status')))
              <div class="alert alert" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <div class="card">
              <div class="header">
                <h2> MY PROFILE </h2>
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    @if( $prof_pic != "profile.png"  )
                      <img class="org-logo" src="{{ asset("img/profile/$prof_pic") }}" alt="Profile Picture">
                    @else
                      <img class="org-logo" src="{{ asset("img/profile/profile.png") }}" alt="Profile Picture">
                    @endif
                  <form action="{{ route('user.profile.upload') }}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    <div class="row">&nbsp;</div>
                    <div class="row">
                      <div class="col-md-12">
                        <input type="hidden" name="id" value="{{ Auth::id() }}">
                        <input type="file" name="image">
                        <button type="submit" class="btn btn-success" style="margin-top: 3px; ">
                          <i class="material-icons">file_upload</i> Upload</button>
                      </div>
                    </div>
                  </form>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <?php $id = "mainTable"; ?>
                    <table class="table" id="{{ $id }}">
                      <thead>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td><strong>Name: </strong></td>
                          <td id="full_name">{{ Auth::user()->full_name }}</td>
                        </tr>
                        <tr>
                          <td><strong>Email: </strong></td>
                          <td id="email"><a href="mailto:{{ Auth::user()->email }}" title="Send Email">{{ Auth::user()->email }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Mobile Number: </strong></td>
                          <td id="mobile_number">{{ Auth::user()->mobile_number }}</td>
                        </tr>
                        @if(Auth::user()->user_type_id != 3)
                        <tr>
                          <td><strong>Course: </strong></td>
                          <td id="course"><a href="#" data-id="">{{ $course }}</a></td>
                        </tr>
                        @endif
                        @if( $organizationGroup != 'Not Yet Specified' )
                          @foreach($organizationGroup as $key => $og)
                            @if( Auth::user()->user_type_id !=3 )
                              <tr>
                                <td id="organization_id"><strong>Organization #{{ $key+1 }}: </strong> {{ $og->organization->name }} </td>
                                <td id="position_id"><strong>Position: </strong>{{ $og->position->name }} </td>
                              </tr>
                            @endif
                          @endforeach
                        @endif
                        <tr>
                          <td><strong>Account Type: </strong></td>
                          <td id="user_type_id"><a href="#">{{ strtoupper(session('user_account')) }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Facebook: </strong></td>
                          <td id="facebook"><a href="#">{{ Auth::user()->facebook }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Twitter: </strong></td>
                          <td id="twitter"><a href="#">{{ Auth::user()->twitter }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Status: </strong></td>
                          <td id="status"><a href="#">{{ (Auth::user()->status == 'true') ? 'Active' : 'Inactive' }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Member Since: </strong></td>
                          <td id="created_at"><a href="#">{{ date('M, d Y', strtotime(Auth::user()->created_at)) }}</a></td>
                        </tr>
                      </tbody>
                    </table>
                    <form class="hidden" id="user-edit-form" action="" method="post">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}
                      <input type="hidden" id="user-form-input" name="" value="">
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Change Password </h2>
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="{{ route('User.changePassword') }}" method="POST">
                      {{ csrf_field() }}
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" value="" required="">
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" value="" required="">
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" value="" required="">
                        </div>
                      </div>
                      <div class="form-group form-float form-group">
                        <button class="btn btn-primary">Save</button>
                      </div>
                    </form>
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
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
  <script src="{{ asset('js/mindmup-editabletable.js') }}?v=0.1"></script>
  <script>
    // We inclode this into function to prevent missed up with
    // Other
    (function() {
      $('#mainTable').editableTableWidget();

      $('#mainTable td').on('change', function(evt, newValue) {
        // var $put_method = $('#user-put-method input').val();
        var $name = $(this).attr('id');
        var $url  = "<?php echo route('Profile.update', Auth::id()) ?>";

        $('#user-edit-form').attr('action', $url);
        $('#user-form-input').val(newValue);
        var name = $('#user-form-input').attr('name', $name);

        $('#user-edit-form').submit();
      });

    })();
  </script>
@endsection
