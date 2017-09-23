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

      @if (session('status_warning'))
        <div class="alert alert-warning">{{ session('status_warning') }}</div>
      @endif

      @component( session('info_box') )
      @endcomponent
    </div>
  </section>
@endsection

@section('modal')
  <div id="notification" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Accept Invitation</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          ...
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery-ui-1.10.2.custom.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
@endsection
