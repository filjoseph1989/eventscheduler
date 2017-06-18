@extends('layouts.master')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/morris.css') }}?v=0.15">
  <link rel="stylesheet" href="{{ asset('css/all-themes.css') }}?v=0.15">
	<style type="text/css">
		body
		{
			margin-top: 40px;
			text-align: center;
			font-size: 14px;
			font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
		#calendar
		{
			width: 900px;
			margin: 0 auto;
		}
	</style>
@endsection

@section('content')

  @include('pages.top-nav')

  @include('pages.sidebar')

  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>WELCOME</h2>
      </div>

      <!-- Widgets -->
      <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-pink hover-expand-effect">
            <div class="icon">
              <i class="material-icons">playlist_add_check</i>
            </div>
            <div class="content">
              <div class="text">My Organization</div>
              <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
              <i class="material-icons">help</i>
            </div>
            <div class="content">
              <div class="text">NEW TICKETS</div>
              <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-light-green hover-expand-effect">
            <div class="icon">
              <i class="material-icons">forum</i>
            </div>
            <div class="content">
              <div class="text">NEW COMMENTS</div>
              <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
              <i class="material-icons">person_add</i>
            </div>
            <div class="content">
              <div class="text">NEW VISITORS</div>
              <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="header">
              <div class="row clearfix">
                <div class="col-xs-12 col-sm-6">
                  <h2 id="heading-schedule">Schedule</h2>
                </div>
              </div>
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
              <div id='calendar'></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@section('footer')
  <script src="{{ asset('js/admin.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/jquery-ui-1.10.2.custom.min.js') }}" charset="utf-8"></script>
  <script src="{{ asset('js/fullcalendar.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript">

		/*
			jQuery document ready
		*/

		$(document).ready(function()
		{
			/*
				date store today date.
				d store today date.
				m store current month.
				y store current year.
			*/
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			/*
				Initialize fullCalendar and store into variable.
				Why in variable?
				Because doing so we can use it inside other function.
				In order to modify its option later.
			*/

			var calendar = $('#calendar').fullCalendar(
			{
				/*
					header option will define our calendar header.
					left define what will be at left position in calendar
					center define what will be at center position in calendar
					right define what will be at right position in calendar
				*/
				header:
				{
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				/*
					defaultView option used to define which view to show by default,
					for example we have used agendaWeek.
				*/
				defaultView: 'agendaWeek',
				/*
					selectable:true will enable user to select datetime slot
					selectHelper will add helpers for selectable.
				*/
				selectable: true,
				selectHelper: true,
				/*
					when user select timeslot this option code will execute.
					It has three arguments. Start,end and allDay.
					Start means starting time of event.
					End means ending time of event.
					allDay means if events is for entire day or not.
				*/
				select: function(start, end, allDay)
				{
					/*
						after selection user will be promted for enter title for event.
					*/
					var title = prompt('Event Title:');
					/*
						if title is enterd calendar will add title and event into fullCalendar.
					*/
					if (title)
					{
						calendar.fullCalendar('renderEvent',
							{
								title: title,
								start: start,
								end: end,
								allDay: allDay
							},
							true // make the event "stick"
						);
					}
					calendar.fullCalendar('unselect');
				},
				/*
					editable: true allow user to edit events.
				*/
				editable: true,
				/*
					events is the main option for calendar.
					for demo we have added predefined events in json object.
				*/
				events: [
					{
						title: 'All Day Event',
						start: new Date(y, m, 1)
					},
					{
						title: 'Long Event',
						start: new Date(y, m, d-5),
						end: new Date(y, m, d-2)
					},
					{
						id: 999,
						title: 'Repeating Event',
						start: new Date(y, m, d-3, 16, 0),
						allDay: false
					},
					{
						id: 999,
						title: 'Repeating Event',
						start: new Date(y, m, d+4, 16, 0),
						allDay: false
					},
					{
						title: 'Meeting',
						start: new Date(y, m, d, 10, 30),
						allDay: false
					},
					{
						title: 'Lunch',
						start: new Date(y, m, d, 12, 0),
						end: new Date(y, m, d, 14, 0),
						allDay: false
					},
					{
						title: 'Birthday Party',
						start: new Date(y, m, d+1, 19, 0),
						end: new Date(y, m, d+1, 22, 30),
						allDay: false
					},
					{
						title: 'Click for Google',
						start: new Date(y, m, 28),
						end: new Date(y, m, 29),
						url: 'http://google.com/'
					}
				]
			});

		});

	</script>
@endsection
