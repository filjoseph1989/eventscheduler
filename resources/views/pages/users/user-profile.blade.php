@extends('layouts.master')

@section('page-title', 'Organization Profile')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (isset($login_type) and $login_type == 'admin')
        @include('pages.admin.sidebar')
    @elseif (isset($login_type) and $login_type == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

    		@if ($message = Session::get('success'))
      		<div class="alert alert-success">
  	        <strong>{{ $message }}</strong>
      		</div>
    		@endif
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                @if ($current_user)
                  <h2> MY PROFILE </h2>
                @else
                  <h2> MEMBERS PROFILE </h2>
                @endif
              </div>
              <div class="body">
                <div class="row">
                  {{--
                    Note:
                      User's data is rendered using associative array
                      unlike the typical object, to avoid subtituting $user to a loop
                  --}}
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    @if (file_exists("images/profiles/{$user['picture']}"))
                      <img class="org-logo" src="{{ asset("images/profiles/{$user['picture'] }") }}" alt="Profile Picture">
                    @else
                      <img class="org-logo" src="{{ asset("images/profile.png") }}" alt="Profile Picture">
                    @endif
                    @if ($current_user)
                      <form action="{{ route('user.profile.upload') }}" enctype="multipart/form-data" method="POST">
                      {{ csrf_field() }}
                      <div class="row">&nbsp;</div>
                      <div class="row">
                        <div class="col-md-12">
                          <input type="hidden" name="id" value="{{ $user['user_id'] }}">
                          <input type="file" name="image">
                          <button type="submit" class="btn btn-success" style="margin-top: 3px; "><i class="material-icons">file_upload</i> Upload</button>
                        </div>
                      </div>
                    </form>
                    @endif
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <table class="table">
                      <thead>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td><strong>Name: </strong></td>
                          <td>{{ "{$user['first_name']} {$user['middle_name']}, {$user['last_name']} {$user['suffix_name']}" }}</td>
                        </tr>
                        <tr>
                          <td><strong>Email: </strong></td>
                          <td>{{ $user['email'] }}</td>
                        </tr>
                        <tr>
                          <td><strong>Mobile Number: </strong></td>
                          <td>{{ $user['mobile_number'] }}</td>
                        </tr>
                        <tr>
                          <td><strong>Course: </strong></td>
                          <td><a href="#" data-id="{{ $user['course_id'] }}">{{ $user['course_name'] }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Department: </strong></td>
                          <td><a href="#" data-id="{{ $user['department_id'] }}">{{ $user['department_name'] }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Position: </strong></td>
                          <td><a href="#" data-id="{{ $user['position_id'] }}">{{ $user['position_name'] }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Organization:</strong></td>
                          <td>
                            @if (count($originUser) > 1)
                              @foreach ($originUser as $key => $value)
                                <br><a href="#" data-id="{{ $value['organization_id'] }}">{{ $value['organization_name'] }}</a>
                              @endforeach
                            @else
                              <a href="#" data-id="{{ $user['organization_id'] }}">{{ $user['organization_name'] }}</a><br>
                            @endif
                          </td>
                        </tr>
                        <tr>
                          <td><strong>Account Type: </strong></td>
                          <td><a href="#" data-id="{{ $user['user_account_id'] }}">{{ ucwords(str_replace('-', ' ', $user['user_account_name'])) }}</a></td>
                        </tr>
                        <tr>
                          <td><strong>Facebook: </strong></td>
                          <td>{{ $user['facebook_username'] }}</td>
                        </tr>
                        <tr>
                          <td><strong>Twitter: </strong></td>
                          <td>{{ $user['twitter_username'] }}</td>
                        </tr>
                        <tr>
                          <td><strong>Instagram: </strong></td>
                          <td>{{ $user['instagram_username'] }} <small style="font-size: 10px; color: red;">Note: No Notification on this</small></td>
                        </tr>
                        <tr>
                          <td><strong>Status: </strong></td>
                          <td>{{ $user['status'] == 1 ? "Active" : "Inactive" }}</td>
                        </tr>
                        <tr>
                          <td><strong>Approver: </strong></td>
                          <td>{{ $user['approver_or_not'] == 1 ? "Yes" : "No" }}</td>
                        </tr>
                        <tr>
                          <td><strong>Member Since: </strong></td>
                          <td>{{ date('M d, Y', strtotime($user['created_at'])) }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @if (session('password_status'))
        <div class="alert alert-success">
          {{ session('password_status') }}
        </div>
        @endif
        @if (session('password_status_warning'))
        <div class="alert alert-warning">
          {{ session('password_status_warning') }}
        </div>
        @endif
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if ($current_user)
              @include('pages/users/change-password')
            @endif
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
@endsection

@section('footer')
@endsection
