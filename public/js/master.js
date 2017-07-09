var global_start, global_end;

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

  // Issue: 20

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
    navLinks:     true, // can click day/week names to navigate views
    selectable:   true,
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

  /*
    When the user click the save button when setting events in
    modal, the function below will trigger.
   */
  $('#save-event').on('click', function() {
    var title = $('#event').val();

    if (title) {
      calendar.fullCalendar('renderEvent', {
        title:  title,
        start:  getDate('#date_start'),
        end:  getDate('#date_end'),
        // start:  startDate(),
        // end:  endDate(),
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

/**
 * Return the date and time of the set
 * event
 *
 * @param  {string} $id
 * @return object Date
 */
function getDate($id) {
  var date = $($id).val() != "" ? $($id).val().split('/') : "";
  var time = $($id+'_time').val() != "" ? $($id+'_time').val().split(':') : "";

  if (date != "" && time == "") {
    return new Date(date[0], (date[1] - 1), date[2]);
  } else if (date == "" && time != "") {
    date = new Date(global_start);
    return new Date(date.getFullYear(), date.getMonth(), date.getDate(), time[0], time[1]);
  } else if (date != "" && time != "") {
    return new Date(date[0], (date[1] - 1), date[2], time[0], time[1]);
  }

  return global_start;
}
