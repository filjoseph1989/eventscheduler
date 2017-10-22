@extends('layouts.app')

@section('title')
	<title>My Attendance</title>
@endsection

@section('css')
  <link href="{{ asset('css/all-themes.css') }}" rel="stylesheet">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> My Attendance
                <small>Showing events you have attended</small>
              </h2>
            </div>
            <div class="body">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th><a href="#">Event</a></th>
												<th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
											<?php foreach ($attendance as $key => $value): ?>
												<tr>
													<td>{{ $value->event->title }}</td>
													<td>{{ ucwords($value->status) }}</td>
												</tr>
											<?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <th>Event Title</th>
                      <th>Status</th>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('modals')
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
@endsection
