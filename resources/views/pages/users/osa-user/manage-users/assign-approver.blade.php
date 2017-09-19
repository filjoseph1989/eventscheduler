@extends('layouts.master')

@section('page-title', 'Set Approvers')

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

    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
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

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF USERS </h2>
                <ul class="header-dropdown m-r--5">
                  <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="javascript:void(0);">Action</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="body">
                @php extract( $help::dataTableClass($all_user) ); @endphp
                <table class="table table-bordered table-striped table-hover {{ $class }}">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>User Account Type</th>
                      <th>Position</th>
                      <th>Organization</th>
                      <th>Approver</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @foreach ($all_user as $key => $value)
                      @if ($user_acc[$value->id] != 'admin' AND $user_acc[$value->id] != 'university-staff')
                        <tr>
                          <td>{{ $value->first_name }}</td>
                          <td>{{ $value->last_name }}</td>
                          <td>{{ ucwords(str_replace('-', ' ', $user_acc[$value->id])) }} </td>
                          <td> @php $help::userAttribute($position, $value->id); @endphp </td>
                          <td> @php $help::userAttribute($organization, $value->id); @endphp </td>
                          <td id="approver-status-{{ $value->id }}">{{ $value->is_approver == 'true' ? 'YES' : 'NO' }}</td>
                          <td>
                            @php extract( $help::setAttribute($value->is_approver) ); @endphp
                            <button class="btn btn-{{ $btn }} {{ $class }}" type="button" name="setapprover" data-user-id="{{ $value->id }}" > {{ $approver }} </button>
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>User Account Type</th>
                      <th>Position</th>
                      <th>Organization</th>
                      <th>Approver</th>
                      <th>Action</th>
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
  <script src="{{ asset('js/jquery.dataTables.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.35" charset="utf-8"></script>
@endsection
