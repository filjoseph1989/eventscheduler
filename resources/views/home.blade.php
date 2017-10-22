@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Home Pages') }}</title>
@endsection

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
          @if (Auth::user()->user_type_id == 3)
            <h2> ADVERTISE / SET EVENT
              <small>In this panel you set event/s or approve event/s for advertisement</small>
            </h2>
          @elseif(Auth::user()->user_type_id == 1)
            <h2> SET EVENT
                <small>In this panel you set your personal event/s or events within your organization</small>
            </h2>
          @else
            <h2>
              <small>In this panel you set your personal event/s</small>              
            </h2>
          @endif
          </div>
          <div class="body">
            <div class="list-group">
              <a href="{{ route('Event.index') }}" class="list-group-item"> Official Events {{-- sa side-bar na lang ang create events, dri kay mag check na lang jud sa list of events tapos
                approve.. kulang pa ata ang list of event og is_approve status tapos kailangan pud makita iyang type of official
                event, kung university or organizations sa sulod na lang sa link sa event tung status na field --}}
              </a>
              <a href="{{ route('Event.show', 2) }}" class="list-group-item"> Personal Events {{-- sa side-bar na lang ang create events, dri kay mag check na lang jud sa list of events tapos
                approve.. kulang pa ata ang list of event og is_approve status tapos kailangan pud makita iyang type of local event,
                kung within org or personal sa sulod na lang sa link sa event tung status na field --}}
              </a>
            </div>
          </div>
        </div>
      </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> MANAGE NOTIFICATIONS
                @if (Auth::user()->user_type_id == 1)
                  <small>you panel for notification management for your org's events or your personal events</small>
                @else
                  <small>you panel for notification management for your personal events</small>
                @endif
              </h2>
            </div>
            <div class="body">
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Edit Notification Settings </a>
              @if (Auth::user()->user_type_id == 3)
                <a href="javascript:void(0);" class="list-group-item"> Approve Events </a>
              @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                VIEW CALENDAR
                <small>View events in the calendar of particular event type</small>
              </h2>
            </div>
            <div class="body">
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Official Events </a>
                <a href="javascript:void(0);" class="list-group-item"> Personal Events </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> GENERATE ATTENDANCE
                <small>In this panel you can generate attendances for each event</small>
              </h2>
            </div>
            <div class="body">
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Official </a>
                <a href="javascript:void(0);" class="list-group-item"> Expected </a>
                <a href="javascript:void(0);" class="list-group-item"> Confirmed </a>
                <a href="javascript:void(0);" class="list-group-item"> Declined </a>
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
@endsection 
