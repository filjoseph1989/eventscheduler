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

    <?php if (session('status')): ?>
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    <?php endif; ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF EVENTS that needs your approval </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);">Action</a></li>
                      <li><a href="javascript:void(0);">Another action</a></li>
                      <li><a href="javascript:void(0);">Something else here</a></li>
                    </ul>
                  </li>
                </ul>
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                      <?php foreach ($ev as $key => $value): ?>
                        <tr>
                          <td>{{ $value->org_name }}</td>
                          <td>{{ $value->event }}</td>
                          <td>{{ date("M d, Y", strtotime($value->date_start)) }}</td>
                          <td>{{ $value->date_start_time }}</td>
                          <td>{{ date("M d, Y", strtotime($value->date_end)) }}</td>
                          <td>{{ $value->date_end_time }}</td>
                          <td>
                            <a href="#" class="" title="approve this event"> <i class="material-icons">fingerprint</i> </a>
                            <a href="#" class="view-event" title="further details" data-id="{{ $value->id }}" data-toggle="modal" data-target="#view-event"> <i class="material-icons">visibility</i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Organization / Institution</th>
                      <th>Event Name</th>
                      <th>Date Start</th>
                      <th>Time</th>
                      <th>Date End</th>
                      <th>Time</th>
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
  <script src="{{ asset('js/app.js') }}?v=0.12" charset="utf-8"></script>
@endsection
