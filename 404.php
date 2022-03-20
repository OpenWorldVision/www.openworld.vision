<?php get_header();

$bg = '';

if(function_exists('yprm_get_image')) {
  $bg = yprm_get_image(yprm_get_theme_setting('404_bg')['media']['id'], 'bg');
}

?>
<section class="banner-area banner-404 bsl-left">
  <div class="banner-item">
    <div class="bg-overlay">
      <div class="image" style="<?php echo esc_attr($bg) ?>">
      </div>
    </div>
    <div class="container">
      <div class="row align-items-center full-height">
        <div class="col-12">
        <?php if(!empty(yprm_get_theme_setting('404_heading')) || !empty(yprm_get_theme_setting('404_sub_heading'))) { ?>
            <div class="heading-block with-decor-block">
              <?php if($sub_heading = yprm_get_theme_setting('404_sub_heading')) { ?>
                <div class="sub-h"><?php echo wp_kses($sub_heading, 'post') ?></div>
              <?php } if($heading = yprm_get_theme_setting('404_heading')) { ?>
                <div class="h h1"><?php echo wp_kses($heading, 'post') ?></div>
              <?php } ?>
            </div>
          <?php } if($text = yprm_get_theme_setting('404_text')) { ?>
          <div class="text"><?php echo wp_kses($text, 'post') ?></div>
          <?php } ?>
          <a class="button-style1" href="<?php echo esc_url(home_url('/')) ?>" target="_self" data-magic-cursor="link"><span><?php echo esc_html__('Get Back Home', 'plaxer') ?></span></a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer('empty');
