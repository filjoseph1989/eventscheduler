/**
 * App.js
 * @version 0.29
 */

var _this;

/**
 * Filled up back the data into the create event form
 *
 * @return html
 */
$(document).ready(function() {
  var $whole_day       = $('#whole-day').find(":selected").val();
  var $eventTypeID     = $('#event_type_id').find(":selected").val();
  var $eventCategoryID = $('#event_category_id').find(":selected").val();
  var $CategoryID      = $('#category').find(":selected").val();
  var $organizationID  = $('#organization_id').find(":selected").val();
  var $semester        = $('#semester').find(":selected").val();

  if ($whole_day != 0) {
    $('#whole_day-option').html('Yes');
  }
  if ($eventTypeID != undefined) {
    getData(route('ajax.get.event-type').replace('localhost', window.location.hostname), $eventTypeID, function(data) {
      $('#event_type_id-option').html(data.name);
    });
  }
  if ($eventCategoryID != undefined) {
    getData(route('ajax.get.event-category').replace('localhost', window.location.hostname), $eventCategoryID, function(data) {
      $('#event_category_id-option').html(data.name);
    });
  }
  if ($CategoryID != undefined) {
    switch ($CategoryID) {
      case 'Public':
        $('#category-option').html('Public');
        break;
      case 'Private':
        $('#category-option').html('Private');
        break;
    }
  }
  if ($organizationID != undefined) {
    getData(route('ajax.get.organization').replace('localhost', window.location.hostname), $organizationID, function(data) {
      $('#organization-option').html(data.name);
    });
  }
  if ($semester != 0) {
    switch ($semester) {
      case 'first':
        $('#semester-option').html('First Semester');
        break;
      case 'second':
        $('#semester-option').html('Second Semester');
        break;
    }
  }
});

/**
 * Manage the event details
 *
 * @return void
 */
$(document).on('click', '.event-details', function() {
  var id   = $(this).parents('tr').data('id');
  var uid  = $(this).parents('tr').data('user');
  var html = "";

  getData(route('ajax.get.event.list').replace('localhost', window.location.hostname), id, function(data) {
    data = data[0];
    data = editEventData(data);


    // Issue 46: This two can be combine
    html =
    "<tr><td>Title</td><td data-name='title' data-event-id='"+id+"'>" + data.title + "</td></tr>" +
    "<tr><td>Description</td><td data-name='description' data-event-id='"+id+"'>" + data.description + "</td></tr>" +
    "<tr><td>Event Creator</td><td data-name='user_id' data-user-id='"+data.user.id+"' data-event-id='"+id+"'>" + data.user.first_name + " " + data.user.last_name + "</td></tr>" +
    "<tr><td>Event Organizer</td><td data-name='organization_id' data-user-id='"+data.user.id+"' data-event-id='"+id+"'>" + data.organization.name + "</td></tr>" +
    "<tr><td>Venue</td><td data-name='vanue' data-event-id='"+id+"'>" + data.venue + "</td></tr>" +
    "<tr><td>Date Start</td><td data-name='date_start' data-event-id='"+id+"'>" + data.date_start + "</td></tr>" +
    "<tr><td>Time Start</td><td data-name='date_start_time' data-event-id='"+id+"'>" + data.date_start_time + "</td></tr>" +
    "<tr><td>Date End</td><td data-name='date_end' data-event-id='"+id+"'>" + data.date_end + "</td></tr>" +
    "<tr><td>Time End</td><td data-name='date_end_time' data-event-id='"+id+"'>" + data.date_end_time + "</td></tr>" +
    "<tr><td>Event Type</td><td data-name='event_type_id' data-event-id='"+id+"'>" + data.event_type.name + "</td></tr>" +
    "<tr><td>Event Category</td><td data-name='event_category_id' data-event-id='"+id+"'>" + data.event_category.name + "</td></tr>" +
    "<tr><td>Whole Day?</td><td data-name='whole_day' data-event-id='"+id+"'>" + data.whole_day + "</td></tr>" +
    "<tr><td>Event Status</td><td data-name='status' data-event-id='"+id+"'>" + data.status + "</td></tr>" +
    "<tr><td>Approve?</td><td data-name='approve' data-event-id='"+id+"'>" + data.approve_status + "</td></tr>" +
    "<tr><td>Semester</td><td data-name='semester' data-event-id='"+id+"'>" + data.semester + " Semester</td></tr>" +
    // "<tr><td><div class='switch'><label>OFF<input type='checkbox' name='notify_via_facebook' checked><span class='lever switch-col-indigo'></span>ON</label> Facebook</div></td></tr>"+
    // "<tr><td><div class='switch'><label>OFF<input type='checkbox' name='notify_via_twitter' checked><span class='lever switch-col-blue'></span>ON</label> Twitter</div></td></tr>"+
    // "<tr><td><div class='switch'><label>OFF<input type='checkbox' name='notify_via_sms' checked><span class='lever switch-col-pink'></span>ON</label> SMS</div></td></tr>"+
    // "<tr><td><div class='switch'><label>OFF<input type='checkbox' name='notify_via_email' checked><span class='lever switch-col-teal'></span>ON</label> Email</div></td></tr>"+
    "<tr><td>APPROVERS</td><td></td></tr>";

    $('#event-details-body tbody').html(html);

    /**
     * Get approvevers
     */
    var url = route('ajax.get.event.approvers').replace('localhost', window.location.hostname);
    submit( {id:id}, url, function(data) {
      var html = $('#event-details-body tbody').html();

      for (var i = 0; i < data.length; i++) {
        var app = data[i];
        html += "<tr><td>" + app.first_name + " " + app.last_name + "</td><td>&nbsp;</td></tr>";
      }

      $('#event-details-body tbody').html(html);
    });

    if (data.approve_status == 'Approved') {
      html =
      '<div class="row">' +
        '<div class="col-md-offset-3 col-md-6">' +
          '<p name="confirmation" type="hidden">'+
          '<button name="status" type="submit" value="true" class="btn bg-green btn-block btn-lg waves-effect">Attend</button>' +
          '<input type="hidden" name="confirmation" value = "false">' +
        '</div>' +
      '</div>' +
      '<div class="row" style="margin-top: 3px;">' +
        '<div class="col-md-offset-3 col-md-6">' +
          '<button type="button" id="cant-attend" class="btn bg-red btn-block btn-lg waves-effect">Can\'t Attend</button>' +
        '</div>' +
      '</div>' +
      '<div class="row">' +
        '<div class="col-md-12">' +
          '<div class="form-group">' +
            '<div class="form-line hidden" id="cant-attend-message">' +
              '<textarea name="reason" rows="4" class="form-control no-resize" placeholder="Please type the reason why you cannot attend the event."></textarea>' +
              '<input type="hidden" name="event_id" value="' + data.id + '">' +
              '<input type="hidden" name="confirmation" value = "false">' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div class="row">' +
        '<div class="col-md-offset-3 col-md-6">' +
          '<button name="status" type="submit" value="false" id="cant-attend-submit" class="btn bg-red btn-block btn-lg waves-effect hidden">Submit</button>' +
        '</div>' +
      '</div>';

      $('#user-attendance div').html(html);
    }
  });
});

/**
 * Display the required information for
 * managing notification for each event click
 *
 * @return void
 */
$(document).on('click', '.event-details-notification', function() {
  var id = $(this).data('event-id');
  $('#event_id').val(id);

  var data = {
    id : id
  };

  var url = route('ajax.get.event.list').replace('localhost', window.location.hostname);
  submit(data, url, function(event) {
    var event = event[0];
    $('#additional_msg_facebook').html(event.additional_msg_facebook);
    $('#additional_msg_email').html(event.additional_msg_email);
    $('#additional_msg_sms').html(event.additional_msg_sms);
  });
});

/**
 * Reruen table row of personal event
 * @return {}
 */
$(document).on('click', '.my-event-details', function() {
  var id   = $(this).parents('tr').data('id');
  var html = "";

  getData(route('ajax.get.event.personal.list').replace('localhost', window.location.hostname), id, function(data) {
    data = data[0];
    data = editEventData(data);
    var attributes = ' data-event-id="'+id+'"';

    // Issue 46: This two can be combine
    html =
    "<tr><td>Title:</td><td data-name='title'"+attributes+">"+data.title+"</td></tr>" +
    "<tr><td>Description:</td><td data-name='description'"+attributes+">" + data.description + "</td></tr>" +
    "<tr><td>Venue:</td><td data-name='venue'"+attributes+">" + data.venue + "</td></tr>" +
    "<tr><td>Whole Day?</td><td data-name='whole_day'"+attributes+">" + data.whole_day + "</td></tr>" +
    "<tr><td>Date Start:</td><td data-name='date_start'"+attributes+">" + data.date_start + "</td></tr>" +
    "<tr><td>Time Start:</td><td data-name='date_start_time'"+attributes+">" + data.date_start_time + "</td></tr>" +
    "<tr><td>Date End:</td><td data-name='date_end'"+attributes+">" + data.date_end + "</td></tr>" +
    "<tr><td>Time End:</td><td data-name='date_end_time'"+attributes+">" + data.date_end_time + "</td></tr>" +
    "<tr><td>Category:</td><td data-name='category'"+attributes+">" + data.category + "</td></tr>" +
    "<tr><td>Event Type:</td><td date-event-type-id='"+data.event_type.id+"' data-name='event_type'"+attributes+">" + data.event_type.name + "</td></tr>" +
    "<tr><td>Semester:</td><td data-name='semester'"+attributes+">" + data.semester + " Semester</td></tr>" +
    "<tr><td>Status:</td><td data-name='status'"+attributes+">" + data.status + "</td></tr>" +
    "<tr><td>Email Message: </td><td data-name='additional_msg_email'"+attributes+">" + data.additional_msg_email + "</td></tr>" +
    "<tr><td>Facebook Message: </td><td data-name='additional_msg_facebook'"+attributes+">" + data.additional_msg_facebook + "</td></tr>" +
    "<tr><td>SMS message:</td><td data-name='additional_msg_sms'"+attributes+">" + data.additional_msg_sms + "</td></tr>";

    $('#my-event-details-body tbody').html(html);

  });

})

/* To make the table editable */
$(document).on('click', '.event-table tbody td', function() {
  $('#mainTable').editableTableWidget();
});

/**
 * Updathe personal event
 *
 * @param  {object} evt
 * @param  {mixed} newValue
 * @return {void}
 */
$(document).on('change', '#my-event-details-body tbody td', function(evt, newValue) {
  var name = $(this).data('name');
  var id = $(this).data('event-id');

  if (name == 'event_type') {
    var event_id = $(this).data('event-type-id');
  }

  updateData(route('ajax.update.event.personal.list').replace('localhost', window.location.hostname), id, name, newValue, function(data) {
    //
  })
});

/**
 * Update organization event
 *
 * @param  {object} evt
 * @param  {mixed} newValue
 * @return {void}
 */
$(document).on('change', '#event-details-body tbody td', function(evt, newValue) {
  var name = $(this).data('name');
  var id = $(this).data('event-id');

  if (name == 'event_type') {
    var event_id = $(this).data('event-type-id');
  }

  updateData(route('ajax.update.event.list').replace('localhost', window.location.hostname), id, name, newValue, function(data) {
    //
  })
});

/**
 * Submit the confirmation of attendance to the database
 *
 * @return {}
 */
$(document).on('click', '.confirmed', function() {
  _this = $(this);
  var id   = $(this).data('user-id');
  var eid  = $(this).data('event-id');
  var url  = route('org-adviser.attendance.store').replace('localhost', window.location.hostname);
  var data = {
    id:  id,
    eid: eid
  }

  submit(data, url, function(data, _this) {
    if (data.status == true) {
      $('#confirm').html('Confirmed');
    }
  });
});


/**
 * Can't attend function
 * @return void
 */
$(document).on('click', '#cant-attend', function() {
  $('#cant-attend').hide();
  $('#cant-attend-submit').removeClass('hidden');
  $('#cant-attend-message').removeClass('hidden');
});

/**
 * This will be used in sumitting request
 *
 * @param  {object} data
 * @param {string} url
 * @return {void}
 */
function submit(data, url, callback) {
  $.ajax({
    type: 'POST',
    url: url,
    data: data,
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      callback(data, _this);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
}

/**
 * Get specific rows from the given ID
 *
 * @param  {url}   url
 * @param  {table}   id
 * @param  {Function} callback
 * @return {json}
 */
function getData(url, id, callback) {
  submit({ id: id }, url, callback);
}

/**
 * Update the event
 * @param  {string}  url
 * @param  {int} id
 * @param  {string} name
 * @param  {mixed} value
 * @param  {Function} callback
 * @return {void}
 */
function updateData(url, id, name, value, callback) {
  data = {
    id:    id,
    name:  name,
    value: value
  };
  submit(data, url, callback);
}

/**
 * Set first letter to upper case
 *
 * @param {string} str
 * @constructor
 */
function UpCaseFirst(str) {
  return str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    return letter.toUpperCase();
  });
}

/**
 * Format Date
 *
 * @param  {date} date
 * @return {date}
 */
function formatDate(date) {
  var date = date.split('-');
  var monthNames = [
    "Jan", "Feb", "Mar",
    "Apr", "May", "Jun", "Jul",
    "Aug", "Sep", "Oct",
    "Nov", "Dec"
  ];

  var day        = date[2];
  var monthIndex = date[1] - 1;
  var year       = date[0];

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

/**
 * Format time
 *
 * @param  {time} time
 * @return {time}
 */
function formatTime(time) {
  var time = time.split(':');

  var unit = 'AM';
  var hour = time[0];
  if (hour > 12) {
    hour = hour - 12;
    unit = "PM";
  }
  var min = time[1];

  return hour + ":" + min + " " + unit;
}

/**
 * Modify some information regarding the event
 *
 * @param  {object} data
 * @return {object}
 */
function editEventData(data) {
  data.whole_day               = data.whole_day == 0 ? "No" : "Yes";
  data.status                  = UpCaseFirst(data.status);
  data.semester                = UpCaseFirst(data.semester);
  data.date_start              = formatDate(data.date_start);
  data.date_start_time         = formatTime(data.date_start_time);
  data.date_end                = data.date_end == undefined ? "" : formatDate(data.date_end);
  data.date_end_time           = data.date_end_time == undefined ? "" : formatTime(data.date_end_time);
  data.notify_via_sms          = data.notify_via_sms;
  data.notify_via_twitter      = data.notify_via_twitter;
  data.notify_via_facebook     = data.notify_via_facebook;
  data.notify_via_email        = data.notify_via_email;
  data.additional_msg_email    = data.additional_msg_email == undefined ? "" : data.additional_msg_email;
  data.additional_msg_facebook = data.additional_msg_facebook == undefined ? "" : data.additional_msg_facebook;
  data.additional_msg_sms      = data.additional_msg_sms == undefined ? "" : data.additional_msg_sms;

  if (data.approve_status != undefined) {
    data.approve_status = UpCaseFirst(data.approve_status);
  }
  if (data.event_category != undefined) {
    data.event_category.name = UpCaseFirst(data.event_category.name);
  }
  if (data.event_type != undefined) {
    data.event_type.name = UpCaseFirst(data.event_type.name);
  }

  return data;
}
