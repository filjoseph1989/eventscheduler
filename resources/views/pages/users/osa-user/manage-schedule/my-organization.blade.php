@extends('layouts.master')

@section('page-title', 'List of organization')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
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
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF ORGANIZATION </h2>
              </div>
              <div class="body table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Organization Name</th>
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
                          <td><a href="{{ route('osa-personnel.calendar', [$value->id]) }}">{{ $value->name }}</a></td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
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
  <script src="{{ asset('js/app.js') }}?v=0.20" charset="utf-8"></script>
@endsection
