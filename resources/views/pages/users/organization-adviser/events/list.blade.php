@extends('layouts.master')

@section('page-title', 'list of events')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
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
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF <strong>{{ strtoupper($eventCategory->name) }}</strong> EVENTS </h2>
              </div>
              <div class="body table-responsive">
                @if ($event->count() == 0)
                  <p>No entry yet</p>
                @else
                  <table class="table table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Date Start</th>
                      <th>Time Start</th>
                      <th>Time End</th>
                      <th>Date End</th>
                      <th>Organizer</th>
                      <th>Status</th>
                      <th>Approved?</th>
                    </thead>
                    <tbody>
                      @foreach ($event as $key => $value)
                        <tr data-id="{{ $value->id }}">
                          <td>
                            <a href="#" class="event-details" data-toggle="modal" data-target="#event-details">{{ str_limit($value->title, 12) }}</a>
                          </td>
                          <td>{{ str_limit($value->venue, 12) }}</td>
                          <td>{{ ($value->date_start != null) ? date('Y M d', strtotime($value->date_start)) : "" }}</td>
                          <td>{{ $value->date_start_time != null ? date('h:i A', strtotime($value->date_start_time)) : "" }}</td>
                          <td>{{ $value->date_end_time != null ? date('h:i A', strtotime($value->date_end_time)) : "" }}</td>
                          <td>{{ ($value->date_end != null) ? date('Y M d', strtotime($value->date_end)) : "" }}</td>
                          <td>{{ $value->organization->name }}</td>
                          <td>{{ $value->status }}</td>
                          <td>{{ $value->approve_status }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Date Start</th>
                      <th>Time Start</th>
                      <th>Time End</th>
                      <th>Date End</th>
                      <th>Organizer</th>
                      <th>Status</th>
                      <th>Approved?</th>
                    </tfoot>
                  </table>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
  <div class="modal fade" id="event-details" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="event-details-title">Event Details</h4>
        </div>
        <div class="modal-body table-responsive event-table" id="event-details-body">
          <table class="table table-striped" id="mainTable">
            <tbody>&nbsp;</tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i>Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/mindmup-editabletable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.22" charset="utf-8"></script>
@endsection
