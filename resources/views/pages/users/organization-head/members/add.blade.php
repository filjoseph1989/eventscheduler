@extends('layouts.master')

@section('page-title', 'Add Member To The Organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-colorpicker.css') }}">
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
          <div class="alert alert-warning">{{ session('status_warning') }}</div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Add Member Information</h2>
              </div>
              <div class="body">
                <form class="" action="{{ route('org-head.members.search') }}" method="post">
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      {{ csrf_field() }}
                      <div class="form-group form-float form-group">
                        <div class="form-line">
                          <input type="text" class="form-control" id="search" name="search" placeholder="Search..." autofocus>
                          @if ($errors->has('name'))
                            <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
  <script src="{{ asset('js/bootstrap-colorpicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery.slimscroll.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
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
    $('#color').colorpicker();
  </script>
@endsection
