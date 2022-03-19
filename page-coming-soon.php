<?php

/*
Template Name: Coming Soon Page
*/

get_header(); 

$bg = '';

if(function_exists('yprm_get_image')) {
  $bg = yprm_get_image(yprm_get_theme_setting('coming_soon_bg')['media']['id'], 'bg');
}

$id = uniqid('countdown-');

if(get_field('date')) {
  $date_array = explode('/', get_field('date'));
	$year = $date_array[0];
	$month = $date_array[1]-1;
	$day = $date_array[2];

	$js = "var ts = new Date($year, $month, $day);

  if(jQuery('.$id').length > 0){
    jQuery('.$id').countdown({
      timestamp	: ts,
      callback	: function(days, hours, minutes, seconds){
      }
    });
  }";

  wp_enqueue_script( 'countdown', get_parent_theme_file_uri() . '/js/jquery.countdown.js', array('jquery'), '1.0', true );
  do_action('plaxer_inline_js', $js);
}
?>
<section class="banner-area coming-soon-banner bsl-left">
  <div class="banner-item">
    <div class="bg-overlay">
      <div class="image" style="<?php echo esc_attr($bg) ?>">
      </div>
    </div>
    <div class="container">
      <div class="row align-items-center full-height">
        <div class="col-12">
          <?php if(!empty(yprm_get_theme_setting('coming_soon_heading')) || !empty(yprm_get_theme_setting('coming_soon_sub_heading'))) { ?>
            <div class="heading-block with-decor-block">
              <?php if($sub_heading = yprm_get_theme_setting('coming_soon_sub_heading')) { ?>
                <div class="sub-h"><?php echo wp_kses($sub_heading, 'post') ?></div>
              <?php } if($heading = yprm_get_theme_setting('coming_soon_heading')) { ?>
                <div class="h h1"><?php echo wp_kses($heading, 'post') ?></div>
              <?php } ?>
            </div>
          <?php } ?>
          <div class="timer-block <?php echo esc_attr($id) ?>"></div>
          <?php if(!empty(yprm_get_theme_setting('coming_soon_subscribe_code'))) { 
            echo do_shortcode(yprm_get_theme_setting('coming_soon_subscribe_code'));
          } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer('empty');