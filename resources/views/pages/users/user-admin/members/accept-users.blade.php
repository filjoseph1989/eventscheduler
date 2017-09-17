@extends('layouts.master')

@section('page-title', 'Set Approvers')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
    {{-- list all users on user dashboard --}}

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
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>User Account Type</th>
                      <th>Position</th>
                      <th>Organization</th>
                      <th>Account Activation</th>
                      <th>Action</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </thead>
                  <tbody class="js-sweetalert">
                    @foreach ($all_user as $key => $value)
                    <tr>
                      <td>{{ $value->first_name }}</td>
                      <td>{{ $value->last_name }}</td>
                      <td>{{ $user_acc[$value->id] }} </td>
                      <td>
                        <?php
                          if (count($position[$value->id]) > 1) {
                            foreach ($position[$value->id] as $key => $val) {
                              echo "$val <br>";
                            }
                          } else {
                            echo $position[$value->id];
                          }
                        ?>
                       </td>
                      <td>
                        <?php
                          if (count($organization[$value->id]) > 1) {
                            foreach ($organization[$value->id] as $key => $val) {
                              echo "$val <br>";
                            }
                          } else {
                            echo $organization[$value->id];
                          }
                        ?>
                      </td>
                      <td id="account-status-{{ $value->id }}">{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                      <td>
                        <button class="btn btn-primary activate-account" type="button" name="activate-account" data-user-id = "{{ $value->id }}">Approve Registration</button>
                        <button class="btn btn-primary deactivate-account" type="button" name="deactivate-account" data-user-id = "{{ $value->id }}">Ignore Registration</button>
                        <div class="preload preloader-{{ $value->id }}"></div>
                      </td>
                      <td>{{ $value->created_at }}</td>
                      <td id="updated-at-{{ $value->id }}">{{ $value->updated_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>User Account Type</th>
                      <th>Position</th>
                      <th>Organization</th>
                      <th>Account Activation</th>
                      <th>Action</th>
                      <th>Created At</th>
                      <th>Updated At</th>
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
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
@endsection
