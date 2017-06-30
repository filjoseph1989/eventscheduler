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
          swal("Deleted!", data.name+" was Successfuly deleted!", "success").then(
            function() {
              location.reload();
            }
          );
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


// $(function () {
//     $('.delete').on('click', function () {
//         var type = $(this).data('type');
//         if (type === 'basic') {
//             showBasicMessage();
//         }
//         else if (type === 'with-title') {
//             showWithTitleMessage();
//         }
//         else if (type === 'success') {
//             showSuccessMessage();
//         }
//         else if (type === 'confirm') {
//             showConfirmMessage();
//         }
//         else if (type === 'cancel') {
//             showCancelMessage();
//         }
//         else if (type === 'with-custom-icon') {
//             showWithCustomIconMessage();
//         }
//         else if (type === 'html-message') {
//             showHtmlMessage();
//         }
//         else if (type === 'autoclose-timer') {
//             showAutoCloseTimerMessage();
//         }
//         else if (type === 'prompt') {
//             showPromptMessage();
//         }
//         else if (type === 'ajax-loader') {
//             showAjaxLoaderMessage();
//         }
//     });
// });

// //These codes takes from http://t4t5.github.io/sweetalert/
// function showBasicMessage() {
//     swal("Here's a message!");
// }
//
// function showWithTitleMessage() {
//     swal("Here's a message!", "It's pretty, isn't it?");
// }
//
// function showSuccessMessage() {
//     swal("Good job!", "You clicked the button!", "success");
// }
//
// function showConfirmMessage() {
//     swal({
//         title: "Are you sure?",
//         text: "You will not be able to recover this imaginary file!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Yes, delete it!",
//         closeOnConfirm: false
//     }, function () {
//         swal("Deleted!", "Your imaginary file has been deleted.", "success");
//     });
// }
//
// function showCancelMessage() {
//     swal({
//         title: "Are you sure?",
//         text: "You will not be able to recover this imaginary file!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Yes, delete it!",
//         cancelButtonText: "No, cancel plx!",
//         closeOnConfirm: false,
//         closeOnCancel: false
//     }, function (isConfirm) {
//         if (isConfirm) {
//             swal("Deleted!", "Your imaginary file has been deleted.", "success");
//         } else {
//             swal("Cancelled", "Your imaginary file is safe :)", "error");
//         }
//     });
// }
//
// function showWithCustomIconMessage() {
//     swal({
//         title: "Sweet!",
//         text: "Here's a custom image.",
//         imageUrl: "../../images/thumbs-up.png"
//     });
// }
//
// function showHtmlMessage() {
//     swal({
//         title: "HTML <small>Title</small>!",
//         text: "A custom <span style=\"color: #CC0000\">html<span> message.",
//         html: true
//     });
// }
//
// function showAutoCloseTimerMessage() {
//     swal({
//         title: "Auto close alert!",
//         text: "I will close in 2 seconds.",
//         timer: 2000,
//         showConfirmButton: false
//     });
// }
//
// function showPromptMessage() {
//     swal({
//         title: "An input!",
//         text: "Write something interesting:",
//         type: "input",
//         showCancelButton: true,
//         closeOnConfirm: false,
//         animation: "slide-from-top",
//         inputPlaceholder: "Write something"
//     }, function (inputValue) {
//         if (inputValue === false) return false;
//         if (inputValue === "") {
//             swal.showInputError("You need to write something!"); return false
//         }
//         swal("Nice!", "You wrote: " + inputValue, "success");
//     });
// }
//
// function showAjaxLoaderMessage() {
//     swal({
//         title: "Ajax request example",
//         text: "Submit to run ajax request",
//         type: "info",
//         showCancelButton: true,
//         closeOnConfirm: false,
//         showLoaderOnConfirm: true,
//     }, function () {
//         setTimeout(function () {
//             swal("Ajax request finished!");
//         }, 2000);
//     });
// }

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
