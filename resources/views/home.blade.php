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
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @if (isset($partial1)) 
            @include ($partial1)
          @endif
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @if (isset($partial2)) 
            @include ($partial2)
          @endif
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @if (isset($partial3)) 
            @include ($partial3)
          @endif
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          @if (isset($partial4)) 
            @include ($partial4)
          @endif
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
