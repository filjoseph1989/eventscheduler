@extends('layouts.master')

@section('page-title', 'List Of Event')

@section('style')
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
                  <table class="table table-striped">
                    <thead>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Date Start</th>
                      <th>Time</th>
                      <th>Date End</th>
                      <th>Time</th>
                      <th>Organizer</th>
                      <th>Status</th>
                      <th>Approved?</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      @foreach ($event as $key => $value)
                        <tr>
                          <td>{{ str_limit($value->title, 12) }}</td>
                          <td>{{ str_limit($value->venue, 12) }}</td>
                          <td>{{ ($value->date_start != null) ? date('Y M d', strtotime($value->date_start)) : "" }}</td>
                          <td>{{ $value->date_start_time != null ? date('h:i A', strtotime($value->date_start_time)) : "" }}</td>
                          <td>{{ ($value->date_end != null) ? date('Y M d', strtotime($value->date_end)) : "" }}</td>
                          <td>{{ $value->date_end_time != null ? date('h:i A', strtotime($value->date_end_time)) : "" }}</td>
                          <td>{{ $value->organization->name }}</td>
                          <td>{{ $value->status }}</td>
                          <td>{{ $value->approve_status }}</td>
                          <td>Action</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Title</th>
                      <th>Venue</th>
                      <th>Date Start</th>
                      <th>Time</th>
                      <th>Date End</th>
                      <th>Time</th>
                      <th>Organizer</th>
                      <th>Status</th>
                      <th>Approved?</th>
                      <th>Action</th>
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
@endsection

@section('footer')
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.16" charset="utf-8"></script>
  <script type="text/javascript">
    $('.event-datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });
    $('.event-timepicker').bootstrapMaterialDatePicker({
      format: 'HH:mm',
      clearButton: true,
      date: false
    });

  </script>
@endsection
