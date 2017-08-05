@extends('layouts.master')

@section('page-title', 'List of events')

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
            {!! session('status') !!}
          </div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Event Category </h2>
              </div>
              <div class="body">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                    </tr>
                  </thead>
                  <tbody class="">
                    @if (isset($event_category))
                      @foreach ($event_category as $key => $value)
                        <tr>
                          <td><a href="{{ route('org-adviser.event.get', $value->id) }}" data-id="{{ $value->id }}">{{ ucwords($value->name) }}</a></td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                    </tr>
                  </tfoot>
                </table>
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
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.19" charset="utf-8"></script>
  <script type="text/javascript">
  /**
   * If the user click on the input that has class
   *    event-datepicker
   *    event-timepicker
   * this function here will trigger and there will be
   * prompt for date and time
   *
   * @type {String}
   */
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
