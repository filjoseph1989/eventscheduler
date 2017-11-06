@extends('layouts.app')

@section('title')
  <title>Local Events</title>
@endsection

@section('css')
  <link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/bootstrap-select.css') }}?v=1" rel="stylesheet">
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <div class="card">
            <div class="header">
              <h2> Personal Events
              <small>Display the list of personal event</small>
              </h2>
            </div>
            <div class="body">
              <a href="{{ route('Event.create') }}" type="button" data-color="violet" class="btn bg-teal waves-effect pull-right"  style="margin-left:10px;">Create Event</a>
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Venue</th>
                        <th>Organizer</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
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
  <script src="{{ asset('js/app.js') }}?v=2.9" charset="utf-8"></script>
@endsection
