/*
  Globa varialble
 */
var global_start, global_end, calendar;

/**
 * ------------------------------------------------------------------
 * This part mange the calendar even creation
 * ------------------------------------------------------------------
 * @type function
 * @return {[type]} [description]
 */
$(document).ready(function() {
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

    calendar = $('#calendar').fullCalendar({
        /*
          header option will define our calendar header.
          left define what will be at left position in calendar
          center define what will be at center position in calendar
          right define what will be at right position in calendar
        */
        header: {
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
        select: function(start, end, allDay) {
            global_start = start;
            global_end   = end;

            // Display the modal afted selection
            $('#add-event').modal('show');
        },

        /* editable: true allow user to edit events. */
        editable: true,
        eventLimit: true, // allow "more" link when too many events

        /*
          events is the main option for calendar.
          for demo we have added predefined events in json object.
        */
        events: getEvents()
    });

});


/**
 * Return the date and time of the set
 * event
 *
 * @param  {string} $id
 * @return object Date
 */
function getDate($id, $event = false, $time = false, default_date = false) {
  if ($event == false) {
    var date = $($id).val() != "" ? $($id).val().split('/') : default_date;
    var time = $($id + '_time').val() != "" ? $($id + '_time').val().split(':') : "";
  } else {
    date = $event.split('-');
    time = $time.split(':');
  }

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

/**
 * Fetch the events of the current month
 * @return json
 */
function getEvents() {
    // User ID
    var uid = $('#personal-calendar').data('user-id');

    $.ajax({
      type: 'POST',
      url: '/users/org-head/ajax/personal-event',
      data: {
        id: uid == undefined ? 0 : uid
      },
      dataType: 'json',
      beforeSend: function(request) {
        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
      },
      success: function(data) {
        var event;
        for (var i = 0; i < data.event.length; i++) {
          event = data.event[i];
          calendar.fullCalendar('renderEvent', {
            title:  event.event,
            start:  getDate('', event.date_start, event.date_start_time),
            end:    getDate('', event.date_end, event.date_end_time),
            allDay: event.whole_day == 1 ? true : false
          }, true);
          calendar.fullCalendar('unselect');
        }
      },
      error: function(data) {
        swal("Opps!", "We cannot process that", "error");
      }
    });
}
