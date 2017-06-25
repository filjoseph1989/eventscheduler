@extends('layouts.master')

@section('page-title', 'List of Users')

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
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF UNIVERSITY COURSES </h2>
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
                    <tr>
                      <td>Bachelor of Science in Computer Science</td>
                      <td>
                        <a href="#" class="users-delete" data-type="cancel"> <i class="material-icons">delete</i> </a>
                        <a href="#" class="users-edit" data-toggle="modal" data-target="#edit-course"> <i class="material-icons">mode_edit</i> </a>
                      </td>
                    </tr>
                    <tr>
                      <td>Bachelor of Science in Information Technology</td>
                      <td>
                        <a href="#" class="users-delete" data-type="cancel"> <i class="material-icons">delete</i> </a>
                        <a href="#" class="users-edit" data-toggle="modal" data-target="#edit-course"> <i class="material-icons">mode_edit</i> </a>
                      </td>
                    </tr>
                    <tr>
                      <td>Bachelor of Science in Engineering</td>
                      <td>
                        <a href="#" class="users-delete" data-type="cancel"> <i class="material-icons">delete</i> </a>
                        <a href="#" class="users-edit" data-toggle="modal" data-target="#edit-course"> <i class="material-icons">mode_edit</i> </a>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                </table>
                <a href="{{ route('user.course.register') }}" type="button" class="btn btn-success" name="button">
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
    <div class="modal fade" id="edit-course" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="">Edit User Account</h4>
          </div>
          <div class="modal-body">
            <div class="form-group form-float form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <div class="form-line">
                <input type="text" class="form-control" name="name">
                <label class="form-label">Name</label>
                @if ($errors->has('name'))
                <span class="help-block"> <strong>{{ $errors->first('name') }}</strong> </span>
                @endif
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
          </div>
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
  <script src="{{ asset('js/dialogs.js') }}?v=0.1" charset="utf-8"></script>
@endsection
