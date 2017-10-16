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
            <div class="card">
              <div class="header">
                <h2> MY PROFILE </h2>
              </div>
              <div class="body">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <img class="org-logo" src="{{ asset("img/profile.png") }}" alt="Profile Picture">
                    <form action="" enctype="multipart/form-data" method="POST">
                      {{ csrf_field() }}
                      <div class="row">&nbsp;</div>
                      <div class="row">
                        <div class="col-md-12">
                          <input type="hidden" name="id" value="">
                          <input type="file" name="image">
                          <button type="submit" class="btn btn-success" style="margin-top: 3px; "><i class="material-icons">file_upload</i> Upload</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <?php if (Auth::user()->user_type_id == 2): ?>
                      <?php $id = "mainTable"; ?>
                    <?php endif; ?>
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
                        <tr>
                          <td><strong>Course: </strong></td>
                          <td id="course"><a href="#" data-id="">{{ $course }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Position: </strong></td>
                          <td id="position_id">
                            <a href="#" data-id="">
                              @if ($organizationGroup == "Not Yet Specified")
                                Not Yet Specified
                              @else
                                {{ $organizationGroup[0]->position->name }}
                              @endif
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td><strong>Organization:</strong></td>
                          <td id="organization_id">
                              @if($organizationGroup == "Not Yet Specified")
                                Not Yet Specified
                              @else
                                {{ $organizationGroup[0]->organization->name }}
                              @endif
                          </td>
                        </tr>
                        <tr>
                          <td><strong>Account Type: </strong></td>
                          <td id="user_type_id"><a href="#">{{ $account }}</a></td>
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
                    <div class="" id="user-put-method">
                      {{ method_field('PUT') }}
                    </div>
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
        $('#user-form-input').attr('name', $name);
        $('#user-form-input').val(newValue);

        $('#user-edit-form').submit();
      });

    })();
  </script>
@endsection
