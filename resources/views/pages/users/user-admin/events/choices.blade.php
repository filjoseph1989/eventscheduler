@extends('layouts.master')

@section('page-title', 'list of event')

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
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('user-admin.event.list', 1) }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-teal">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">Public View</div>
                <div class="number">Event</div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('user-admin.event.list', 2) }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-green">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">Within Organization</div>
                <div class="number">Event</div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('user-admin.event.list', 3) }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-light-green">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">Among Organizations</div>
                <div class="number">Event</div>
              </div>
            </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="{{ route('user-admin.event.list', 4) }}">
              <div class="info-box hover-expand-effect">
              <div class="icon bg-lime">
                <i class="material-icons">date_range</i>
              </div>
              <div class="content">
                <div class="text">Personal</div>
                <div class="number">Event</div>
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
