@extends('layouts.master')

@section('page-title', 'Approve Events')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
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
          <div class="alert alert-warning">
            {{ session('status_warning') }}
          </div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> {{ $organization->organization->name }} </h2>
              </div>
              <div class="body">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Organization / Institution</th>
                      <th>Event Name</th>
                      <th>Date Start</th>
                      <th>Time</th>
                      <th>Date End</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @if (isset($event))
                      @foreach ($event as $key => $value)
                        <tr data-id="{{ $value->id }}">
                          <td>{{ $value->title }}</td>
                          <td>{{ $value->title }}</td>
                          <td>{{ date("M d, Y", strtotime($value->date_start)) }}</td>
                          <td>{{ $value->date_start_time }}</td>
                          <td>{{ date("M d, Y", strtotime($value->date_end)) }}</td>
                          <td>{{ $value->date_end_time }}</td>
                          <td>{{ $value->approve_status }}</td>
                          <td>
                            <a href="{{ route('osa-personnel.approved.event', [$value->id] ) }}" title="approve this event">
                              <i class="material-icons">thumb_up</i>
                            </a>
                            <a href="#" class="event-details" title="further details" data-toggle="modal" data-target="#event-details">
                              <i class="material-icons">visibility</i>
                            </a>
                            <a href="{{ route('osa-personnel.disapproved.event', [$value->id] ) }}" class="" title="disapprove this event">
                              <i class="material-icons">thumb_down</i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  {{--
                    <tfoot>
                      <tr>
                        <th>Organization / Institution</th>
                        <th>Event Name</th>
                        <th>Date Start</th>
                        <th>Time</th>
                        <th>Date End</th>
                        <th>Time</th>
                        <th>status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  --}}
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('modal')
  <div class="modal fade" id="event-details" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="view-event-title">Event Details</h4>
        </div>
        <div class="modal-body" id="event-details-body">
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <table class="table table-striped">
                <tbody id="event-details">
                  {{-- Event Content Here --}}
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            <i class="material-icons"></i> Close
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
@endsection
