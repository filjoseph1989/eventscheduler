@extends('layouts.master')

@section('page-title', 'Add Department')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/waitMe.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
@endsection

@section('content')

    @include('pages.top-nav')

    @if (session('login_type') and session('login_type') == 'admin')
        @include('pages.admin.sidebar')
    @elseif (session('login_type') and session('login_type') == 'user')
        @include('pages.users.sidebar')
    @endif

    <section class="content">
      <div class="container-fluid">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif


      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> Add New Department </h2>
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
                <form class="" id="department-registration" role="form" method="POST" action="{{ route('admin.department.register') }}">
                  {{ csrf_field() }}
                  <div class="row clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                      <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="form-line">
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="true" autofocus>
                          <label class="form-label">Department Name</label>
                          @if ($errors->has('name'))
                            <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                      <button type="submit" class="btn btn-success">
                        <i class="material-icons">save</i> Save
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <footer class="admin-footer">
            @component('components.who')
            @endcomponent
          </footer>
        </div>
      </div>
    </section>

@endsection

@section('modal')
@endsection

@section('footer')
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });
  </script>
@endsection
