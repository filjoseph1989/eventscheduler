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
      $('#account_number').val(data.account_number);
      $('#email').val(data.email);
      $('#facebook_username').val(data.facebook_username);
      $('#first_name').val(data.first_name);
      $('#instagram_username').val(data.instagram_username);
      $('#last_name').val(data.last_name);
      $('#middle_name').val(data.middle_name);
      $('#mobile_number').val(data.mobile_number);
      $('#suffix_name').val(data.suffix_name);
      $('#twitter_username').val(data.twitter_username);
    },
    error: function(data) {
      console.log('Error:');
    }
  });
});
