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
                <h2> MY PROFILE </h2>
              </div>
              <div class="body">
                <div class="row">
                  {{--
                    Note:
                      User's data is rendered using associative array
                      unlike the typical object, to avoid subtituting $user to a loop
                  --}}
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <img class="org-logo" src="{{ asset("images/{$user['picture'] }") }}" alt="Profile Picture">
                    <form action="#" enctype="multipart/form-data" method="POST">
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
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <p><strong>Name:</strong> {{ "{$user['first_name']} {$user['middle_name']}, {$user['last_name']} {$user['suffix_name']}" }}</p>
                    <p><strong>Email:</strong> {{ $user['email'] }}</p>
                    <p><strong>Mobile Number:</strong> {{ $user['mobile_number'] }}</p>
                    <p><strong>Course:</strong> <a href="#" data-id="{{ $user['course_id'] }}">{{ $user['course_name'] }}</a></p>
                    <p><strong>Department:</strong> <a href="#" data-id="{{ $user['department_id'] }}">{{ $user['department_name'] }}</a></p>
                    <p><strong>Position:</strong> <a href="#" data-id="{{ $user['position_id'] }}">{{ $user['position_name'] }}</a></p>
                    <p>
                      <strong>Organization:</strong>
                      @if (count($originUser) > 1)
                        @foreach ($originUser as $key => $value)
                          <br><a href="#" data-id="{{ $value['organization_id'] }}">{{ $value['organization_name'] }}</a>
                        @endforeach
                      @else
                        <a href="#" data-id="{{ $user['organization_id'] }}">{{ $user['organization_name'] }}</a><br>
                      @endif
                    </p>
                    <p><strong>Account Type:</strong> <a href="#" data-id="{{ $user['user_account_id'] }}">{{ ucwords(str_replace('-', ' ', $user['user_account_name'])) }}</a></p>
                    <p><strong>Facebook:</strong> {{ $user['facebook_username'] }}</p>
                    <p><strong>Twitter:</strong> {{ $user['twitter_username'] }}</p>
                    <p><strong>Instagram:</strong> {{ $user['instagram_username'] }} <small style="font-size: 10px; color: red;">Note: No Notification on this</small></p>
                    <p><strong>Status:</strong> {{ $user['status'] == 1 ? "Active" : "Inactive" }}</p>
                    <p><strong>Approver?</strong> {{ $user['approver_or_not'] == 1 ? "Yes" : "No" }}</p>
                    <p><strong>Member Since:</strong> {{ date('M d, Y', strtotime($user['created_at'])) }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
@endsection

@section('footer')
@endsection
