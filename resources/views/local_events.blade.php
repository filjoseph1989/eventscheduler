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
              <h2> Local Events
              <small>Display the local event</small>
              </h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                        <tr>
                          <th>Title</th>
                          <th>Organizer</th>
                          <th>Date Start</th>
                          <th>Date End</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if (count($events['within']) > 0)
                        @foreach ($events['within'] as $key => $localEvents)
                          @foreach ($localEvents as $key => $event)
                            <?php $event = (object)$event; ?>
                            <tr>
                              <td>{{ $event->title }}</td>
                              <td><?php $event->organization = (object)$event->organization; ?>{{ $event->organization->name }}</td>
                              <td>{{ $event->date_start }}</td>
                              <td>{{ $event->date_end }}</td>
                              <td>{{ $event->status }}</td>
                            </tr>
                          @endforeach
                        @endforeach
                      @else
                        NO DATA
                      @endif

                      @if (count($events['personal']) > 0)
                        @foreach ($events['personal'] as $key => $event)
                          <?php $event = (object)$event; ?>
                          <tr>
                            <td>{{ $event->title }}</td>
                            <td>Personal</td>
                            <td>{{ $event->date_start }}</td>
                            <td>{{ $event->date_end }}</td>
                            <td>Upcoming</td>
                          </tr>
                        @endforeach
                      @endif
                    </tbody>
                    <tfoot>
                        <tr>
                          <th>Title</th>
                          <th>Organizer</th>
                          <th>Date Start</th>
                          <th>Date End</th>
                          <th>Status</th>
                        </tr>
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
  <script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
  <script src="{{ asset('js/tooltips-popovers.js') }}?v=0.1"></script>
  <script src="{{ asset('js/app.js') }}?v=2.9" charset="utf-8"></script>
@endsection
