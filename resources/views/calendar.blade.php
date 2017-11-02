@extends('layouts.app')

@section('title')
  <title>{{ config('app.name', 'Calendar') }}</title>
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}?v=1">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/fullcalendar.print.min.css') }}" media="print">
@endsection

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2> {{ ucwords($title) }} Calendar
                <small>Display organizations in the system</small>
              </h2>
            </div>
            <div class="body">
              <div class="" id="calendar"></div>
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
  <script src="{{ asset('js/admin.js') }}"?v=0.1></script>
  <script src="{{ asset('js/moment.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
  $(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: <?php echo "'" . date('Y-m-d') . "'"; ?>,
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo $calendarEvents; ?>
		});

	});
  </script>
@endsection
