@extends('layouts.app')

@section('title')
  <title>Home Page</title>
@endsection

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')

  <?php
    if (isset($partials)) {
      extract($partials);
    }
  ?>

  <section class="content">
    <div class="container-fluid">
      @if (isset($partials))
        <div class="row clearfix">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            @include ($partial1)
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            @include ($partial2)
          </div>
        </div>
        <div class="row clearfix">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            @include ($partial3)
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            @include ($partial4)
          </div>
        </div>
      @endif
    </div>
  </section>
@endsection

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
@endsection
