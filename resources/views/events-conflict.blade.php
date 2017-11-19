@extends('layouts.app')

@section('title')
  <title>List of Conflicting Events</title>
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
          <div class="card">
            <div class="header">
              <h2> Conflicting Events
                <small> Show all the event having same date schedule of start </small>
              </h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Start</th>
                      <th>Time</th>
                    </thead>
                    <tbody>
                      @foreach ($events as $key => $event)
                        <tr>
                          <td>{{ $event->title }}</td>
                          <td>{{ $event->venue }}</td>
                          <td>{{ date('M d, Y', strtotime($event->date_start)) }}</td>
                          <td>{{ date('h:i', strtotime($event->date_start_time)) }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Start</th>
                      <th>Time</th>
                    </tfoot>
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
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.25" charset="utf-8"></script>
@endsection
