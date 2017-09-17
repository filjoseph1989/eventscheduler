@extends('layouts.master')

@section('page-title', 'List of organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
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
                <h2> LIST OF ORGANIZATION </h2>
              </div>
              <div class="body table-responsive">
                @php
                  $class = "";
                  if ($organization->count() > 10) {
                    $class = "js-basic-example dataTable";
                  }
                @endphp
                <table class="table table-striped table-hover {{ $class }}">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>URL</th>
                      <th>Date Started</th>
                      <th>Date Expired</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($organization->count() == 0)
                      <tr>
                        <td>{{ "No entry yet" }}</td>
                      </tr>
                    @else
                      @foreach ($organization as $key => $value)
                        <tr>
                          <td><a href="{{ route('osa-personnel.org-profile', [$value->id]) }}">{{ $value->name }}</a></td>
                          <td><a href="{{ $value->url }}" target="_blank">{{ $value->url }}</a></td>
                          <td>{{ date('M d, Y', strtotime($value->date_started)) }}</td>
                          <td>{{ date('M d, Y', strtotime($value->date_expired)) }}</td>
                          <td class="organization-status" data-id="{{ $value->id }}">{{ ucwords($value->status) }}</td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot></tfoot>
                    <tr>
                      <th>Name</th>
                      <th>URL</th>
                      <th>Date Started</th>
                      <th>Date Expired</th>
                      <th>Status</th>
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
  <script src="{{ asset('js/app.js') }}?v=0.33" charset="utf-8"></script>
@endsection
