@extends('layouts.master')

@section('page-title', 'List Of Event')

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
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if (session('status_warning'))
          <div class="alert alert-warning">{!! session('status_warning') !!}</div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('osa-personnel.event.new') }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-light-green">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">Public View/All Organizations/Within Organization</div>
                <div class="number">Create Event</div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('osa-personnel.my.new.event') }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-teal">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">Personal</div>
                <div class="number">Create Event</div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="{{ route('osa-personnel.calendar') }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-green">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">View</div>
                <div class="number">Calendar</div>
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
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
  <script type="text/javascript">
    $('.event-datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });
    $('.event-timepicker').bootstrapMaterialDatePicker({
      format: 'HH:mm',
      clearButton: true,
      date: false
    });

  </script>
@endsection
