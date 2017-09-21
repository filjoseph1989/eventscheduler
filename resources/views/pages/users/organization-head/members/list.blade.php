@extends('layouts.master')

@section('page-title', 'search result')

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

    <section class="content">
      <div class="container-fluid">
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <h2> LIST OF REGISTERED USERS </h2>
              </div>
              <div class="body table-responsive">
                <table class="table table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Department</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user as $key => $value)
                      <?php $user_id = $value->id; ?>
                      <tr>
                        <td><a href="#">{{ $value->first_name }} {{ $value->last_name }}</a></td>
                        <td><a href="#">{{ $value->course->name }}</a></td>
                        <td><a href="#">{{ $value->department->name }}</a></td>
                        <td>
                          <form class="" action="{{ route('org-head.members.new') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" id="add-new-member-position" name="position_id" value="1">
                            <input type="hidden" name="user_id" value="{{ $user_id }}">
                            <button type="submit" class="btn btn-success" name="add">Invite</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Department</th>
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
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('change','#user-postion', function() {
      var id = $(this).val();
      $('#add-new-member-position').val(id);
    });
  </script>
@endsection
