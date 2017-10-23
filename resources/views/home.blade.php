@extends('layouts.app')

@section('title')
  <title>Home Page</title>
@endsection

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @include ('partials.set_event')
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @include ('partials.manage_notification')
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @include ('partials.view_calendar')
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @include ('partials.generate_attendance')
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
