@extends('layouts.master')

@section('page-title', 'Manage Notification')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}?v=0.1">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.print.css') }}?v=0.1">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
@endsection

@section('content')
    @include('pages.top-nav')

    @if (session('login_type') and session('login_type') == 'admin')
        @include('pages.admin.sidebar')
    @elseif (session('login_type') and session('login_type') == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Calendar </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right calendar-options">
                      <li><a href="#" id="public">Public View</a></li>
                      <li><a href="#" id="among">All Organizations</a></li>
                      <li><a href="{{ route('osa-personnel.calendar.within') }}">Within Organization</a></li>
                      <li><a href="#" id="personal-public">Personal Event (Public)</a></li>
                      <li><a href="#" id="personal-private">Personal Event (Private)</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="body">
                @if ($id == null)
                  <div class="" id="my-organization"></div>
                @else
                  <div class="" id="my-organization" data-id="{{ $id }}"></div>
                @endif
                <div id='calendar'></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <footer class="admin-footer">
            @component('components.who')
            @endcomponent
          </footer>
        </div>
      </div>
    </section>
@endsection

@section('modal')
@endsection

@section('footer')
  <script src="{{ asset('js/jquery-ui-1.10.2.custom.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/basic-form-elements.js') }}?v=0.2" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/calendar.js') }}?v=0.8" charset="utf-8"></script>
@endsection
