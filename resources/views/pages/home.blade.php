@extends('layouts.master')

@section('page-title', 'Home')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}?v=0.1">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.print.css') }}?v=0.1">
@endsection

@section('content')
  @include('pages.top-nav')

  @if (session('login_type') and session('login_type') == 'user')
    @include('pages.users.sidebar')
  @elseif (session('login_type') and session('login_type') == 'admin')
    @include('pages.admin.sidebar')
  @endif

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>WELCOME <span class="font-10">{{ Auth::user()->first_name }}</span></h2>
      </div>
      <div class="row clearfix">
        @component('components.info-box.osa-personnel')
        @endcomponent
      </div>
      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                  <h2 id="heading-schedule">Schedule</h2>
                </div>
              </div>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="body">
              <div id='calendar'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery-ui-1.10.2.custom.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/master.js') }}" charset="utf-8"></script>
@endsection
