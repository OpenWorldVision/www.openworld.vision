(function (jQuery) {
  "use strict";

  jQuery.fn.yprm_fullscreen_navigation = function () {
    return this.each(function () {
      var $this_area = jQuery(this),
        $bgs = $this_area.find('.bg-items'),
        $links = $this_area.find('.items'),
        linkLocation = '';

      $this_area.addClass($links.find('.current a').attr('data-color'));

      jQuery(window).on('load', function () {
        $this_area.addClass('loaded');
      });

      jQuery(window).on('load resize', function () {
        $this_area.css({
          height: jQuery(window).outerHeight() - jQuery('.header-space:visible').outerHeight() - jQuery('#wpadminbar').outerHeight()
        });
      });

      $links.on('mouseenter', 'a', function () {
        if ($this_area.hasClass('loading')) return false;

        var eq = jQuery(this).parent().index(),
          color = jQuery(this).data('color');

        jQuery(this).parent().addClass('current').siblings().removeClass('current');
        $bgs.find('.item').eq(eq).fadeIn().addClass('current').siblings().fadeOut().removeClass('current');
        $this_area.css('background', jQuery(this).parent().attr('data-color'));

        $this_area.removeClass('white black').addClass(color);
      });
    });
  };
})(jQuery);

