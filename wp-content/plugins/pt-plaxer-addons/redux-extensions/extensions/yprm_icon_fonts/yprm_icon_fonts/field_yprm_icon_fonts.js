/* global confirm, redux, redux_change */

jQuery(document).ready(function() {
  jQuery('.yprm-icon-font').on('change', '.upload-input', function(e) {
    var $block = jQuery(this).parents('.yprm-icon-font'),
    $el = jQuery(this),
    $input = $block.find('input[type="hidden"]'),
    file = e.target.files[0],
    val = '';
    
    if(!file) {
      $el.attr('data-file', '').parent().removeClass('uploaded');

      return false;
    }

    var data = new FormData;
    data.append('action', 'upload_icon_font');
    data.append('file', file);

    $el.parent().addClass('loading');
    $block.find('.message').slideUp();

    jQuery.ajax({
      url: yprm_ajax.url,
      type: "POST",
      data: data,
      dataType: 'json',
      cache: false,
      processData: false,
      contentType: false,
      success: function (data) {
        if(data == 'it_exits') {
          $block.find('.message').slideDown();
        } else {
          if($input.attr('value')) {
            val = $input.attr('value');
            val += ', ';
          }
          $input.attr('value', val+JSON.stringify(data.json));
          jQuery('head').append(data.link);
          $block.find('.message').before(data.html);
          
          console.log(data);
          $el.parent().removeClass('loading');

          jQuery('#redux_save_sticky').trigger('click');
        }
      },
      error: function(errorThrown){
        if(errorThrown.responseText == 'it_exits') {
          $block.find('.message').slideDown();
        }
        $el.parent().removeClass('loading');
      }
    });
  });
  jQuery(document).on('click', '.yprm-icon-font-grid .title a', function(e) {
    e.preventDefault();
    var $block = jQuery(this).parents('.yprm-icon-font-grid'),
    $input = jQuery(this).parents('.yprm-icon-font').find('input[type="hidden"]'),
    this_val = jQuery(this).attr('data-json'),
    json = jQuery(this).attr('data-json').replace(/\\\/|\/\\/g, "/").replace('http:', '').replace('https:', '');

    $block.find('.message').slideUp();

    jQuery.ajax({
      url: yprm_ajax.url,
      type: "POST",
      data: {
        action: 'delete_icon_font',
        array: $input.attr('value'),
        value: this_val
      },
      success: function (data) {
        $input.attr('value', data);

        $block.slideUp(function() {
          jQuery(this).remove();
        });
        
        jQuery('#redux_save_sticky').trigger('click');
      },
    });
  });
});
