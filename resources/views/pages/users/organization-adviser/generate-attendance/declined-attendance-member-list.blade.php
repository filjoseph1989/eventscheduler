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
                <h2>Attendance Sheet of Those Who Declined</h2>
                <h2>Event: <b>{{ $event->title }}</b></h2>
                <h2>Venue: {{ $event->venue }}</h2>
                <h2>Duration: <b>from</b> {{ $event->date_start_time }}, {{ date('M d, Y', strtotime($event->date_start)) }} <b>to</b> {{ $event->date_end_time }}, {{ date('M d, Y', strtotime($event->date_end)) }}</h2>
                <h2>By: <b>{{ $organization->name }}</b></h2>
              </div>
              <div class="body table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Family Name</th>
                      <th>Course</th>
                      <th>Position</th>
                      <th>Organization</th>
                      <th>Mobile Number</th>
                      <th>Facebook</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($att_sheet as $key => $value)
                      <tr>
                        <td>{{ $value->user->first_name }}</td>
                        <td>{{ $value->user->last_name }}</td>
                        <td>{{ $att[$value->user_id] }}</td>
                        <td>{{ $pos2[$value->user_id] }}</td>
                        <td>{{ $org[$value->user_id] }}</td>
                        <td>{{ $value->user->mobile_number }}</td>
                        <td>{{ $value->user->facebook_username }}</td>
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
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
@endsection
