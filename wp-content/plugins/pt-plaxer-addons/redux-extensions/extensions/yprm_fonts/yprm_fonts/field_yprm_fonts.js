/* global confirm, redux, redux_change */

jQuery(document).ready(function() {
  var $result_input = jQuery('.redux-container-yprm_fonts .result-input');

  jQuery('.redux-container-yprm_fonts').parent().prev().css({'width': 0, 'padding': 0});

  function yprm_remove_font(array) {
    var result_val = $result_input.attr('value');

    result_val = $result_input.attr('value').toString().replace(array.toString(), '').replace(',,', ',');

    if(result_val.length && result_val[0] == ',') {
      result_val = result_val.slice(1);
    }
    if(result_val.length && result_val[result_val.length-1] == ',') {
      result_val = result_val.slice(0, -1);
    }

    $result_input.attr('value', result_val);
    
    if(jQuery('.yprm-custom-fonts-widget .yprm-font-items .item').length == 0) {
      jQuery('.yprm-custom-fonts-widget .yprm-font-items').slideUp();
      jQuery('.yprm-custom-fonts-widget .yprm-fonts-empty').slideDown();
    }
      
    jQuery('#redux_save_sticky').trigger('click');  
  }

  jQuery('.yprm-font-items').on('click', '.nav .item:not(.current)', function() {
    jQuery(this).addClass('current').siblings().removeClass('current').parents('.yprm-font-items').find('.group-item').eq(jQuery(this).index()).addClass('current').siblings().removeClass('current');
  }).on('click', '.group-item .item .button', function(e) {
    e.preventDefault();

    if(jQuery(this).parents('.item').hasClass('active')) return false;

    var $el = jQuery(this),
    val = $el.attr('data-item'),
    result_val = $result_input.attr('value');

    if(result_val) {
      result_val = result_val+','+val;
    } else {
      result_val = val;
    }

    $result_input.attr('value', result_val);

    jQuery.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: 'custom_fonts',
        array: val
      },
      success: function (data) {
        $el.text('Added').parents('.item').addClass('active');

        jQuery('.redux-container-yprm_fonts .yprm-font-items').slideDown();
        jQuery('.redux-container-yprm_fonts .yprm-fonts-empty').slideUp();

        jQuery('.yprm-custom-fonts-widget .items').append(data);
      },
      error: function(errorThrown){
        console.log(errorThrown);
      }
    });
    
    jQuery('#redux_save_sticky').trigger('click');
  }).on('click', '.items .item .button.remove', function(e) {
    e.preventDefault();

    var $el = jQuery(this),
    result_array = $el.attr('data-item'),
    family = $el.parents('.item').attr('data-font-family');

    $el.parents('.item').slideUp(function() {
      jQuery(this).remove();
      yprm_remove_font(result_array);
    }).parents('.redux-container-yprm_fonts').find('[data-font-family="'+family+'"]').removeClass('active').find('.button').text('Add');
  });

  jQuery('.yprm-typekit-form').on('click', '.button', function(e) {
    e.preventDefault();

    var $button = jQuery(this),
    $form = $button.parents('.yprm-typekit-form'),
    array = $button.attr('data-array'),
    result_val = $result_input.attr('value'),
    flag = true;

    $form.find('.required').each(function() {
      if(!jQuery(this).val()) {
        flag = false;

        jQuery(this).addClass('error');
      }
    });

    if(!flag) return false;

    if(!$button.hasClass('current')) {
      $button.text('Loading...');

      if($form.find('.yprm-input').val() != '') {
        var data = new FormData;
        data.append('action', 'typekit_fonts');
        data.append('typekit_project_id', $form.find('[name="plaxer_theme[custom_fonts][typekit_project_id]"]').val());

        jQuery.ajax({
          url: ajaxurl,
          type: "POST",
          data: data,
          cache: false,
          processData: false,
          contentType: false,
          success: function (data) {
            var result = JSON.parse(data),
            val = JSON.stringify(result.array);

            jQuery('.redux-container-yprm_fonts .yprm-font-items').slideDown();
            jQuery('.redux-container-yprm_fonts .yprm-fonts-empty').slideUp();

            val = val.substring(0, val.length - 1).substring(1);

            if(result_val) {
              result_val = result_val+','+val;
            } else {
              result_val = val;
            }

            jQuery('.yprm-custom-fonts-widget .items').append(result.html);
            $result_input.attr('value', result_val);

            $button.attr('data-array', val).addClass('current').text('Deregister Key');
            
            jQuery('#redux_save_sticky').trigger('click');
          },
          error: function(errorThrown){
            console.log(errorThrown);
          }
        });
      }
    } else {
      $form.find('input').attr('value', '');
      jQuery('.redux-container-yprm_fonts .yprm-font-items [data-type="typekit"]').slideUp(function() {
        jQuery(this).remove();
        yprm_remove_font(array);
      });
      
      $button.removeClass('current').text('Register Key');
    }
  });

  jQuery('.yprm-custom-font-form').on('change', '.upload-input', function(e) {
    var $el = jQuery(this),
    $button = $el.parents('.yprm-custom-font-form').find('.button'),
    file = e.target.files[0];
    
    if(!file) {
      $el.attr('data-file', '').parent().removeClass('uploaded');

      return false;
    }

    var data = new FormData;
    data.append('action', 'custom_font');
    data.append('file', file);

    $el.parent().addClass('loading');
    $button.addClass('disable');

    jQuery.ajax({
      url: ajaxurl,
      type: "POST",
      data: data,
      dataType: 'json',
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        $el.attr('data-file', data.file).parent().removeClass('loading').addClass('uploaded');
        $button.removeClass('disable');
        console.log(data);
      },
      error: function(errorThrown){
        console.log('error');
        console.log(errorThrown);
      }
    });
  }).on('click', '.button', function(e) {
    e.preventDefault();

    var $button = jQuery(this),
    $form = $button.parents('.yprm-custom-font-form'),
    $font_family = $form.find('.yprm-input'),
    $upload_field = $form.find('.upload .upload-input'),
    fonts = new Array();

    if(!$font_family.val()) {
      return false;
    }

    $upload_field.each(function() {
      var val = jQuery(this).attr('data-file');

      if(jQuery(this).parent().hasClass('loading')) {
        return false;
      }
      
      if(val) {
        fonts.push(val);
      }
    });

    if(fonts.length == 0) {
      return false;
    }

    $button.text('Loading...');

    jQuery.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: 'build_custom_font',
        fonts: fonts,
        font_family: $font_family.val()
      },
      success: function (data) {
        data = JSON.parse(data);

        var val = data['json'],
        result_val = $result_input.attr('value');

        $button.text('Add Font');

        $font_family.attr('value', '');

        $upload_field.each(function() {
          jQuery(this).val('').parent().removeClass('uploaded');
        });

        jQuery('.redux-container-yprm_fonts .yprm-font-items').slideDown();
        jQuery('.redux-container-yprm_fonts .yprm-fonts-empty').slideUp();

        if(result_val) {
          result_val = result_val+','+val;
        } else {
          result_val = val;
        }

        $result_input.attr('value', result_val);

        jQuery('.yprm-custom-fonts-widget .items').append(data['html']);
        
        jQuery('#redux_save_sticky').trigger('click');
      },
    });
  });
});
