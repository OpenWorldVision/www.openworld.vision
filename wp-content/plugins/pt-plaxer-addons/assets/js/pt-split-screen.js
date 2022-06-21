jQuery.fn.yprm_split_screen = function () {
  return this.each(function () {
    jQuery('body').addClass('body-one-screen');

    var $this_el = jQuery(this),
      $el = $this_el.find('.screen-item'),
      $nav = $this_el.find('.navigation-block'),
      $pagination = $nav.find('.swiper-dots'),
      delay = 1000,
      status = false;

    $el.each(function (index) {
      index++;
      $pagination.append('<div class="swiper-pagination-bullet" data-magic-cursor="link-small"></div>');
    });

    jQuery(window).on('load resize', function () {
      var height = jQuery(window).outerHeight() - jQuery('.header-space:visible').height() - jQuery('#wpadminbar').outerHeight();
      $this_el.css('height', height);
      $this_el.find('.items .item').css('height', height);
    });

    function vertical_parallax(coef, index) {
      index = index === undefined ? false : index;
      if (coef != false) {
        var index = $this_el.find('.screen-item.current').index() - coef;
      }
      $el.eq(index).removeClass('prev next').addClass('current').siblings().removeClass('current');
      $el.eq(index).prevAll().removeClass('next').addClass('prev');
      $el.eq(index).nextAll().removeClass('prev').addClass('next');

      $pagination.find('div:eq('+index+')').addClass('swiper-pagination-bullet-active').siblings().removeClass('swiper-pagination-bullet-active');

      if(index == 0) {
        $nav.find('.prev').addClass('disabled');
      } else {
        $nav.find('.prev').removeClass('disabled');
      }
      
      if(index == ($el.length - 1)) {
        $this_el.find('.scroll-down-arrow').addClass('reverse');
      } else {
        $this_el.find('.scroll-down-arrow').removeClass('reverse');
      }
    }

    vertical_parallax(false, 0);

    $this_el.on('mousewheel wheel', function (e) {
      if (jQuery(window).width() > 768) {
        e.preventDefault();
        var cur = $this_el.find('.screen-item.current').index();
        if (status != true) {
          status = true;
          if (e.originalEvent.deltaY > 0 && cur != parseInt($el.length - 1)) {
            vertical_parallax('-1');
            setTimeout(function () {
              status = false
            }, delay);
          } else if (e.originalEvent.deltaY < 0 && cur != 0) {
            vertical_parallax('1');
            setTimeout(function () {
              status = false
            }, delay);
          } else {
            status = false;
          }
        }
      }
    });

    $pagination.on('click', 'div:not(.swiper-pagination-bullet-active)', function () {
      vertical_parallax(false, jQuery(this).index());
    });

    $this_el.find('.scroll-down-arrow').on('click', function() {
      if(jQuery(this).hasClass('reverse')) {
        vertical_parallax(false, 0);
      } else {
        vertical_parallax('-1');
      }
    });
  });
};