@extends('layouts.master')

@section('page-title', 'List of Event Types')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
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
                <h2> LIST OF EVENT TYPES </h2>
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
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @if (isset($event_types))
                      @foreach ($event_types as $usersKey => $usersvalue)
                        <tr>
                          <td>{{ $usersvalue->name }}</td>
                          <td>
                            <a href="#" class="event-type-delete" data-type="cancel"> <i class="material-icons">delete</i> </a>
                            <a href="#" class="event-type-edit" data-id="{{ $usersvalue->id }}" data-toggle="modal" data-target="#edit-event-type"> <i class="material-icons">mode_edit</i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                </table>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-event-type">
                  <i class="material-icons">add</i> Add New
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@section('modal')
  //for editting event-type
  <div class="modal fade" id="edit-event-type" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="event-type-update" role="form" method="POST" action="{{ route('admin.event-type.edit') }}">
          {{ csrf_field() }}
            <input type="hidden" name="id" id="event_type_id">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Edit Event Type</h4>
            </div>
            <div class="modal-body">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="true" autofocus>
                    <label class="form-label">Event Type Name</label>
                    @if ($errors->has('name'))
                    <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
          </form>
      </div>
    </div>
  </div>

  //for adding event-type
  <div class="modal fade" id="add-event-type" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="event-type-registration" role="form" method="POST" action="{{ route('admin.event-type.register') }}">
          {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Add Event Type</h4>
          </div>

          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="true" autofocus>
                    <label class="form-label">Event Type</label>
                    @if ($errors->has('name'))
                        <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-success">
              <i class="material-icons">save</i> Save
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="material-icons">close</i> Close
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection

@section('footer')
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.buttons.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.flash.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jszip.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/pdfmake.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/vfs_fonts.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.html5.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/buttons.print.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/sweetalert.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dialogs.js') }}?v=0.2" charset="utf-8"></script>
@endsection
