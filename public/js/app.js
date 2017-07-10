/*
  Globa varialble
 */
var global_start, global_end;

/**
 * Display data on the edit modal
 * Issue 6
 *
 * @return void
 */
$(document).on('click', '.users-edit', function() {
  var user_id = $(this).data('id');
  $('#user_id').val(user_id);

  $.ajax({
    type: 'POST',
    url: '/admin/user/get',
    data: {
      id: user_id,
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      console.log(data);
      // $('#account_number').val(data.user.account_number);
      // $('#email').val(data.user.email);
      // $('#facebook_username').val(data.user.facebook_username);
      // $('#first_name').val(data.user.first_name);
      // $('#instagram_username').val(data.user.instagram_username);
      // $('#last_name').val(data.user.last_name);
      // $('#middle_name').val(data.user.middle_name);
      // $('#mobile_number').val(data.user.mobile_number);
      // $('#suffix_name').val(data.user.suffix_name);
      // $('#twitter_username').val(data.user.twitter_username);
      //
      // var html = '<option value="0">-- Account Type --</option>';
      // for (var i = 0; i < data.user_account.length; i++) {
      //   html += '<option value="'+data.user_account[i].id+'">'+data.user_account[i].name+'</option>';
      // }
      // $('#user_account_id').html(html);
      // var html = '<option value="0">'+data.accountTypeName+'</option>';
      // for (var i = 0; i < data.allAccountTypes.length; i++) {
      //   html += '<option value="'+data.allAccountTypes[i].id+'">'+data.allAccountTypes[i].name+'</option>';
      // }
      // $('#account_type_id').html(html);

      html = '<option value="0">'+data.courseName+'</option>';
      for (var i = 0; i < data.allCourses.length; i++) {
        html += '<option value="'+data.allCourses[i].id+'">'+data.allCourses[i].name+'</option>';
      }
      $('#course_id').html(html);

      html = '<option value="0">'+data.departmentName+'</option>';
      for (var i = 0; i < data.allDepartments.length; i++) {
        html += '<option value="'+data.allDepartments[i].id+'">'+data.allDepartments[i].name+'</option>';
      }
      $('#department_id').html(html);

      html = '<option value="0">'+data.positionName+'</option>';
      for (var i = 0; i < data.allPositions.length; i++) {
        html += '<option value="'+data.allPositions[i].id+'">'+data.allPositions[i].name+'</option>';
      }
      $('#position_id').html(html);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
}).on('click', '.user-accounts-edit', function() {
  var user_account_id = $(this).data('id');
  $('#user_account_id').val(user_account_id);
}).on('click', '.course-edit', function() {
  var course_id = $(this).data('id');
  $('#course_id').val(course_id);
})

/**
 * Delete area
 */
.on('click', '.delete', function() {
  var id = $(this).parents('tr').data('id');
  var url = $(this).data('url');
  swal({
    title: "Are you sure?",
    text: "You will not be able to recover this imaginary file!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel plx!",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function (isConfirm) {
    if (isConfirm) {
      $.ajax({
        type: 'POST',
        url: url,
        data: {
          id: id,
        },
        dataType: 'json',
        beforeSend: function(request) {
          request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
        },
        success: function(data) {
          swal("Deleted!", "The user with "+data.name+" was Successfuly deleted!", "success")
            location.reload();
          // after the list should be updated
        },
        error: function(data) {
          console.log('Error:');
        }
      });
    } else {
      swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
  });
});

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

      /* editable: true allow user to edit events. */
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
    });

    /*
      When the user click the save button when setting events in
      modal, the function below will trigger.
    */
    $('#save-event').on('click', function() {
      var title     = $('#event').val();
      var whole_day = $('#whole-day').val() == 1 ? true : false;

      /**
       * Submit the data to database
       * @type {String}
       */
      $.ajax({
        type: 'POST',
        url: '/users/event/new',
        data: {
          form: $('#add-event-form').serializeArray(),
        },
        dataType: 'json',
        beforeSend: function(request) {
          request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
        },
        success: function(data) {
          if (data.wasRecentlyCreated) {
            swal("Success!", "Successfuly created new event", "success");
            calendar.fullCalendar('renderEvent', {
              title:  title,
              start:  getDate('#date_start'),
              end:    getDate('#date_end'),
              allDay: whole_day
            },
            // make the event "stick"
            true );
          }
          calendar.fullCalendar('unselect');
        },
        error: function(data) {
          swal("Opps!", "We cannot process that", "error");
        }
      });

      // Clear modal inputs
      var id = $('.modal').find('input[name="user_id"]').val('');
      $('.modal').find('input').val('');
      $('.modal').find('input[name="user_id"]').val(id);

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

/**
 * Fetch the events of the current month
 * @return json
 */
function getEvents() {
  $.ajax({
    type: 'POST',
    url: '',
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      // response here
    },
    error: function(data) {
      swal("Opps!", "We cannot process that", "error");
    }
  });
}

/**
 * Form validation
 *
 * @param  {int} id
 * @return
 */
function form_validation(id) {
  $(id).validate({
    rules: {
      'terms': {
        required: true
      },
      'confirm': {
        equalTo: '[name="password"]'
      }
    },
    highlight: function (input) {
      $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
      $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
      $(element).parents('.input-group').append(error);
      $(element).parents('.form-group').append(error);
    }
  });
}
