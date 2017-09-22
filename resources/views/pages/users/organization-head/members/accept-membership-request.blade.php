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
                <h2> LIST OF USERS REQUESTING MEMBERSHIP for {{ $org_headed[0]->organization->name }} </h2>
              </div>
              <div class="body table-responsive">
                <table class="table table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Course</th>
                      <th>Department</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($org_grp as $key => $val)
                            <?php $user_id = $val->id; ?>
                          <tr>
                            <td><a href="#">{{ $u[$val->id][0]->first_name }} {{ $u[$val->id][0]->last_name }}</a></td>
                            <td><a href="#">{{ $u[$val->id][0]->course->name }}</a></td>
                            <td><a href="#">{{ $u[$val->id][0]->department->name }}</a></td>
                            <td id="membership-status-{{ $val->user_id }}" >{{ $val->membership_status }}</td>
                            <td>
                              <button type="submit" class="btn btn-success accept" name="add" data-user-id = "{{ $val->user_id }}" data-org-id = "{{ $org_headed[0]->organization_id }}" id="add-member-{{ $val->user_id }}">Add</button>
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
  <script src="{{ asset('js/app.js') }}?v=0.25" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).on('change','#user-postion', function() {
      var id = $(this).val();
      $('#add-new-member-position').val(id);
    });
  </script>
@endsection
