@extends('layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}?v=0.1">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.print.css') }}?v=0.1">
@endsection

@section('content')
  @include('pages.top-nav')

  @include('pages.admin.sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>WELCOME <b>ADMIN!</b></h2>
      </div>
      <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('admin.user.add') }}">
            <div class="info-box bg-pink hover-expand-effect">
              <div class="icon">
                <i class="material-icons">playlist_add_check</i>
              </div>
              <div class="content">
                <div class="text">Add User</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('admin.organization.add') }}">
            <div class="info-box bg-cyan hover-expand-effect">
              <div class="icon">
                <i class="material-icons">help</i>
              </div>
              <div class="content">
                <div class="text">Add Organization</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('admin.department.add') }}">
            <div class="info-box bg-light-green hover-expand-effect">
              <div class="icon">
                <i class="material-icons">forum</i>
              </div>
              <div class="content">
                <div class="text">Add Department</div>
                <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('admin.position.add') }}">
            <div class="info-box bg-orange hover-expand-effect">
              <div class="icon">
                <i class="material-icons">person_add</i>
              </div>
              <div class="content">
                <div class="text">Add Position</div>
                <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('admin.user.account.add') }}">
            <div class="info-box bg-red hover-expand-effect">
              <div class="icon">
                <i class="material-icons">playlist_add_check</i>
              </div>
              <div class="content">
                <div class="text">Add User Account</div>
                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <a href="{{ route('admin.course.add') }}">
            <div class="info-box bg-teal hover-expand-effect">
              <div class="icon">
                <i class="material-icons">help</i>
              </div>
              <div class="content">
                <div class="text">Add Course</div>
                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modal')
@endsection

@section('footer')
  <script src="{{ asset('js/jquery-ui-1.10.2.custom.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/master.js') }}?v=0.2" charset="utf-8"></script>
@endsection
