(function ($) {
  'use strict';

  var jobIdsSelector = '#modal-wrapper .inner-popup input[name="jobIds"]';

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  function setSearchOptions() {
    // Set the sumoselect values
  }

  /**
   *
   * Get all the selected jobs
   */
  function getSelectedJobs() {
    var selected = [];
    $.each(
      $('.box-presonal.job-page .checkbox.sr-select span.is-checked'),
      function () {
        selected.push($(this).attr('jobcode'));
      }
    );
    return selected;
  }

  function openSubmitForm() {
    // Clear previous validation
    nls.clearFields($('.nls-apply-for-jobs.modal form'));

    // Remove the reply message if exists
    jQuery('#modal-wrapper .apply-response').hide();

    // Show the form in the modal
    jQuery('#modal-wrapper .inner-popup.apply-form').show();

    // Show the modal and Focus on the first input field
    jQuery('#modal-wrapper').show('slow').find('input#name').focus();

    // [tabindex]:not([tabindex="-1"])
    //  jQuery('#modal-wrapper').find('a[href], button, input, textarea, select, details, [role="button"]').attr('tabindex', 0);
  }

  $(document).ready(function () {
    // handle mobile toggle apply btn on
    $('i.toggle.fa.fa-ellipsis-v').on('click', function (e) {
      $(this)
        .parents('.job-wraper')
        .addClass('active')
        .siblings()
        .removeClass('active');
    });

    // The page URL
    var pageURL = new URL(window.location.href);

    // Handle the area filter on search results
    $('.job-content form button').on('click', function () {
      var selectedArea = $(this)
        .parents('form')
        .find('select option:checked')
        .val();
      pageURL.searchParams.delete('areas[]');
      pageURL.searchParams.append('areas[]', selectedArea);

      window.location.href =
        pageURL.protocol +
        '//' +
        pageURL.host +
        pageURL.pathname +
        '?' +
        pageURL.searchParams.toString();
    });

    // Handle the share copy link to clipboard
    $('.share-item.copy').on('click', function () {
      var shareLink = this;
      var text = $(this).data('share-url');
      navigator.clipboard.writeText(text).then(
        () => {
          // Clipboard copyed successfully
          console.log('Clipboard copyed successfully');
          var msg = $('<div class="flash-message">הקישור הועתק ללוח</div>');
          $(shareLink).append(msg);
          setTimeout(function () {
            $(msg).fadeOut(2000, function () {
              msg.remove();
            });
          }, 3000);
        },
        () => {
          // Clipboard failed to copy
          console.log('Clipboard failed to copy');
          var msg = $(
            '<div class="flash-message error">בעיה בהעתקת הקישור</div>'
          );
          $(shareLink).append(msg);
          $(msg).fadeOut(5000, function () {
            msg.remove();
          });
        }
      );
    });

    // Handle the share btn
    $(document).on('click', 'button.nls-outlined-btn.share', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).hide().parent().find('.share-widget').show();
    });

    var sumoSelect = $(
      '.nls-search-module form.nls-search .nls-field select, .nls-apply-for-jobs .nls-apply-field select'
    ).SumoSelect({
      csvDispCount: 2,
      captionFormat: '{0} נבחרו',
      captionFormatAllSelected: 'כול ה-{0} נבחרו!',
      floatWidth: 768,
      forceCustomRendering: false,
      outputAsCSV: false,
      nativeOnDevice: [
        'android',
        'webos',
        'iphone',
        'ipad',
        'ipod',
        'blackberry',
        'iemobile',
        'opera mini',
        'mobi',
      ],
      placeholder: 'בחירה',
      locale: ['אישור', 'ביטול', 'בחר הכל'],
      okCancelInMulti: false,
      isClickAwayOk: true,
      selectAll: false,
    });

    $('select.nls-search').on('sumo:opening', function (sumo) {
      // Turn arrow up make the filler div extend main to reveal all
      var sumoElement = $(this).parent();
      $(sumoElement).find('.CaptionCont>label>i').addClass('flip');
    });

    $('select.nls-search').on('sumo:closing', function (sumo) {
      // Turn arrow down
      var sumoElement = $(this).parent();
      $(sumoElement).find('.CaptionCont>label>i').removeClass('flip');

      $('div.sumo-filler').css('height', 0);
    });

    // Enable/Disable submit to selected jobs
    $('.box-presonal.job-page .checkbox-element').on(
      'change',
      function () {
        if (
          $('.box-presonal.job-page .checkbox-element.is-checked').length === 0
        ) {
          $('.step-next.pagenavis .back-step.submit-multi').addClass(
            'disabled'
          );
        } else {
          $('.step-next.pagenavis .back-step.submit-multi').removeClass(
            'disabled'
          );
        }
      }
    );

    // if sumo select is set
    // Get the search options and set them on the search form
    if (sumoSelect.length > 0) setSearchOptions();

    // Display the form when doc ready (so the sumo select rendered before)
    $('form.nls-search').show();

    // Make the Flash message apear on ready
    $('div.nls-flash-message').css('visibility', 'visible');

    // Make the Flash message remove on click
    $('div.nls-flash-message strong').on('click', function () {
      $(this).parent('div.nls-flash-message').remove();
    });

    // Show the Job Details page (from Search Results and Hot Jobs modules)
    /*
    $(document).on(
      'click',
      '.box-presonal.job-page label > span',
      function (e) {
        e.stopPropagation();
        e.preventDefault();
        var jobCode = $(this).parent().attr('for');
        window.location.assign(jobDetailsPageUrl + '?jobcode=' + jobCode);
      }
    );
    */

    // Clear the search form
    $('.nls-search-module a.clear').on('click', nls.clearFields);

    // Back to Search Page
    $(document).on('click', '#nls-search-results-new-search', function () {
      window.location.href = searchPageUrl;
    });

    $('form.nls-search input#search').on('keydown', function (e) {
      if (e.keyCode === 13) {
        e.preventDefault();
        e.stopPropagation();
        $(this).parents('form').submit();
      }
    });

    $('form.nls-search button').on('click', function (e) {
      $(this).parents('form').submit();
    });

    // Open the modal with the submision form
    $('.searc-results-wrapper a.btn-table').on('click', function () {
      var jobIds = getSelectedJobs();
      var jobId = $(this).attr('jobcode');

      if (jobIds.indexOf(jobId) === -1) {
        jobIds.push(jobId);
      }

      console.log(jobIds);
      $(jobIdsSelector).val(jobIds);

      openSubmitForm();
    });

    // Open the modal with the submision form - multi select
    $('.searc-results-wrapper .back-step.submit-multi').on(
      'click',
      function () {
        var jobIds = getSelectedJobs();

        $(jobIdsSelector).val(jobIds);
        console.log(jobIds);

        openSubmitForm();
      }
    );

    var formData = new FormData();
    formData.append('action', 'locations_function'),
      $('.item-contact .link-all').on('click', function () {
        var localionsContet = $(this).parents('.our-contact');
        $.ajax({
          url: apply_cv_script.applyajaxurl,
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          dataType: 'json',
          beforeSend: function () {
            $(localionsContet).append(
              '<div id="nls-loader" class="loader" style="padding: 2rem;">אנא המתן...  <i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>'
            );
          },
          success: function (response) {
            console.log('Status: ', response.success);
            if (response.success) {
              $(localionsContet).replaceWith(response.data.html);
            } else {
              $(localionsContet).append(
                '<p>התרחשה שגיאה בקבלת המיקומים מהשרת</p>'
              );
            }

            // Call this function so the wp will inform the change to the post
            $(document.body).trigger('post-load');
          },
          type: 'POST',
        });
      });

    // Open the modal with the submision form - job details
    $('.info-job .apply-job').on('click', function () {
      var jobIds = $(this).attr('jobcode');

      $(jobIdsSelector).val(jobIds);

      openSubmitForm();
    });
  });
})(jQuery);
