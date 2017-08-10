@extends('layouts.master')

@section('page-title', 'List of Organizations')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-material-datetimepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
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
            {!! session('status') !!}
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
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF ORGANIZATIONS </h2>
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
                      <th>URL</th>
                      <th>Date Active</th>
                      <th>Date Inactive</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @if (isset($organizations))
                      @foreach ($organizations as $usersKey => $usersvalue)
                        <tr data-id="{{ $usersvalue->id }}">
                          <td>{{ $usersvalue->name }}</td>
                          <td>{{ $usersvalue->url }}</td>
                          <td>{{ $usersvalue->date_started }}</td>
                          <td>{{ $usersvalue->date_expired }}</td>
                          <td class="align-center">{{ $usersvalue->status == 1 ? 'active' : 'inactive' }}</td>
                          <td>
                            <a href="#" class="organization-delete delete" data-url="/users/organization/delete" data-type="cancel">
                              <i class="material-icons">delete</i>
                            </a>
                            <a href="#" class="organization-edit osa-organization-edit" data-id="{{ $usersvalue->id }}" data-toggle="modal" data-target="#edit-organization">
                              <i class="material-icons">mode_edit</i>
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>URL</th>
                      <th>Date Active</th>
                      <th>Date Inactive</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-organization">
                  <i class="material-icons">add</i> Add New
                </button>
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
  {{-- for editting positions --}}
  <div class="modal fade" id="edit-organization" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="organization-update" role="form" method="POST" action="{{ route('organization.edit') }}">
          {{ csrf_field() }}
            <input type="hidden" name="id" id="organization_id">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Edit Organization Name</h4>
            </div>
            <div class="modal-body">
              <div class="row clearfix">
                <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Organization Name" required="true" autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" placeholder="URL" required="true">
                    @if ($errors->has('url'))
                        <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_started') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="datepicker form-control" id="date_started" name="date_started" value="{{ old('date_started') }}" required="true" placeholder="Date Started">
                    @if ($errors->has('date_started'))
                      <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_expired') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="datepicker form-control" id="date_expired" name="date_expired" value="{{ old('date_expired') }}" required="true" placeholder="Date Expired">
                    @if ($errors->has('date_expired'))
                    <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <select class="form-control" name="status">
                      <option value="0" id="option-edit-status"></option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                    <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
                    @endif
                  </div>
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

  {{-- for adding organizations --}}
  <div class="modal fade" id="add-organization" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form class="" id="organization-registration" role="form" method="POST" action="{{ route('organization.register') }}">
          {{ csrf_field() }}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Add New Organization</h4>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
              <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="true" autofocus>
                    <label class="form-label">Organization Name</label>
                    @if ($errors->has('name'))
                        <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="form-control" name="url" value="{{ old('url') }}" required="true" autofocus>
                    <label class="form-label">Url</label>
                    @if ($errors->has('url'))
                        <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_started') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="datepicker form-control" name="date_started" value="{{ old('date_started') }}" required="true" placeholder="Date Started">
                    @if ($errors->has('date_started'))
                      <span class="help-block"> <strong>{{ $errors->first('date_started') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('date_expired') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <input type="text" class="datepicker form-control" name="date_expired" value="{{ old('date_expired') }}" required="true" placeholder="Date Expired">
                    @if ($errors->has('date_expired'))
                    <span class="help-block"> <strong>{{ $errors->first('date_expired') }}</strong> </span>
                    @endif
                  </div>
                </div>
                <div class="form-group form-float form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <div class="form-line">
                    <select class="form-control" name="status">
                      <option value="0">-- Status --</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                    <span class="help-block"> <strong>{{ $errors->first('status') }}</strong> </span>
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
  <script src="{{ asset('js/dialogs.js') }}?v=0.3" charset="utf-8"></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/bootstrap-material-datetimepicker.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/autosize.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.21" charset="utf-8"></script>
  <script type="text/javascript">
    $('.datepicker').bootstrapMaterialDatePicker({
      format: 'YYYY/MM/DD',
      clearButton: true,
      weekStart: 1,
      time: false
    });
  </script>
@endsection
