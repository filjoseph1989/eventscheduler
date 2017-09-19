@extends('layouts.master')

@section('page-title', 'list of organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
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
          <div class="alert alert-warning">{!! session('status_warning') !!}</div>
        @endif

        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF ORGANIZATION </h2>
              </div>
              <div class="body table-responsive">
                @if ($organization->count() == 0)
                  <p>No entry yet</p>
                @else
                  @php
                    $class = "";
                    if ($organization->count() > 10) {
                      $class = "js-basic-example dataTable";
                    }
                  @endphp
                  <table class="table table-striped table-hover {{ $class }}">
                    <thead>
                      <th>Organizatin Name</th>
                    </thead>
                    <tbody>
                      @foreach ($organization as $key => $org)
                        <tr>
                          <td><a href="#">{{ $org->name }}</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <th>Organization Name</th>
                    </tfoot>
                  </table>
                @endif
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
  <script src="{{ asset('js/mindmup-editabletable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/dataTables.bootstrap.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/app.js') }}?v=0.27" charset="utf-8"></script>
@endsection
