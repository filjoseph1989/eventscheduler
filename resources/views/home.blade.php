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
              <h2> MANAGE NOTIFICATIONS
                <small>you panel for notification management</small>
              </h2>
            </div>
            <div class="body">
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Notification Settings </a>
                <a href="javascript:void(0);" class="list-group-item"> Approved Events </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                CALENDAR
                <small>Show the event in a calendar</small>
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
              <h2> ATTENDANCE
                <small>In this panel you set the user attendance for each event</small>
              </h2>
            </div>
            <div class="body">
              <div class="list-group">
                <a href="javascript:void(0);" class="list-group-item"> Official </a>
                <a href="javascript:void(0);" class="list-group-item"> Confirmation </a>
                <a href="javascript:void(0);" class="list-group-item"> Expected </a>
                <a href="javascript:void(0);" class="list-group-item"> Decline </a>
              </div>
            </div>
          </div>
        </div>
        @if (Auth::user()->user_type_id == 3)
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> ADVERTISEMENT
                  <small>In this panel you set or approved for advertisement</small>
                </h2>
              </div>
              <div class="body">
                <div class="list-group">
                  <a href="{{ route('Event.index') }}" class="list-group-item"> Official Events
                    {{--  sa side-bar na lang ang create events, dri kay mag check na lang jud sa list of events tapos approve..
                      kulang pa ata ang list of event og is_approve status
                      tapos kailangan pud makita iyang type of official event, kung university or organizations
                      sa sulod na lang sa link sa event tung status na field --}}
                    </a>
                    <a href="{{ route('Event.show', 2) }}" class="list-group-item"> Personal Events
                      {{--  sa side-bar na lang ang create events, dri kay mag check na lang jud sa list of events tapos approve..
                        kulang pa ata ang list of event og is_approve status
                        tapos kailangan pud makita iyang type of local event, kung within org or personal
                        sa sulod na lang sa link sa event tung status na field --}}
                      </a>
                    </div>
                  </div>
                </div>
              </div>
        @endif
      </div>
    </div>
  </section>
@endsection

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
@endsection
