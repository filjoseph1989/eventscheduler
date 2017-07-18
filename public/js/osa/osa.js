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
          swal("Deleted!", data.name+" was Successfuly deleted!", "success");
          // $('tr[data-id="' + data.id + '"]').remove();
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

$(document).on('click', '.user-accounts-edit', function() {
  var user_account_id = $(this).data('id');
  $('#user_account_id').val(user_account_id);
});
$(document).on('click', '.course-edit', function() {
  var course_id = $(this).data('id');
  $('#course_id').val(course_id);
});
$(document).on('click', '.department-edit', function() {
  var department_id = $(this).data('id');
  $('#department_id').val(department_id);
});
$(document).on('click', '.position-edit', function() {
  var position_id = $(this).data('id');
  $('#position_id').val(position_id);
});
$(document).on('click', '.organization-edit', function() {
  var organization_id = $(this).data('id');
  $('#organization_id').val(organization_id);
});
$(document).on('click', '.event-category-edit', function() {
  var event_category_id = $(this).data('id');
  $('#event_category_id').val(event_category_id);
});
$(document).on('click', '.event-type-edit', function() {
  var event_type_id = $(this).data('id');
  $('#event_type_id').val(event_type_id);
});
