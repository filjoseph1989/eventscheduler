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
 * @version 2
 * @date 09-30-2017
 * @date 09-30-2017 - last updated
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

  /**
   * Work when the user click on event title
   *
   * @return {void}
   */
  $(document).on('click', '.event-title', function() {
    var $url = $(this).parents('tr').data('route');
    action   = $(this).parents('tr').data('action');

    // Make http request for editing the event
    axios_get($url, function(data) {
      data.forEach(function(currentValue, index, arr) {
        $('#modal-event-title').html(currentValue.title);
        $('#modal-event-ptitle').html("Title: " + currentValue.title);
        $('#modal-event-venue').html("Venue: " + currentValue.venue);
        $('#modal-event-description').html("Description: " + currentValue.description);
        $('#form-additional-message').attr('action', action);
        $('#facebook_msg').html(currentValue.facebook_msg);
        $('#twitter_msg').html(currentValue.twitter_msg);
        $('#email_msg').html(currentValue.email_msg);
        $('#sms_msg').html(currentValue.sms_msg);
      });
    });
  });

  /**
   * A beautiful alert message will show up
   * after a Successful transactions
   *
   * Issue 13
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
  $(document).on('click', '#modal-event-notification', function() {
    swal({
      title: "Great!",
      text: "Successfully saved changes!",
      icon: "success"
    });
  });

  /**
   * Make http request
   *
   * @param  {object}   data Any data to be pass
   * @param  {string}   url A given route to where data to be pass
   * @param  {Function} callback A function to call
   * @param  {String}   [preloader='']
   * @param  {Boolean}  [complete=true]
   * @return {void}
   */
  function submit(data, url, callback) {
    if (param == '') {
      url = route(url).replace('localhost', window.location.hostname);
    } else {
      url = route(url, param).replace('localhost', window.location.hostname);
    }

    $.ajax({
      type: method,
      url: url,
      data: data,
      dataType: 'json',
      beforeSend: function(request) {
        request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
        if (preloader != '') {
          var html =
          '<div class="preloader pl-size-xs">' +
            '<div class="spinner-layer pl-red-grey">' +
              '<div class="circle-clipper left">' +
                '<div class="circle"></div>' +
              '</div>' +
              '<div class="circle-clipper right">' +
                '<div class="circle"></div>' +
              '</div>' +
            '</div>' +
          '</div>';

          $(preloader).html(html);
        }
      },
      complete: function(data) {
        if (complete == true) {
          $(preloader).html('');
        }
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
   * New player for deal with http request
   *
   * @param  {string}   url
   * @param  {Function} callback
   * @return {void}
   */
  var axios_get = function(url, callback)
  {
    // can be performed also using this
    // axios.get(url, { params: data })

    axios.get(url)
      .then(function (response) {
        callback(response.data);
      }).catch(function (error) {
        console.log(error);
      });
  }

  var axios_post = function(url, data, callback)
  {
    axios.post(url, data)
      .then(function (response) {
        callback(response.data);
      })
      .catch(function (error) {
        console.log(error);
      });
  }
})();
