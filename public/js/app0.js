/**
 * Change the status
 * @return
 */
$('.user-status').click(function() {
  var id = $(this).data('id');

  if ($(this).is(":checked")) {
    var check = "on";
    $('#user-status-label-'+id).html('Active');
  } else {
    var check = "off";
    $('#user-status-label-'+id).html('Inactive');
  }

  $.ajax({
    type: 'POST',
    url: '/admin/users/set/status',
    data: {
      status_: check,
      id: id
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      console.log(data);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

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

$('.organization-edit').click(function(){
  var id = $(this).data('id');

  $.ajax({
    type: 'POST',
    url: '/users/organization/get',
    data: {
      id: id
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      var org = data.organization;

      $('#name').val(org.name);
      $('#url').val(org.url);
      $('#date_started').val(org.date_started);
      $('#date_expired').val(org.date_expired);

      var status = org.status == 1 ? 'Active' : 'Inactive';
      $('#option-edit-status').val(org.status);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

/**
 * Transfer me to app.js
 * @type ajax
 */
$('.osa-add-org').click(function() {
  var id    = $(this).data('id');
  var pname = $(this).data('position');
  var pid   = $(this).data('position-id');

  // assign id to hidden input
  $('#osa-add-org').val(id);

  $.ajax({
    type: 'POST',
    url: '/users/position/get/positions',
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

$('.osa-user-account-edit').click(function() {
  var id = $(this).data('id');

  // assign id to hidden input
  $('#osa-user-account-edit').val(id);

  $.ajax({
    type: 'POST',
    url: '/users/user/get',
    data: {
      id: id
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      console.log(data);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

/**
 * Display the event details in modal
 *
 * @return
 */
$('.view-event').click(function() {
  var id = $(this).data('id');

  $.ajax({
    type: 'POST',
    url: '/users/org-head/event/ajax/get',
    data: {
      id: id
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      var event = data.event;
      event.whole_day = event.whole_day == 1 ? 'Yes' : 'No';
      event.status    = event.status == 1 ? "Approved" : "Unapproved";
      event.notify_via_twitter    = event.notify_via_twitter == 1 ? "on" : "off";
      event.notify_via_facebook   = event.notify_via_facebook == 1 ? "on" : "off";
      event.notify_via_sms        = event.notify_via_sms == 1 ? "on" : "off";
      event.notify_via_email      = event.notify_via_email == 1 ? "on" : "off";

      $('#view-event-title').html(event.event);
      var html =
      '<tr>' +
        '<td>Event Title:</td>' +
        '<td>'+ event.event + '</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Description:</td>' +
        '<td>'+ event.description +'</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Date and Time Start:</td>' +
        '<td>'+ event.date_start + ' ' + event.date_start_time + '</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Date and Time End:</td>' +
        '<td>'+ event.date_end + ' ' + event.date_end_time + '</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Whole Day?:</td>' +
        '<td>'+ event.whole_day +'</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Event Type:</td>' +
        '<td>'+ event.event_type.name + '</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Event Category:</td>' +
        '<td>'+ event.event_category.name + '</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Organiztion:</td>' +
        '<td>'+ event.organization.name + '</td>' +
      '</tr>' +
      '<tr>' +
        '<td>Status:</td>' +
        '<td>'+ event.status + '</td>' +
      '</tr>'+
      '<tr>' +
        '<td>Notify Via Twitter:</td>' +
        '<td>'+ event.notify_via_twitter + '</td>' +
      '</tr>'+
      '<tr>' +
        '<td>Notify Via Facebook:</td>' +
        '<td>'+ event.notify_via_facebook + '</td>' +
      '</tr>'+
      '<tr>' +
        '<td>Notify Via Sms:</td>' +
        '<td>'+ event.notify_via_sms + '</td>' +
      '</tr>'+
      '<tr>' +
        '<td>Notify Via Email:</td>' +
        '<td>'+ event.notify_via_email + '</td>' +
      '</tr>'+
      '<tr>' +
        '<td> <b>List of who already approved this event: </b></td>' +
        '<td>&nbsp;</td>' +
      '</tr>';
      for (var i = 0; i < data.event_monitor.length; i++) {
        html +=
        '<tr>' +
          '<td>'+' '+data.event_monitor[i].fname+' '+data.event_monitor[i].mname +' '+data.event_monitor[i].lname+' '+data.event_monitor[i].sname+'</td>' +
          '<td>&nbsp;</td>' +
        '</tr>';
      }
      $('#event-details').html(html);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

/**
 * Submit the confirmation of attendance to the database
 *
 * @return {}
 */
$('.confirmed').click(function() {
  var id = $(this).data('user-id');
  var eid = $(this).data('event-id');

  $.ajax({
    type: 'POST',
    url: '/users/attendance/store',
    data: {
      id: id,
      eid: eid
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      console.log(data);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

/**
 * Edit the event on org head account
 * @return
 */
$('.edit-event').click(function() {
  var eid   = $(this).data('event-id');
  var ename = $(this).data('event-name');
  $('#edit-event-title').html("Edit " + ename);

  $.ajax({
    type: 'POST',
    url: '/users/org-head/ajax/get',
    data: {
      id: eid
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      event = data.event;

      $('#event-id').val(eid);
      $('#edit-event-input-title').val(event.event);
      $('#edit-description').html(event.description);
      $('#edit-venue').val(event.venue);
      $('#edit-date_start').val(event.date_start);
      $('#edit-date_start_time').val(event.date_start_time);
      $('#edit-date_end').val(event.date_end);
      $('#edit-date_end_time').val(event.date_end_time);
      $('#edit-event-category').val(event.event_category_id);
      $('#edit-event-calendar').val(event.calendar_id);
      $('#edit-event-organization').val(event.organization_id);
    },
    error: function(data) {
      console.log('Error:');
    }
  });

});

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

/*
Deprecated Area
 */

/**
 * Display the organization dropdown
 * ! Deprecated
 *
 * @return
 */
// $('#event-calendar').click(function() {
//   var value = $(this).val();
//   if (value == 2) {
//     $.ajax({
//         type: 'POST',
//         url: '/users/organization/gets',
//         dataType: 'json',
//         beforeSend: function(request) {
//           request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
//         },
//         success: function(data) {
//           // console.log(data);
//           var $temp, html = '<option value="0">-- Select Organization for this event --</option>';
//           for (var i = 0; i < data.length; i++) {
//             $temp = data[i];
//             html += '<option value="'+$temp.id+'">'+$temp.name+'</option>';
//           }
//           $('#event-organization').html(html);
//         },
//         error: function(data) {
//           console.log('Error:');
//         }
//     });
//     $('#form-event-organization').removeClass('hidden');
//   } else {
//     $('#form-event-organization').addClass('hidden');
//   }
// });

/**
 * Filled up back the data into the create event form
 *
 * @return html
 */
$(document).ready(function() {
  var $whole_day       = $('#whole-day').find(":selected").val();
  var $eventTypeID     = $('#event_type_id').find(":selected").val();
  var $eventCategoryID = $('#event_category_id').find(":selected").val();
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
