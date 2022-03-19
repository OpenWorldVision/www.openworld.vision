<?php

$site_scheme_hex = '#000';

if(yprm_get_theme_setting('site_scheme') == 'light') {
  $site_scheme_hex = '#fff';
}

if($bg_color = yprm_get_theme_setting('bg_color')) {
  do_action('plaxer_inline_css', "#page {background-color: $bg_color !important;}");
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="//gmpg.org/xfn/11">
  <meta name="theme-color" content="<?php echo esc_attr($site_scheme_hex) ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page">
    <?php if(yprm_get_theme_setting('preloader_show') == 'true' && yprm_get_theme_setting('preloader_type') == 'custom_image' && is_array(yprm_get_theme_setting('preloader_img')) && !empty(yprm_get_theme_setting('preloader_img')['background-image'])) { ?>
      <div class="preloader">
        <div class="preloader_img"><img src="<?php echo esc_url(yprm_get_theme_setting('preloader_img')['background-image']) ?>" alt="<?php echo get_bloginfo( 'name' ) ?>"></div>
      </div>
    <?php } if(yprm_get_theme_setting('preloader_show') == 'true' && yprm_get_theme_setting('preloader_type') == 'cube') {?>
      <div class="preloader-area">
        <div class="preloader-folding-cube">
          <div class="preloader-cube1 preloader-cube"></div>
          <div class="preloader-cube2 preloader-cube"></div>
          <div class="preloader-cube4 preloader-cube"></div>
          <div class="preloader-cube3 preloader-cube"></div>
        </div>
      </div>
    <?php } if(yprm_get_theme_setting('header_style') == 'logo-left' || yprm_get_theme_setting('header_style') == 'logo-center' || yprm_get_theme_setting('header_style') == 'side' || yprm_get_theme_setting('header_style') == 'logo-right') { ?>
      <header class="site-header <?php echo esc_attr(yprm_get_theme_setting('header_color_mode')); ?>-color">
        <div class="<?php echo esc_attr(yprm_get_theme_setting('header_container')) ?>">
          <div class="row align-items-center justify-content-between">
            <div class="logo-block col-auto">
              <div class="site-logo">
                <?php echo yprm_site_logo(); ?>
              </div>
            </div>
            <div class="right col-auto">
              <?php if(has_nav_menu('navigation') && (yprm_get_theme_setting('navigation_type') != 'disabled' && yprm_get_theme_setting('navigation_type') != 'fullscreen')) { ?>
                <nav class="navigation <?php echo esc_attr(yprm_get_theme_setting('navigation_type')) ?>">
                  <?php wp_nav_menu(array('theme_location' => 'navigation', 'container' => 'ul', 'menu_class' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
                </nav>
              <?php } if(yprm_get_theme_setting('header_search') == 'true') { ?>
                <div class="header-search-button"><i class="base-icon-magnifying-glass"></i></div>
              <?php } if(class_exists( 'WooCommerce' ) && yprm_get_theme_setting('header_cart') == 'true') { ?>
                <?php echo yprm_wc_minicart() ?>
              <?php } if(has_nav_menu('navigation') && yprm_get_theme_setting('navigation_type') != 'disabled') { ?>
                <div class="nav-butter <?php echo esc_attr(yprm_get_theme_setting('navigation_type')) ?>" data-magic-cursor="link-small"><span></span><span></span><span></span></div>
              <?php } ?>
            </div>
            <?php if(
              is_active_sidebar('sidebar') && 
              (
                yprm_get_theme_setting('sidebar_button') != 'disabled' && 
                yprm_get_theme_setting('sidebar_button') != 'side'
              ) && 
              yprm_get_theme_setting('header_sidebar') == 'true' && 
              (
                yprm_get_theme_setting('navigation_type') == 'disabled' || 
                yprm_get_theme_setting('navigation_type') == 'visible_menu'
              )
              ) { ?>
              <div class="sidebar-butter" data-magic-cursor="link-small"><span></span><span></span><span></span></div>
            <?php }  ?>
          </div>
        </div>
      </header>
    <?php } if(yprm_get_theme_setting('header_style') == 'side') { ?>
      <header class="side-header">
        <div class="logo-block">
          <div class="site-logo" data-magic-cursor="link"><?php echo yprm_site_logo(); ?></div>
        </div>
        <?php if(has_nav_menu('side-navigation')) { ?>
          <nav class="side-navigation visible_menu">
          <?php wp_nav_menu(array('theme_location' => 'side-navigation', 'container' => 'ul', 'menu_class' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
          </nav>
        <?php } if(function_exists('yprm_share_block')) {
          echo yprm_share_block('type2');
        } ?>
      </header>
    <?php } else if(yprm_get_theme_setting('header_search') == 'true') { ?>
      <div class="search-popup">
        <div class="close base-icon-cross"></div>
        <div class="form-block"><?php get_search_form(); ?></div>
      </div>
    <?php } if(has_nav_menu('side-navigation') && yprm_get_theme_setting('navigation_type') == 'fullscreen') { ?>
      <div class="fullscreen-navigation-area">
        <div class="wrap">
          <nav class="fullscreen-navigation"><?php wp_nav_menu(array('theme_location' => 'side-navigation', 'container' => 'ul', 'menu_class' => 'menu', 'link_before' => '<span>', 'link_after' => '</span>')); ?></nav>
        </div>
      </div>
    <?php } if(is_active_sidebar('sidebar')) { ?>
      <div class="sidebar-content-block">
        <div class="close base-icon-cross"></div>
        <div class="wrap scrollbar-inner"><?php dynamic_sidebar('sidebar'); ?></div>
      </div>
    <?php } if(is_active_sidebar('sidebar') && yprm_get_theme_setting('sidebar_button') == 'side') { ?>
      <div class="sidebar-block">
        <div class="sidebar-butter"><span></span><span></span><span></span></div>
        <?php if(function_exists('yprm_share_block')) {
          echo yprm_share_block();
        } ?>
      </div>
    <?php } if($subscribe_shortcode = yprm_get_theme_setting('subscribe_shortcode')) { ?>
      <div class="subscribe-popup">
        <div class="close base-icon-cross"></div>
        <div class="wrap"><?php echo do_shortcode($subscribe_shortcode); ?></div>
      </div>
    <?php } ?>
    
    <div class="header-space"></div>