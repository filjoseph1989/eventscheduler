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

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF EVENTS that needs your approval </h2>
              </div>
              <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Organization / Institution</th>
                      <th>Event Name</th>
                      <th>Date Start</th>
                      <th>Time</th>
                      <th>Date End</th>
                      <th>Time</th>
                      <th>Approve Count</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @if (isset($ev))
                      @foreach ($ev as $key => $value)
                        <tr>
                          <td>{{ $value->org_name }}</td>
                          <td>{{ $value->event }}</td>
                          <td>{{ date("M d, Y", strtotime($value->date_start)) }}</td>
                          <td>{{ $value->date_start_time }}</td>
                          <td>{{ date("M d, Y", strtotime($value->date_end)) }}</td>
                          <td>{{ $value->date_end_time }}</td>
                          <td>{{ $value->approver_count }}</td>
                          <td>
                            <a href="{{ route('osa.event.osa-approve', [$value->id, $value->orgg_uid] ) }}" class="" title="approve this event"> <i class="material-icons">thumb_up</i> </a>
                            <a href="#" class="view-event" title="further details" data-id="{{ $value->id }}" data-toggle="modal" data-target="#view-event"> <i class="material-icons">visibility</i></a>
                            <a href="{{ route('osa.event.osa-disapprove', [$value->id, $value->orgg_uid] ) }}" class="" title="disapprove this event"> <i class="material-icons">thumb_down</i> </a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Organization / Institution</th>
                      <th>Event Name</th>
                      <th>Date Start</th>
                      <th>Time</th>
                      <th>Date End</th>
                      <th>Time</th>
                      <th>Approve Count</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
                <a href="#" type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#add-event">
                  <i class="material-icons">add</i> Add New
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection


@section('modal')
  <div class="modal fade" id="view-event" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="view-event-title">{{-- Events title goes here --}}</h4>
        </div>
        <div class="modal-body">
          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Column</th>
                    <th>Details</th>
                  </tr>
                </thead>
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
  <script src="{{ asset('js/app.js') }}?v=0.13" charset="utf-8"></script>
@endsection
