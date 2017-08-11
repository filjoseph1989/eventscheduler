@extends('layouts.master')

@section('page-title', 'User Attendance')

@section('style')
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
                <h2> Attendance Sheet </h2>
              </div>
              <div class="body table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Family Name</th>
                      <th>Organization</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($attendance as $key => $value)
                      <tr>
                        <td>{{ $value->user->first_name }}</td>
                        <td>{{ $value->user->last_name }}</td>
                        <td>{{ $value->organization->name }}</td>
                        <td>
                          <button type="button" class="btn btn-primary waves-effect confirmed"
                            data-user-id="{{ $value->user->id }}"
                            data-event-id="{{ $eid }}">
                              {{ (isset($att[$value->user->id]) && $att[$value->user->id] == 1) ? "Confirmed" : "Confirm" }}
                          </button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
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
  <script src="{{ asset('js/app.js') }}?v=0.22" charset="utf-8"></script>
@endsection
