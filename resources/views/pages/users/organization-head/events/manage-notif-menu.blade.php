@extends('layouts.master')

@section('page-title', 'list of events')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
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
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if (session('status_warning'))
          <div class="alert alert-warning">{!! session('status_warning') !!}</div>
        @endif

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <a href="{{ route('org-head.manage-notification') }}">
    <div class="info-box {{ session('color') }} hover-expand-effect">
      <div class="icon">
        <i class="material-icons">date_range</i>
      </div>
      <div class="content">
        <div class="text">Edit Notification</div>
        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
      </div>
    </div>
  </a>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
  <a href="{{ route('org-head.approve.event') }}">
    <div class="info-box {{ session('color') }} hover-expand-effect">
      <div class="icon">
        <i class="material-icons">playlist_add_check</i>
      </div>
      <div class="content">
        <div class="text">Aprrove Events</div>
        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
      </div>
    </div>
  </a>
</div>
@endsection
