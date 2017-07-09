
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
  var global_start, global_end;

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
    defaultView: 'month',
    /*
      selectable:true will enable user to select datetime slot
      selectHelper will add helpers for selectable.
    */
    navLinks: true, // can click day/week names to navigate views
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
      global_start = start;
      global_end   = end;

      // Display the modal afted selection
      $('#add-event').modal('show');
    },

    /*
      editable: true allow user to edit events.
    */
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    /*
      events is the main option for calendar.
      for demo we have added predefined events in json object.
    */
    events: [
      // {
      //   title: 'All Day Event',
      //   start: new Date(y, m, 1)
      // },
      // {
      //   title: 'Long Event',
      //   start: new Date(y, m, d-5),
      //   end: new Date(y, m, d-2)
      // },
      // {
      //   id: 999,
      //   title: 'Repeating Event',
      //   start: new Date(y, m, d-3, 16, 0),
      //   allDay: false
      // },
      // {
      //   id: 999,
      //   title: 'Repeating Event',
      //   start: new Date(y, m, d+4, 16, 0),
      //   allDay: false
      // },
      // {
      //   title: 'Meeting',
      //   start: new Date(y, m, d, 10, 30),
      //   allDay: false
      // },
      // {
      //   title: 'Lunch',
      //   start: new Date(y, m, d, 12, 0),
      //   end: new Date(y, m, d, 14, 0),
      //   allDay: false
      // },
      // {
      //   title: 'Birthday Party',
      //   start: new Date(y, m, d+1, 19, 0),
      //   end: new Date(y, m, d+1, 22, 30),
      //   allDay: false
      // },
      // {
      //   title: 'Click for Google',
      //   start: new Date(y, m, 28),
      //   end: new Date(y, m, 29),
      //   url: 'http://google.com/'
      // }
    ],
    backgroundColor: "#009688"
  });

  $('#save-event').on('click', function() {
    var title         = $('#event').val();
    var tglobal_start = $('#date_start').val() != "" ? $('#date_start').val().split('/') : "";
    var tglobal_end   = $('#date_end').val() != "" ? $('#date_end').val().split('/') : "";
    var time_start    = $('#date_start_time').val() != "" ? $('#date_start_time').val().split(':') : "" ;
    var time_end      = $('#date_end_time').val() != "" ? $('#date_end_time').val() : "";

    /* Start */
    var start_year   = tglobal_start[0];
    var start_month  = tglobal_start[1];
    var start_day    = tglobal_start[2];
    var start_hour   = (time_start != "") ? time_start[0] : time_start;
    var start_minute = (time_start != "") ? time_start[1] : time_start;

    /* end */
    var end_year   = tglobal_end[0];
    var end_month  = tglobal_end[1];
    var end_day    = tglobal_end[2];
    var end_hour   = (time_end != "") ? time_end[0] : time_end;
    var end_minute = (time_end != "") ? time_end[1] : time_end;

    if (title) {
      calendar.fullCalendar('renderEvent', {
        title: title,
        start: new Date(start_year, start_month - 1  , start_day, start_hour, start_minute),
        end:   new Date(start_year, start_month - 1  , start_day, start_hour, start_minute),
        // end:  new Date(end_year, end_month - 1  , end_day, end_hour, end_minute),
        allDay: false //allDay
      },
      // make the event "stick"
      true );
    }
    calendar.fullCalendar('unselect');

    // Clear modal inputs
    $('.modal').find('input').val('');

    // hide modal
    $('.modal').modal('hide');
  });

  /**
   * If the user click on the input that has class
   *    event-datepicker
   *    event-timepicker
   * this function here will trigger and there will be
   * prompt for date and time
   *
   * @type {String}
   */
  $('.event-datepicker').bootstrapMaterialDatePicker({
    format: 'YYYY/MM/DD',
    clearButton: true,
    weekStart: 1,
    time: false
  });
  $('.event-timepicker').bootstrapMaterialDatePicker({
    format: 'HH:mm',
    clearButton: true,
    date: false
  });
});
