jQuery(document).ready(function() {
  function recalc($item) {
    var $items = $item.parents('.vc_param_font_size').find('.input-col'),
    $input = $item.parents('.font-size-block').find('.wpb_vc_param_value'),
    output = '{';

    $items.each(function() {
      var $el = jQuery(this);
      if($el.find('input').val()) {
        output += '"'+$el.attr('data-type')+'": {"value": "'+$el.find('input').val()+'", "size": "'+$el.attr('data-size')+'"},';
      }
    });

    output = output.slice(0, -1)
    if(output) {
      output += '}';
    }

    $input.attr('value', output);
  }

  jQuery(document).find('.vc_param_font_size').each(function() {
    var $el = jQuery(this),
    value = $el.parents('.font-size-block').find('.wpb_vc_param_value').attr('value');
    
    if(value) {
      var array = jQuery.parseJSON(value);
      for(el in array) {
        var $item = $el.find('[data-type="'+el+'"]'),
        item_array = array[el];

        $item.find('input').attr('value', item_array['value']).next().find('span').removeClass('current');

        if(item_array['size'] == 'px') {
          $item.find('.switch span:nth-child(1)').addClass('current')
        } else {
          $item.find('.switch span:nth-child(2)').addClass('current')
        }
      };
    }
  }).on('click', '.switch span:not(.current)', function() {
    jQuery(this).addClass('current').siblings().removeClass('current').parents('.input-col').attr('data-size', ((jQuery(this).index() == 0) ? 'px' : 'em'));

    recalc(jQuery(this));
  }).on('change', '.input-col input', function() {
    recalc(jQuery(this));
  });
});