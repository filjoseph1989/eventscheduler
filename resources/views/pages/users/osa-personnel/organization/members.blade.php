@extends('layouts.master')

@section('page-title', 'List of members')

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
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                @if ($org != null)
                  <h2> LIST OF {{ ucwords($org->organization->name) }} MEMBERS</h2>
                @else
                  <h2>LIST OF MEMBERS</h2>
                @endif
              </div>
              <div class="body table-responsive">
                <table class="table table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (isset($member) && $member->count() == 0 || $org === false)
                      <tr>
                        <td>No Entry Yet</td>
                      </tr>
                    @else
                      @foreach ($member as $key => $value)
                        <?php $value->status = ($value->status == 1) ? 'Active' : 'Inactive' ?>
                        <tr>
                          <td><a href="{{ route('user.profile', $value->user_id) }}">{{ $value->last_name . " " . $value->first_name }}</a></td>
                          <td>{{ $value->status }}</td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
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
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
@endsection
