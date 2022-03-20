/* global confirm, redux, redux_change */

jQuery(document).ready(function () {
  jQuery('.yprm-typography-block').each(function() {
    var $block = jQuery(this),
    $subsets = $block.find('select.yprm-font-subsets'),
    $variants = $block.find('select.yprm-font-weight');

    $block.find('select').select2({
      minimumResultsForSearch: -1
    });

    function yprm_build_font_family(el) {
      if(!jQuery('option:selected', el).attr('data-json')) {
        return false;
      }
      var array = JSON.parse(jQuery('option:selected', el).attr('data-json')),
      subsets = array.subsets ? array.subsets.split(', ') : [],
      variants = array.variants ? array.variants.split(', ') : [];
      $subsets.find('option').remove();
      $variants.find('option').remove();

      if (subsets.length > 0) {
        subsets.forEach(element => {
          $subsets.append('<option value="' + element + '"'+($subsets.attr('data-value') == element ? ' selected' : '')+'>' + element + '</option>');
        });

        $subsets.trigger('change');
      }

      if(variants.length > 0) {
        variants.forEach(element => {
          $variants.append('<option value="' + element + '"'+($variants.attr('data-value') == element ? ' selected' : '')+'>' + element + '</option>');
        });

        $variants.trigger('change');
      }
    }

    $block.find('select.yprm-font-family').on('change', function () {
      yprm_build_font_family(jQuery(this));
    });

    $block.find('.yprm-num-units-block').each(function() {
      var $this = jQuery(this),
      $num = $this.find('.input');

      if($this.find('.num-unit.current').length == 0) {
        $this.find('.num-unit:eq(0)').addClass('current');
      }

      $this.on('click', '.num-unit:not(.current)', function() {
        jQuery(this).addClass('current').siblings().removeClass('current');
        
        $this.find('input[type="hidden"]').attr('value', $num.val()+jQuery(this).attr('data-unit'));
        $num.trigger('change');
      }).on('change keyup', '.input', function() {
        $this.find('input[type="hidden"]').attr('value', jQuery(this).val()+$this.find('.num-unit.current').attr('data-unit'));
      });
    });
  }).on('change keyup', function() {
    var $this = jQuery(this),
    $preview = $this.find('.yprm-font-preview');

    var font_family = $this.find('select.yprm-font-family').val(),
    font_weight = $this.find('select.yprm-font-weight').val(),
    text_transform = $this.find('select.yprm-text-transform').val(),
    font_size = $this.find('input[name*="font-size"]').val(),
    letter_spacing = $this.find('input[name*="letter-spacing"]').val(),
    line_height = $this.find('input[name*="line-height"]').val(),
    font_style = '';

    if(font_weight == 'regular') {
      font_weight = '400';
    }

    if(font_weight) {
      if(font_weight.search("italic") >= 0) {
        font_style = 'italic';
      }

      font_weight.replace('italic', '');
    }

    $preview.slideDown().css({
      'font-family': font_family,
      'font-weight': font_weight,
      'text-transform': text_transform,
      'font-size': font_size,
      'letter-spacing': letter_spacing,
      'line-height': line_height,
      'font-style': font_style
    });
  });
});