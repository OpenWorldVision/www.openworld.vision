jQuery(document).ready(function() {
  "use strict";

  if(jQuery('body').hasClass('admin-color-fresh')) {
    jQuery('html').addClass('admin-color-fresh-html');
  }

  jQuery(document).on('change', '.yprm-input.required', function() {
    var $el = jQuery(this);
    
    if(!$el.val()) {
      $el.addClass('error');
    } else {
      $el.removeClass('error');
    }
  });

  jQuery('.yprm-widget.dropdown').on('click', '.title', function() {
    jQuery(this).toggleClass('active').next().slideToggle();
  });

  jQuery('.yprm-validation-form button.yprm-button').on('click', function(e) {
    e.preventDefault();
    
    var $this = jQuery(this).parents('form'),
    $button = jQuery(this),
    ajax = '';

    $this.find('.yprm-input').each(function() {
      if(!jQuery(this).val()) {
        jQuery(this).addClass('error');
      }
    });

    if($this.find('.error').length > 0) {
      return false;
    }

    $button.addClass('loading');

    var envato_purchase_code = $this.find('[name="envato-purchase-code"]').val();

    if(typeof envato_setup_params !== 'undefined') {
      ajax = envato_setup_params.yprm_ajax;
    } else {
      ajax = ajaxurl;
    }

    console.log(ajax);

    jQuery.ajax({
      url: ajax,
      type: "POST",
      data: {
        action: 'validation_code',
        envato_purchase_code: envato_purchase_code,
        removed_status: $button.hasClass('register') ? 0 : 1
      },
      success: function (response) {
        var result = jQuery.parseJSON(response);

        console.log(response);

        if(result == null || result == 'null' || typeof result.result == 'undefined' || result.result == 'access_denied' || result.result == 'remove_success') {
          var error_message = 'Code is not valid',
          delay = 2000;
          $this.find('[name="envato-purchase-code"]').addClass('error').val('');
          $this.find('.yprm-input-row').removeClass('is-ok');
          $this.find('.deregister').fadeOut();
          $this.find('.yprm-message.is-ok').removeClass('is-ok').text('You can register one license per one website.');
          if(result == null || result == 'null' || typeof result.result == 'undefined') {
            error_message = 'Something wrong. Could you try register the purchase code later.';
          } else if(result.result == 'access_denied') {
            if(result.reason == 'wrong_p_code') {
              error_message = 'The purchase code is wrong.';
            } else if(result.reason == 'code_registered') {
              error_message = 'The purchase code already has been registered on this domain: '+result.domain;
              delay = 10000;
            } else if(result.reason == 'db_error') {
              error_message = 'Something wrong. Could you try register the purchase code later.';
            }
          } else if(result.result == 'remove_success') {
            error_message = 'Remove Success';
          }
          $this.find('.yprm-log-massage').removeClass('is-ok').addClass('is-error').html(error_message).slideDown().delay(delay).slideUp();
          $this.find('.yprm-button.register').show();
          $this.find('.yprm-button.deregister').hide();
        } else if(result.result == 'access_success') {
          $this.find('.yprm-input-row').addClass('is-ok');
          $this.find('.yprm-log-massage').removeClass('is-error').addClass('is-ok').text('Congratulations, Your theme is activated.').slideDown();
          $this.find('.yprm-button.register').hide();
          $this.find('.yprm-button.deregister').show();
        }
        
        $button.removeClass('loading');
      },
    });
  });
});