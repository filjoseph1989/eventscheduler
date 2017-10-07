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
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">more_vert</i>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);">Action</a></li>
                    <li><a href="javascript:void(0);">Another action</a></li>
                    <li><a href="javascript:void(0);">Something else here</a></li>
                  </ul>
                </li>
              </ul>
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
  <div id="org-profile" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Computer Science Society</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td>Computer Science Society</td>
              </tr>
              <tr>
                <td>
                  <p>
                    First appeared in 2017, when the two of the student of Bachelor of Science in Computer Science
                    Namely Larry Page and Sergey Brin in time of on going research conventional search engine that
                    ranked results by counting how many times the search terms appeared on the page and
                    analyzed the relationships among websites called pagerank
                  </p>
                  <p>These project grow and now what is known as google</p>
                </td>
              </tr>
              <tr>
                <td>Lead by: Jeff Bezos</td>
              </tr>
              <tr>
                <td>Aniversary: September 25, 2017</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <i class="material-icons" data-dismiss="modal" style="cursor:pointer;">close</i>
        </div>
      </div>
    </div>
  </div>
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
