/*
  Globa varialble
 */
var global_start, global_end;

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
      console.log(data);
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
  var id = $(this).data('id');
  $('#osa-user-id').val(id);
  
  $.ajax({
    type: 'POST',
    url: '/users/position/get/positions',
    data: {
      // id: id
    },
    dataType: 'json',
    beforeSend: function(request) {
      request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
    },
    success: function(data) {
      var html = "";
      for (var i = 0; i < data.length; i++) {
        html += '<option value="'+ data[i].id +'">'+ data[i].name +'</option>';
      }
      $('#position-name').html(html);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});
