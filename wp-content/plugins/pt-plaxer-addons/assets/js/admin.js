var uniqid = function (pr, en) {
  var pr = pr || '',
    en = en || false,
    result, us;

  this.seed = function (s, w) {
    s = parseInt(s, 10).toString(16);
    return w < s.length ? s.slice(s.length - w) :
      (w > s.length) ? new Array(1 + (w - s.length)).join('0') + s : s;
  };

  result = pr + this.seed(parseInt(new Date().getTime() / 1000, 10), 8) +
    this.seed(Math.floor(Math.random() * 0x75bcd15) + 1, 5);

  if (en) result += (Math.random() * 10).toFixed(8).toString();

  return result;
};

jQuery(document).ready(function (jQuery) {
  var metaImageFrame;
  jQuery('body').on('click', '[data-media-uploader-target]', function (e) {
    var btn = e.target;

    var field = jQuery(btn).next();
    e.preventDefault();

    if (metaImageFrame) {
      metaImageFrame.open();
    } else {
      metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
        button: {
          text: 'Use this file'
        },
        library: {
          type: 'video'
        },
      });
    }

    metaImageFrame.on('select', function () {
      var media_attachment = metaImageFrame.state().get('selection').first().toJSON();
      jQuery(field).val(media_attachment.url);
    });

    metaImageFrame.open();
  });

  jQuery(document).on('click', '.vc_control-btn-edit, .vc_shortcode-link, .column_edit', function () {
    var t = setInterval(function () {
      var el = jQuery('.vc_ui-panel.vc_ui-panel-window input[name="uniqid"]');

      if (el.length > 0) {
        if (!el.val()) {
          el.val(uniqid());
        }
        clearInterval(t);
      }
    }, 400);
  }).on('change', '.vc_param_cols .input-col input', function() {
    var $el = jQuery(this).parents('.vc_param_cols'),
        result = '';
        $result_input = $el.next('input[type="hidden"]');

    $el.find('.input-col').each(function(index) {
      var size = jQuery(this).attr('data-type'),
          value = jQuery(this).find('input').val();

      if(!value) return;

      if(value >= 4 && !$el.hasClass('owl')) {
        value = jQuery(this).find('input').attr('max');
        jQuery(this).find('input').attr('value', value);
      }

      result += size+':'+value;
      if(index<$el.find('.input-col').length) {
        result += ',';
      }
    });
    console.log('d'+result);
    $result_input.attr('value', result);
  });

  jQuery(document).on("click", ".upload_image_button", function (e) {
    e.preventDefault();
    var $button = jQuery(this);

    var file_frame = wp.media.frames.file_frame = wp.media({
      title: 'Select or upload image',
      library: {
        type: 'image'
      },
      button: {
        text: 'Select'
      },
      multiple: false
    });


    file_frame.on('select', function () {

      var attachment = file_frame.state().get('selection').first().toJSON();

      $button.siblings('input').val(attachment.url);

    });

    file_frame.open();
  });
});