jQuery(document).ready(function () {

  jQuery('.yprm-css-editor').each(function () {
    var $this = jQuery(this),
      $input = $this.find('.wpb_vc_param_value');

    $this.on('click', '.tab-item:not(.current)', function () {
      jQuery(this).addClass('current').siblings().removeClass('current').parents('.yprm-css-editor').find('.yprm-content').eq(jQuery(this).index()).addClass('current').siblings().removeClass('current');
    });

    $this.find('.border-color-picker').each(function() {
      jQuery(this).wpColorPicker({
        width: 250,
      });
    });

    function build_array(action) {
      var array = '',
        result = '';
      
      if(action == 'init') {
        var f_array = jQuery.parseJSON($input.attr('value'));
      }
  
      $this.find('[data-screen]').each(function () {
        var screen = jQuery(this).attr('data-screen'),
          array_item = '';

        jQuery(this).find('input, select').each(function () {
          var $input = jQuery(this),
            value = $input.attr('value'),
            name = $input.attr('name');

          if(typeof name === undefined) {
            return;
          }
          
          if(action == 'init' && f_array && screen in f_array && name in f_array[screen]) {
            $input.attr('value', f_array[screen][name]);
          
            if($input.hasClass('wp-color-picker')) {
              $input.trigger('change');
              console.log(f_array[screen][name]);
            }
          } else if (value) {
            array_item += '"' + name + '": "' + value + '",';
          }
        });

        if (array_item) {
          array += '"' + screen + '": {' + array_item.slice(0, -1) + '},';
        }
      });

      result = array.slice(0, -1);

      if (action == 'reload') {
        $input.attr('value', '{' + result + '}');
      }
    }

    build_array('init');

    $this.on('change', 'input, select', function () {
      jQuery(this).attr('value', jQuery(this).val());
      build_array('reload');
    });
  });
});