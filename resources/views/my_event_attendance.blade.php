@extends('layouts.app')

@section('title')
	<title>My Attendance</title>
@endsection

@section('css')
	<link href="{{ asset('css/dataTables.bootstrap.css') }}?v=1" rel="stylesheet">
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
									<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                      <tr>
                        <th><a href="#">Event</a></th>
												<th>Status</th>
												<th>Present?</th>
                      </tr>
                    </thead>
                    <tbody>
											<?php foreach ($attendance as $key => $value): ?>
												<tr>
													<td>{{ $value->event->title }}</td>
													<td>{{ ucwords($value->status) }}</td>
													<td>{{ 'No' }}</td>
												</tr>
											<?php endforeach; ?>
                    </tbody>
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
	<script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
@endsection
