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
												<tr data-event="{{ $value->event->id }}"
													data-route="{{ route('Event.edit', $value->event->id) }}"
													data-action="{{ route('Event.update', $value->event->id) }}"
													data-organization-id="{{ $value->event->organization_id }}"
													data-event-type-id="{{ $value->event->event_type_id }}"
													data-user-type-id="{{ Auth::user()->user_type_id }}"
													data-approval="{{ $value->event->is_approve }}">
													<td>
														<a href="#"
															class="event-title"
															data-target="#modal-event"
															data-toggle="modal">
																{{ ucwords($value->event->title) }}
														</a>
													</td>
													<td>{{ ucwords($value->status) }}</td>
													<td>{{ ($value->did_attend == 'true' ? 'Yes' : 'No' )}}</td>
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
<div id="modal-event" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="event" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="event-title">Event Information</h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead>
						<tr> <th id="modal-event-title"></th> </tr>
					</thead>
					<tbody>
						<tr> <td id="modal-event-ptitle"></td> </tr>
						<tr> <td id="modal-event-venue">&nbsp;</td> </tr>
						<tr> <td id="modal-event-description">&nbsp;</td> </tr>
						<tr> <td id="modal-event-organization">&nbsp;</td> </tr>
						<tr> <td id="modal-event-category">&nbsp;</td> </tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				@if (session('account') == 'org-head')
					<button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval" id="modal-request-approval" data-toggle="tooltip" data-placement="top" title="Request for advertisement approval"
						onclick="event.preventDefault(); document.getElementById('modal-request-approval-form').submit();">
						Request Approval
					</button>
					<form class="" id="modal-request-approval-form" action="" method="post" style="display: none;">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
						<input type="hidden" id="id" name="id" value="">
					</form>
				@endif
				@if (session('account') == 'org-member')
					<button type="button" data-color="teal" class="btn bg-teal waves-effect request-approval" id="modal-attend" data-toggle="tooltip" data-placement="top" title="Attenda this event"
						onclick="event.preventDefault(); document.getElementById('modal-attend-form').submit();">
						Attend
					</button>
					<form class="" id="modal-attend-form" action="" method="post" style="display: none;">
						{{ csrf_field() }}
						{{ method_field('PUT') }}
					</form>
				@endif

				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
  <script src="{{ asset('js/admin.js') }}?v=0.1"></script>
	<script src="{{ asset('js/bootstrap-select.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery.dataTables.js') }}?v=0.1"></script>
  <script src="{{ asset('js/jquery-datatable.js') }}?v=0.1"></script>
	<script src="{{ asset('js/app.js') }}?v=2.19" charset="utf-8"></script>
@endsection
