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

/**
 * kani ang goal ani, is to get user ID from
 * basta mag click ang use og user edit icon
 *
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
      $('#account_number').val(data.user.account_number);
      $('#email').val(data.user.email);
      $('#facebook_username').val(data.user.facebook_username);
      $('#first_name').val(data.user.first_name);
      $('#instagram_username').val(data.user.instagram_username);
      $('#last_name').val(data.user.last_name);
      $('#middle_name').val(data.user.middle_name);
      $('#mobile_number').val(data.user.mobile_number);
      $('#suffix_name').val(data.user.suffix_name);
      $('#twitter_username').val(data.user.twitter_username);

      var html = '<option value="0">-- Account Type --</option>';
      for (var i = 0; i < data.user_account.length; i++) {
        html += '<option value="'+data.user_account[i].id+'">'+data.user_account[i].name+'</option>';
      }
      $('#user_account_id').html(html);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});
$(document).on('click', '.user-accounts-edit', function() {
  var user_account_id = $(this).data('id');
  $('#user_account_id').val(user_account_id);
});
$(document).on('click', '.course-edit', function() {
  var course_id = $(this).data('id');
  $('#course_id').val(course_id);
});

/**
 * Delete area
 */
$(document).on('click', '.delete', function() {
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
