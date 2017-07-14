/**
 * Change the status
 * @return
 */
$('.user-status').click(function() {
    var id = $(this).data('id');

    if ($(this).is(":checked")) {
        var check = "on";
        $('#user-status-label-' + id).html('Active');
    } else {
        var check = "off";
        $('#user-status-label-' + id).html('Inactive');
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

            html = '<option value="0">' + data.courseName + '</option>';
            for (var i = 0; i < data.allCourses.length; i++) {
                html += '<option value="' + data.allCourses[i].id + '">' + data.allCourses[i].name + '</option>';
            }
            $('#course_id').html(html);

            html = '<option value="0">' + data.departmentName + '</option>';
            for (var i = 0; i < data.allDepartments.length; i++) {
                html += '<option value="' + data.allDepartments[i].id + '">' + data.allDepartments[i].name + '</option>';
            }
            $('#department_id').html(html);

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
    }, function(isConfirm) {
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
                    swal("Deleted!", "The user with " + data.name + " was Successfuly deleted!", "success")
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
        highlight: function(input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
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
      $('#name').val(data.organization.name);
      $('#url').val(data.organization.url);
      $('#date_started').val(data.organization.date_started);
      $('#date_expired').val(data.organization.date_expired);
      $('#option-edit-status').val(data.organization.status);
      var status = data.organization.status == 1 ? 'Active' : 'Inactive';
      $('#option-edit-status').html(status);
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
$('.osa-users-edit').click(function() {
  var id    = $(this).data('id');
  var pname = $(this).data('position');
  var pid   = $(this).data('position-id');

  // assign id to hidden input
  $('#osa-user-id').val(id);

  $.ajax({
    type: 'POST',
    url: '/users/position/get/positions',
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      var html = "";
      for (var i = 0; i < data.length; i++) {
        if (data[i].id == 1) {
          html += '<option value="'+ pid +'">'+ pname +'</option>';
        } else {
          html += '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
        }
      }
      $('#position-name').html(html);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});

$('.view-event').click(function() {
  var id = $(this).data('id');

  $.ajax({
    type: 'POST',
    url: '/users/event/ajax/get',
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
      '</tr>';
      $('#event-details').html(html);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
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
