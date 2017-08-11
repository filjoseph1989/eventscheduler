/**
 * Calendar JS written by Liz
 *
 * @version 0.5
 */

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
 * Fetch the events of the current month
 * @return json
 */
function getEvents() {
    // Organization ID
    var oid = $('#my-organization').data('org-id');
    var url = $('#my-organization').data('route');

    var json = "";
    $.ajax({
      type: 'POST',
      url: url,
      data: {
        id: oid == undefined ? 0 : oid
      },
      dataType: 'json',
      beforeSend: function(request) {
        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
      },
      success: function(data) {
        var event;
        for (var i = 0; i < data.length; i++) {
          event = data[i];
          calendar.fullCalendar('renderEvent', {
            title:  event.title,
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

    return json;
}

/**
 * Return the date and time of the set
 * event
 *
 * @param  {string} $id
 * @return object Date
 */
function _getDate($id, $event = false, $time = false, default_date = false) {
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

function getDate($id, $date = false, $time = false) {
  if ($date != null) {
    var date = $date.split('-');
    var time = $time.split(':');
    return new Date(date[0], (date[1] - 1), date[2], time[0], time[1]);
  } else {
    return global_start;
  }
}

/*
  When the user click the save button when setting events in
  modal, the function below will trigger.
*/
$('#save-event').on('click', function() {
  var title     = $('#event').val();
  var whole_day = $('#whole-day').val() == 1 ? true: false;
  var form      = $('#add-event-form').serializeArray();

  // Start date and time if no given
  if (form[4].value == "") {
    var lday   = global_start.getDate();
    var lmonth = global_start.getMonth() + 1;
    var lyear  = global_start.getFullYear();
    var lhour  = global_end.getHours();
    var lmin   = global_end.getMinutes();

    form[4].value = lyear + "/" + lmonth + "/" + lday;
    form[5].value = lhour + ":" + lmin;
  }

  // End Date and time if no given
  if (form[6].value == "") {
    var lday   = global_end.getDate();
    var lmonth = global_end.getMonth() + 1;
    var lyear  = global_end.getFullYear();
    var lhour  = global_end.getHours();
    var lmin   = global_end.getMinutes();

    form[6].value = lyear + "/" + lmonth + "/" + lday;
    form[7].value = lhour + ":" + lmin;
  }

  // Submit the data to database
  $.ajax({
    type: 'POST',
    url: '/users/event/new',
    data: {
      form: form,
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      var event = data.request;
      if (data.wasRecentlyCreated) {
        calendar.fullCalendar('renderEvent', {
          title:  event.event,
          start:  getDate('', event.date_start, event.date_start_time),
          end:    getDate('', event.date_end, event.date_end_time),
          allDay: event.whole_day == 1 ? true : false
        }, true);
        swal("Success!", "Successfuly created new event", "success");
      }
      calendar.fullCalendar('unselect');
    },
    error: function(data) {
      swal("Opps!", "We cannot process that", "error");
    }
  });

  // Clear modal inputs
  var id = $('.modal').find('input[name="user_id"]').val();
  $('.modal').find('input').val('');
  $('.modal').find('input[name="user_id"]').val(id);

  // hide modal
  $('.modal').modal('hide');
});
