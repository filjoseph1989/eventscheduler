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
    var url = '/users/org-adviser/get/event-type';
    getData(url, $eventTypeID, function(data) {
      $('#event_type_id-option').html(data.name);
    });
  }
  if ($eventCategoryID != undefined) {
    var url = '/users/org-adviser/get/event-category';
    getData(url, $eventCategoryID, function(data) {
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
    var url = '/users/org-adviser/get/organization';
    getData(url, $organizationID, function(data) {
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

$(document).on('click', '.event-details', function() {
  var url = '/users/org-adviser/get/event';
  var id = $(this).parents('tr').data('id');
  var html = "";

  getData(url, id, function(data) {
    data                     = data[0];
    data.whole_day           = data.whole_day     == 0 ? "No":       "Yes";
    data.status              = UpCaseFirst(data.status);
    data.approve_status      = UpCaseFirst(data.approve_status);
    data.semester            = UpCaseFirst(data.semester);
    data.event_category.name = UpCaseFirst(data.event_category.name);
    data.date_start          = formatDate(data.date_start);
    data.date_start_time     = formatTime(data.date_start_time);
    data.date_end            = data.date_end      == undefined ? "": formatDate(data.date_end);
    data.date_end_time       = data.date_end_time == undefined ? "": formatTime(data.date_end_time);

    html =
    "<tr><td>Title</td><td>" + data.title + "</td></tr>" +
    "<tr><td>Description</td><td>" + data.description + "</td></tr>" +
    "<tr><td>Event Creator</td><td>" + data.user.first_name + " " + data.user.last_name + "</td></tr>" +
    "<tr><td>Event Organizer</td><td>" + data.organization.name + "</td></tr>" +
    "<tr><td>Venue</td><td>" + data.venue + "</td></tr>" +
    "<tr><td>Date Start</td><td>" + data.date_start + "</td></tr>" +
    "<tr><td>Time Start</td><td>" + data.date_start_time + "</td></tr>" +
    "<tr><td>Date End</td><td>" + data.date_end + "</td></tr>" +
    "<tr><td>Time End</td><td>" + data.date_end_time + "</td></tr>" +
    "<tr><td>Event Type</td><td>" + data.event_type.name + "</td></tr>" +
    "<tr><td>Event Category</td><td>" + data.event_category.name + "</td></tr>" +
    "<tr><td>Whole Day?</td><td>" + data.whole_day + "</td></tr>" +
    "<tr><td>Event Status</td><td>" + data.status + "</td></tr>" +
    "<tr><td>Approve?</td><td>" + data.approve_status + "</td></tr>" +
    "<tr><td>Semester</td><td>" + data.semester + " Semester</td></tr>" +
    "<tr><td>Twitter Notification</td><td>" + data.notify_via_twitter + "</td></tr>" +
    "<tr><td>Facebook Notification</td><td>" + data.notify_via_facebook + "</td></tr>" +
    "<tr><td>SMS Notification</td><td>" + data.notify_via_sms + "</td></tr>" +
    "<tr><td>Email Notification</td><td>" + data.notify_via_email + "</td></tr>";
    $('#event-details-body tbody').html(html);
  });
});

/**
 * Get specific rows from the given ID
 *
 * @param  {url}   url
 * @param  {table}   id
 * @param  {Function} callback
 * @return {json}
 */
function getData(url, id, callback) {
  $.ajax({
    type: 'POST',
    url: url,
    data: {
      id: id
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      callback(data);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
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
