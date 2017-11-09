/**
 * This file contains an official functionalities that support this
 * system better at interacting the user.
 *
 * Notice that we enclosed all the functions defined here in a
 * big function? This is to prevent all the functions and variable here
 * to clobber all other variables used in other files in a global scope
 *
 * This would also prevent us to have bugs in the future, because our variable
 * are sure only being used here and becuase every function in javascript
 * has a scope.
 *
 * @author Fil <filjoseph22@gmail.com>
 * @author Liz <janicalizdeguzman@gmail.com>
 * @since 0.1
 * @version 2.20
 * @date 09-30-2017
 * @date 10-27-2017 - last updated
 */
(function() {
  /**
   * Global variable for this file
   * @type {mixed}
   */
  var method    = 'post';
  var preloader = '';
  var complete  = true;
  var param     = '';
  var action    = "";
  var next      = 1;

  /**
   * Work when the user click on event title
   *
   * @return {void}
   */
  $(document).on('click', '.event-title', function() {
    var _this = $(this).parents('tr');

    var $url           = _this.data('route');
    var action         = _this.data('action');
    var approval       = _this.data('approval');
    var organizationId = _this.data('organization-id');
    var eventTypeId    = _this.data('event-type-id');
    var userTypeId     = _this.data('user-type-id');
    var personal       = _this.data('personal');

    // console.log(organizationId);

    if ( userTypeId == 3 ) {
      if (organizationId != undefined || personal == undefined || approval == true || eventTypeId == 2) {
        $('.social-media-notification').hide();
      }
    }

    /**
     * Make http request for editing the event using GET method
     * and setup the modal elements data
     */
    axios_get($url, function(data) {
      data.forEach(function(currentValue, index, arr) {
        eventModal(currentValue, eventTypeId);
      });
    });
  });

  /**
   * Work when the user click on edit-notif
   *
   * @return {void}
   */
  $(document).on('click', '.edit-notif', function () {
    var _this = $(this).parents('tr');

    var $url           = _this.data('route');
    var action         = _this.data('action');
    var approval       = _this.data('approval');
    var organizationId = _this.data('organization-id');
    var eventTypeId    = _this.data('event-type');
    var userTypeId     = _this.data('user-type-id');
    var personal       = _this.data('personal');

    /**
     * Make http request for editing the event using GET method
     * and setup the modal elements data
     */
    axios_get($url, function (data) {
      data.forEach(function (currentValue, index, arr) {
        eventModal(currentValue, eventTypeId);
      });
    });
  });

  /**
   * A beautiful alert message will show up
   * after a Successful transactions
   *
   * @return {void}
   */
  $(document).on('click', '#modal-additional-messages', function() {
    var formData = $(this).parents('form').serialize();
    var url      = $(this).parents('form').attr('action');

    axios_post(url, formData, function(data) {
      if (data.result == 'true') {
        swal({
          title: "Great!",
          text: "Successfully saved changes!",
          icon: "success"
        });
      }
    });
  });

  /**
   * Provide information on modal event notification
   * @return {void}
   */
  $(document).on('click', '#modal-event-notification', function() {
    swal({
      title: "Great!",
      text: "Successfully saved changes!",
      icon: "success"
    });
  });

  /**
   * Provide information about the user in modal prompt
   *
   * @return {void}
   */
  $(document).on('click', '.user-name', function() {
    var $id = $(this).data('user-id');

    axios_post('/modals/get/user', {id: $id}, function(data) {
      data = data[0];

      $('#full-name').html(data.full_name);
      $('#profile-picture').html('<img class="org-logo" src="/img/profile/'+data.picture+'" alt="Profile Picture">');
      $('#account-number').html("<strong>Account Number</strong>: " + '<a href="#">'+data.account_number+'</a>');
      $('#course').html("<strong>Course</strong>: " + '<a href="#">'+data.course.name+'</a>');
      $('#email').html("<strong>Email</strong>: " + '<a href="#">'+data.email+'</a>');
      $('#account').html("<strong>Account Type</strong>: " + '<a href="#">'+data.user_type.name+'</a>');
      $('#mobile-number').html("<strong>Mobile Number</strong>: " + '<a href="#">+'+data.mobile_number+'</a>');
      $('#facebook').html("<strong>Facebook Account</strong>: " + '<a href="#">'+data.facebook+'</a>');
      $('#twitter').html("<strong>Twitter Account</strong>: " + '<a href="#">'+data.twitter+'</a>');

      var organization = "";
      var position     = "";

      for (var i = 0; i < data.organization_group.length; i++) {
        organization += '<a href="#">'+ data.organization_group[i].organization.name +'</a>';

        if (data.organization_group[i].position.name != 'Not Applicable') {
          position += '<a href="#">'+ data.organization_group[i].position.name +'</a> @ '+data.organization_group[i].organization.name+'<br>';
        }
        if (data.organization_group.length > 1) {
          organization += "<br>";
        }
      }

      $('#organizations').html("<strong>Organization(s)</strong>: <br>" + organization);
      $('#positions').html("<strong>Position(s)</strong>: <br>" + position);
    });
  });

  /**
   * Provide course information with the user click
   * on course
   *
   * @return {void}
   */
  $(document).on('click', '.user-course', function() {
    var $id = $(this).data('course-id');

    if ($id == '') {
      $('#modal-course-title').html("No Course Assign Yet");
      $('#modal-course-content').html("");
      $('#modal-course-sourse').html("");
    } else {
      axios_post('/modals/get/course', {id: $id}, function(data) {
        $('#modal-course-title').html(data.name);
        $('#modal-course-content').html(
          '<p><strong>'+ data.name +'</strong> '+ data.description +'.</p>'
        );
        $('#modal-course-sourse').html(
          '<a href="'+data.source+'" target="_blank">Source</a>'
        );
      });
    }

  });

  /**
   * Provide information about organization
   *
   * @return {void}
   */
  $(document).on('click', '.user-organization', function() {
    var $id = $(this).data('organization-id');

    axios_post('/modals/get/organization', {id: $id}, function(data) {
      $('#modal-organization-title').html(data.name);
      $('#modal-organization-acronym').html("<strong>Acronym</strong>: <a href='#'>"+data.acronym+"</a>");
      $('#modal-organization-description').html("<strong>Description</strong>: <a href='#'>"+data.description+"</a>");
      $('#modal-organization-aniversary').html("<strong>Aniversary</strong>: <a href='#'>"+data.aniversary+"</a>");
      $('#modal-organization-color').html("<strong>Color</strong>: <a href='#'>"+data.color+"</a>");
      $('#modal-organization-status').html("<strong>Status</strong>: <a href='#'>"+data.status+"</a>");
      $('#modal-organization-url').html("<strong>URL</strong>: <a href='#'>"+data.url+"</a>");
    });
  });

  /**
   * Provide information about the position
   *
   * @return {void}
   */
  $(document).on('click', '.user-position', function() {
    var $id = $(this).data('position-id');

    axios_post('/modals/get/position', {id: $id}, function(data) {
      $('#modal-position-title').html(data.name);
      $('#modal-position-description').html("<strong>Description</strong>: <a href='#'>"+data.description+"</a>");
    });
  });

  /**
   * Provide information on modal-edit
   * @return {void}
   */
  $(document).on('click', '.user-edit', function() {
    var $url = $(this).data('route');

    axios_get($url, function(data) {
      var user_type =
        '<select class="form-control show-tick" id="user_type_id" name="user_type_id">' +
        '<option value="">-- Select User Account --</option>';
      var course    =
        '<select class="form-control show-tick" id="course_id" name="course_id"> ' +
        '<option value="">-- Select Course --</option>';

      data.course.map(function(key) {
        course += '<option value="'+key.id+'">'+key.name+'</option>';
      });
      data.user_type.map(function(key) {
        user_type += '<option value="'+key.id+'">'+key.name+'</option>';
      });

      course += '</select>';
      user_type += '</select>';

      $('#full_name').val(data.user.full_name);
      $('#account_number').val(data.user.account_number);
      $('#modal-edit-course').html(course);
      $('#modal-edit-user-account').html(user_type);

      $('#modal-edit-user-form').attr('action', '/User/'+data.user.id);
    })
  });

  /**
   * Provide information on org-profile modal
   * about the click organization
   * @return {void}
   */
  $(document).on('click', '.organization-list-name', function() {
    var data = {
      id: $(this).parents('tr').data('organization-id')
    };

    eventType = $(this).parents('tr').data('event-type');

    axios_post(route('modal.getOrganization'), data, function(data) {
      $('#org-profile-title').html(data.name);
      $('#org-profile-acronym').html('<strong>Acronym</strong>: <a href="#">'+data.acronym+'</a>');
      $('#org-profile-description').html('<strong>Description</strong>: <a href="#">'+data.description+'</a>');
      $('#org-profile-url').html('<strong>URL</strong>: <a href="'+data.url+'" target="_blank">'+data.url+'</a>');
      $('#org-profile-aniversary').html('<strong>Aniversary</strong>: <a href="#">'+data.aniversary+'</a>');

      $('#official-event-submit').attr('href', '/event/org-events/1/' + data.id);
      $('#local-event-submit').attr('href', '/event/org-events/2/' + data.id);
      $('#member-list').attr('href', '/User/org-member/'+data.id);
    });
  });

  /**
   * from organization - list.blade.php button with id = "official-event-submit" at modal
   */
  $(document).on('click', '#official-event-submit', function () {
    var id        = $(this).data('org-id');
    var eventType = $(this).data('event-type');

    data = {
      id: id,
      event_type: eventType
    };

    axios_post('/event/org-official-events', data, function (result) {
      window.location = "/path/here/";
    })
  });

  /**
   * Provide user list on the modal for official attendance
   * @return {void}
   */
  $(document).on('click', '.event-attendance-official', function() {
    var id = $(this).parents('tr').data('event');
    var data = {
      id: id
    }

    axios_post('/attendance/get/official/attendance', data, function(data) {
      var html = "";
      data.map(function (data) {
        html +=
          '<tr>' +
          '<td><a href="#">' + data.user.full_name + '</a></td>' +
          '<td>' +
          '<button type="button" class="btn btn-primary bg-teal" name="button">Attend</button>' +
          '</td>' +
          '</tr>';
      });

      $('#event-attendees').html(html);

    })
  });

  /**
   * Provide user list on the modal for confirmed attendance
   * @return {void}
   */
  $(document).on('click', '.event-attendance-confirmed', function () {
     var id = $(this).parents('tr').data('event');
     var data = {
       id: id
      }

    axios_post('/attendance/get/confirmed/attendance', data, function(data) {
      var html = "";
      data.map(function (data) {
        html +=
          '<tr>' +
          '<td><a href="#">' + data.user.full_name + '</a></td>' +
          '<td>' +
          '<button type="button" class="btn btn-primary bg-teal" name="button">Attend</button>' +
          '</td>' +
          '</tr>';
      });

      $('#event-attendees').html(html);
    });
  });

  /**
   * Provide user list on the modal for expected attendance
   * @return {void}
   */
  $(document).on('click', '.event-attendance-expected', function () {
    var id   = $(this).parents('tr').data('event');
    var data = {
      id: id
    }

    axios_post('/attendance/get/expected/attendance', data, function (data) {
      var event_type = data.event_type;
      var html = "";

      data.result.map(function (data) {
        html +=
        '<tr>';

        if (event_type == 1){
          html +=   '<td><a href="#">' + data.full_name + '</a></td>';
        } else {
          html += '<td><a href="#">' + data.user.full_name + '</a></td>';
        }

        html +=
          '<td>' +
            '<button type="button" class="btn btn-primary bg-teal" name="button">Attend</button>' +
          '</td>' +
        '</tr>';
      });

      $('#event-attendees').html(html);
    });
  });

  /**
   * Provide user list on the modal for declined attendance
   * @return {void}
   */
  $(document).on('click', '.event-attendance-declined', function () {
    var id = $(this).parents('tr').data('event');
    var data = {
      id: id
    }

    axios_post('/attendance/get/declined/attendance', data, function (data) {
      var html = "";
      data.map(function (data) {
        html +=
          '<tr>' +
          '<td><a href="#">' + data.user.full_name + '</a></td>' +
          '<td>' +
          '<button type="button" class="btn btn-primary bg-teal" name="button">Attend</button>' +
          '</td>' +
          '</tr>';
      });

      $('#event-attendees').html(html);
    });
  });

  /**
   * Add new form field for registering new user
   * @var void
   */
  $(document).on('click', '.add-field', function(e) {
    e.preventDefault();

    // Issue  23
    // Define ID
    var addto = "#input" + next;
    next = next + 1;

    // get the template html
    var newIn = $('#registration-form-template').html();

    // Replate concerns
    newIn = newIn.replace('templateid', 'input' + next);
    newIn = newIn.replace('templateremoveid', next);

    // Append to existing field
    $(addto).after(newIn);
  });

  /**
   * Remove the added field
   * @var void
   */
  $(document).on('click', '.remove', function(e) {
    e.preventDefault();

    // Get the remove number
    var removeNumber = $(this).data('remove');

    // use the remove number to define ID
    var fieldID = "#input" + removeNumber;
    next        = removeNumber - 1;

    // Remove field
    $(fieldID).remove();
  });

  /**
   * Update the facebook notification settings
   *
   * @return {void}
   */
  $(document).on('click', '#facebook .lever.switch-col-teal', function() {
    var id        = $('#facebook').data('event-id');
    var eventType = $(this).data('event-type-id');
    var url       = '/Event/' + id;

    // naa pa problem kay ang eventtyp naa pud sa event table '2' ang value

    if (eventType == 2) {
      url = '/PersonalEvent/' + id;
    }

    var data = {
      '_method': 'PUT',
      'facebook': $('#facebook [name="facebook"]').prop('checked')
    };

    axios_post(url, data, function(data) {
      // no code for here as of a moment
    })
  });

  $(document).on('click', '#twitter .lever.switch-col-teal', function() {
    var id        = $('#twitter').data('event-id');
    var eventType = $(this).data('event-type-id');
    var url       = '/Event/' + id;

    // naa pa problem kay ang eventtyp naa pud sa event table '2' ang value

    if (eventType == 2) {
      url = '/PersonalEvent/' + id;
    }

    var data = {
      '_method': 'PUT',
      'twitter': $('#twitter [name="twitter"]').prop('checked')
    };

    axios_post(url, data, function(data) {})
  });

  $(document).on('click', '#sms .lever.switch-col-teal', function() {
    var id        = $('#sms').data('event-id');
    var eventType = $(this).data('event-type-id');
    var url       = '/Event/' + id;

    // naa pa problem kay ang eventtyp naa pud sa event table '2' ang value

    if (eventType == 2) {
      url = '/PersonalEvent/' + id;
    }

    var data = {
      '_method': 'PUT',
      'sms': $('#sms [name="sms"]').prop('checked')
    };

    axios_post(url, data, function (data) { })
  });

  $(document).on('click', '#email .lever.switch-col-teal', function() {
    var id        = $('#email').data('event-id');
    var eventType = $(this).data('event-type-id');
    var url       = '/Event/' + id;

    // naa pa problem kay ang eventtyp naa pud sa event table '2' ang value

    if (eventType == 2) {
      url = '/PersonalEvent/' + id;
    }

    var data = {
      '_method': 'PUT',
      'email': $('#email [name="email"]').prop('checked')
    };

    axios_post(url, data, function (data) { })
  });

  /**
   * New player for deal with http request
   *
   * @param  {string}   url
   * @param  {Function} callback
   * @return {void}
   */
  var axios_get = function(url, callback)
  {
    axios.get(url)
      .then(function (response) {
        callback(response.data);
      }).catch(function (error) {
        console.log(error);
      });
  }

  /**
   * Make http request using post
   * but since we're using laravel not only put
   * but put, patch and delete too
   *
   * @param  {string}   url
   * @param  {object}   data
   * @param  {Function} callback
   * @return {void}
   */
  var axios_post = function(url, data, callback)
  {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    axios.post(url, data)
      .then(function (response) {
        callback(response.data);
      })
      .catch(function (error) {
        console.log(error);
      });
  }

  /**
   * Modify the event modal
   *
   * @param {object} currentValue
   * @param {int} eventTypeId
   */
  var eventModal = function (currentValue, eventTypeId) {
    // console.log(currentValue);
    // write html
    $('#modal-event-title').html(currentValue.title);
    $('#modal-event-ptitle').html("Title: " + currentValue.title);
    $('#modal-event-venue').html("Venue: " + currentValue.venue);
    $('#modal-event-description').html("Description: " + currentValue.description);

    if (currentValue.organization != null || currentValue.organization != undefined) {
      $('#modal-event-organization').html("Organizer: " + currentValue.organization.name);
    } else {
      $('#modal-event-organization').html("Organizer: " + currentValue.user.full_name);
    }
    $('#modal-event-category').html("Category: " + currentValue.category + " event");
    $('#facebook_msg').html(currentValue.facebook_msg);
    $('#twitter_msg').html(currentValue.twitter_msg);
    $('#email_msg').html(currentValue.email_msg);
    $('#sms_msg').html(currentValue.sms_msg);
   console.log(currentValue);
    // set attributes
    if( currentValue.event_type_id == 2 || currentValue.is_approve == 'true'){
      $('#modal-advertise-local-events').removeClass('hidden');
      $('#modal-request-approval').addClass('hidden');
    }

    $('#modal-advertise-local-events-form').attr('action', '/event/AdvertiseEvent');
    $('#advertise_id').val(currentValue.id);
    $('#advertise_category').val(currentValue.category);

    $('#form-additional-message').attr('action', action);

    $('#modal-request-approval-form').attr('action', '/Request/' + currentValue.id);

    $('#facebook').attr('data-event-id', currentValue.id);
    $('#facebook .lever').attr('data-event-type-id', eventTypeId);

    $('#twitter').attr('data-event-id', currentValue.id);
    $('#twitter .lever').attr('data-event-type-id', eventTypeId);

    $('#sms').attr('data-event-id', currentValue.id); eventTypeId
    $('#sms .lever').attr('data-event-type-id', eventTypeId);

    $('#email').attr('data-event-id', currentValue.id); eventTypeId;
    $('#email .lever').attr('data-event-type-id', eventTypeId);

    $('#modal-attend-form').attr('action', '/Attendances/' + currentValue.id); // Set route

    // If the following is off, remove checked attribute
    if (currentValue.facebook == 'off') {
      $('#facebook [name="facebook"]').prop('checked', null);
    }
    if (currentValue.twitter == 'off') {
      $('#twitter [name="twitter"]').prop('checked', null);
    }
    if (currentValue.sms == 'off') {
      $('#sms [name="sms"]').prop('checked', null);
    }
    if (currentValue.email == 'off') {
      $('#email [name="email"]').prop('checked', null);
    }

    // set value
    $('#modal-request-approval-form > #id').val(currentValue.id);
  }
})();
