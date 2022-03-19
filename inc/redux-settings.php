<?php

if (!class_exists('Redux')) {
  return;
}

$opt_name = "plaxer_theme";
$opt_name = apply_filters('plaxer_theme/opt_name', $opt_name);

$theme = wp_get_theme();

$args = array(
  'opt_name' => $opt_name,
  'display_name' => $theme->get('Name'),
  'display_version' => $theme->get('Version'),
  'menu_type' => 'submenu',
  'allow_sub_menu' => true,
  'menu_title' => esc_html__('Theme Options', 'plaxer'),
  'page_title' => esc_html__('Theme Options', 'plaxer'),
  'google_api_key' => '',
  'google_update_weekly' => true,
  'async_typography' => true,
  'admin_bar' => false,
  'admin_bar_icon' => 'dashicons-portfolio',
  'admin_bar_priority' => 50,
  'global_variable' => '',
  'dev_mode' => false,
  'update_notice' => true,
  'customizer' => true,
  'page_priority' => null,
  'page_parent' => 'plaxer_dashboard',
  'page_permissions' => 'manage_options',
  'menu_icon' => '',
  'last_tab' => '',
  'page_icon' => 'icon-themes',
  'page_slug' => '',
  'save_defaults' => true,
  'default_show' => false,
  'default_mark' => '',
  'show_import_export' => true,
  'transient_time' => 60 * MINUTE_IN_SECONDS,
  'output' => true,
  'output_tag' => true,
  'database' => '',
  'use_cdn' => true,
  'show_options_object' => false,
);

Redux::setArgs($opt_name, $args);

if (!function_exists('yprm_redux_social_icons')) {
  function yprm_redux_social_icons() {
    return array(
      '' => esc_html__('None', 'plaxer'),
      '500px' => esc_html__('500px', 'plaxer'),
      'amazon' => esc_html__('Amazon', 'plaxer'),
      'app-store' => esc_html__('App Store', 'plaxer'),
      'behance' => esc_html__('Behance', 'plaxer'),
      'blogger' => esc_html__('Blogger', 'plaxer'),
      'codepen' => esc_html__('Codepen', 'plaxer'),
      'digg' => esc_html__('Digg', 'plaxer'),
      'dribbble' => esc_html__('Dribbble', 'plaxer'),
      'dropbox' => esc_html__('Dropbox', 'plaxer'),
      'ebay' => esc_html__('Ebay', 'plaxer'),
      'facebook' => esc_html__('Facebook', 'plaxer'),
      'flickr' => esc_html__('Flickr', 'plaxer'),
      'foursquare' => esc_html__('Foursquare', 'plaxer'),
      'github' => esc_html__('GitHub', 'plaxer'),
      'google-plus' => esc_html__('Google Plus', 'plaxer'),
      'instagram' => esc_html__('Instagram', 'plaxer'),
      'itunes' => esc_html__('Itunes', 'plaxer'),
      'kickstarter' => esc_html__('Kickstarter', 'plaxer'),
      'linkedin' => esc_html__('LinkedIn', 'plaxer'),
      'mailchimp' => esc_html__('Mailchimp', 'plaxer'),
      'mixcloud' => esc_html__('MixCloud', 'plaxer'),
      'windows' => esc_html__('Windows', 'plaxer'),
      'odnoklassniki' => esc_html__('Odnoklassniki', 'plaxer'),
      'paypal' => esc_html__('PayPal', 'plaxer'),
      'periscope' => esc_html__('Periscope', 'plaxer'),
      'openid' => esc_html__('OpenID', 'plaxer'),
      'pinterest' => esc_html__('Pinterest', 'plaxer'),
      'reddit' => esc_html__('Reddit', 'plaxer'),
      'skype' => esc_html__('Skype', 'plaxer'),
      'snapchat' => esc_html__('Snapchat', 'plaxer'),
      'soundcloud' => esc_html__('SoundCloud', 'plaxer'),
      'spotify' => esc_html__('Spotify', 'plaxer'),
      'stack-overflow' => esc_html__('Stack Overflow', 'plaxer'),
      'steam' => esc_html__('Steam', 'plaxer'),
      'stripe' => esc_html__('Stripe', 'plaxer'),
      'telegram' => esc_html__('Telegram', 'plaxer'),
      'tumblr' => esc_html__('Tumblr', 'plaxer'),
      'twitter' => esc_html__('Twitter', 'plaxer'),
      'twitch' => esc_html__('Twitch', 'plaxer'),
      'viber' => esc_html__('Viber', 'plaxer'),
      'vimeo' => esc_html__('Vimeo', 'plaxer'),
      'vk' => esc_html__('VK', 'plaxer'),
      'whatsapp' => esc_html__('Whatsapp', 'plaxer'),
      'yahoo' => esc_html__('Yahoo', 'plaxer'),
      'yelp' => esc_html__('Yelp', 'plaxer'),
      'yoast' => esc_html__('Yoast', 'plaxer'),
      'youtube' => esc_html__('YouTube', 'plaxer'),
    );
  }
}

Redux::setSection($opt_name, array(
  'title' => esc_html__('General', 'plaxer'),
  'id' => 'general',
  'customizer_width' => '400px',
  'icon' => 'fa fa-home',
  'fields' => array(
    array(
      'id' => 'accent_color',
      'type' => 'color',
      'title' => esc_html__('Accent Color', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array(
        'background-color' => '',

        'background' => '.slider-nav .pag.style1 .swiper-slide.swiper-slide-active span:nth-child(1), .slider-nav .pag.style2 .swiper-slide.swiper-slide-active span:nth-child(1), .banner-area .bottom-content .banner-pagination .swiper-pagination-bullet:after, .skills-rate .rate-line div, .contact-block .title:before, .tabs-block .tb-m-button:after,
        .tabs-block .tb-buttons .button:after,.preloader-folding-cube .preloader-cube:before, .wpb_text_column ul li:before, .button-style1, .button-style2:before, .input-row:before,
        .woocommerce-form-row:before, .header-minicart .hm-count span, .social-links-with-label a:not(:first-child):before, .navigation li:not(.mega-menu-col) > .sub-menu li > a:before,
        .navigation li:not(.mega-menu-col) > .children li > a:before, .heading-block.with-line:after, .heading-block.style2 .sub-h:after, body.dark-scheme .tagcloud .tag-cloud-link:hover,
        body .dark-scheme .tagcloud .tag-cloud-link:hover, .coming-soon-banner .bg-overlay .color,
        .banner-404 .bg-overlay .color,.product-button,
        .single_add_to_cart_button, .add_to_cart_button:hover, .product-image-block .nav-arrows .prev:hover .convex,
        .product-image-block .nav-arrows .next:hover .convex,
        .product-thumb-slider .nav-arrows .prev:hover .convex,
        .product-thumb-slider .nav-arrows .next:hover .convex, .woocommerce div.product form.cart .button-style1, .woocommerce a.button,
        .woocommerce button.button,
        .woocommerce input.button,
        .woocommerce #respond input#submit, .woocommerce-accordion .wc-accordion-item .top .button:before, .woocommerce-accordion .wc-accordion-item .top .button:after, .woocommerce table.cart td.actions .coupon button:hover,
        .woocommerce #content table.cart td.actions .coupon button:hover, .woocommerce-page table.cart td.actions .coupon button:hover,
        .woocommerce-page #content table.cart td.actions .coupon button:hover, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order',

        'border-color' => '.sidebar-style2 .widget-title, .text-t4,
        .banner-area .banner-item .col-auto > .text',

        'color' => '.tournament .title a:hover, .stream-link:hover, .match-item.minified .links a:hover, .page-top-block .game-team .sep .links a:hover, .nav-arrows .prev:hover,
        .nav-arrows .next:hover, .slider-nav .prev:hover,
        .slider-nav .next:hover, .slider-nav .pag.style1 .swiper-slide.swiper-slide-active:before, .slider-nav .pag.style1 .swiper-slide.swiper-slide-active span:nth-child(1):before, .slider-nav .pag.style2 .swiper-slide.swiper-slide-active:before, .slider-nav .pag.style2 .swiper-slide.swiper-slide-active span:nth-child(1):before, .banner-area .bottom-content .banner-pagination.style2 .swiper-pagination-bullet:after, .banner-area .bottom-content .banner-pagination.style2 .swiper-pagination-bullet.swiper-pagination-bullet-active:after, .banner-area .bottom-content .banner-pagination.style3 .swiper-pagination-bullet.swiper-pagination-bullet-active, .banner-area .banner-s-buttons .button .close-label, .banner-area .banner-s-buttons .button:not(.active):hover .label, .nav-buttons > *:hover, .portfolio-item .plus-permalink:hover i, .portfolio-type-carousel2 .swiper-slide .category, .brand-block > .prev:hover,
        .brand-block > .next:hover, .subscribe-form button:hover, .tabs-block .tb-m-button:not(.current):hover,
        .tabs-block .tb-buttons .button:not(.current):hover, .tabs-block .tb-m-button span,
        .tabs-block .tb-buttons .button span, .tournament .b-col .value, .games-block .prev:hover,
        .games-block .next:hover, .games-block .games-item:hover .title, .testimonials-slider .prev:hover,
        .testimonials-slider .next:hover, .categories-carousel .prev:hover,
        .categories-carousel .next:hover,
        .products-carousel .prev:hover,
        .products-carousel .next:hover, .page-top-block .game-team .item .points,.preloader-words .word span, .site-logo a:hover, .fullscreen-navigation ul li a:hover, .blog-item .title:hover, .blog-item .title a:hover, .widget_recent_entries a:hover, .widget_recent_comments ul li a:hover, .breadcrumbs a:hover, .project-slider .prev:hover,
        .project-slider .next:hover, .text-t2 a:hover, .text-t3 a:hover, blockquote:before, .button-style1.accent, .readmore-link:hover, .link-button.accent, .link-button:hover, .play-button.with-label i, .header-search-button:hover, .header-minicart .hm-count:hover i, .social-links .subscribe-label:hover,
        .social-links-with-label .subscribe-label:hover, .social-links a:hover,
        .social-links-with-label a:hover, .social-links-label a:hover, .navigation-hover-style1 .navigation .menu > li > a span:before, .navigation-hover-style2 .navigation .menu > li > a span:before, .navigation-hover-style3 .navigation .menu > li > a span:before, .navigation-hover-style4 .navigation .menu > li > a span:before, .navigation li:not(.mega-menu-col) > .sub-menu li.menu-item-has-children:before,
        .navigation li:not(.mega-menu-col) > .children li.menu-item-has-children:before, .navigation .mega-menu .mega-menu-row li.current-menu-item > a, .navigation .mega-menu .mega-menu-row li.current-menu-ancestor > a, .navigation .mega-menu .mega-menu-row li.current_page_item > a, .navigation .mega-menu .mega-menu-row li.current_page_parent > a, .navigation .mega-menu .mega-menu-row li:hover > a, .fullscreen-navigation ul li.current-menu-item > a, .fullscreen-navigation ul li.current-menu-ancestor > a, .fullscreen-navigation ul li.current_page_item > a, .fullscreen-navigation ul li.current_page_parent > a, .fullscreen-navigation ul li:hover > a, .fullscreen-navigation li.back:hover, .side-navigation .menu > li > a span:before, .search-popup .close:hover, .subscribe-popup .close:hover, .sidebar-content-block .close:hover, .site-footer-minified a:hover,
        .site-footer .footer-bottom a:hover, .heading-block .sub-h span, .heading-block .h.accent-color, .heading-block .h span, .post-bottom .categories a:hover, .scroll-to-top-button:hover, .comments-area .comment-items .comment-item .top .time, .searchform button:hover,
        .protected-post-form .form button:hover, .widget_archive ul li a:hover,
        .widget_categories ul li a:hover,
        .widget_pages ul li a:hover,
        .widget_meta ul li a:hover,
        .widget_nav_menu ul li a:hover,
        .product-categories ul li a:hover, .post-banner .categories,.woocommerce div.product .categories a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce ul.packery-products li.product .content .h a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product form.cart .woocommerce-variation-price .price > span,
        .woocommerce div.product form.cart .woocommerce-variation-price ins, .woocommerce div.product form.cart .reset_variations, .woocommerce div.product form.cart .group_table td.woocommerce-grouped-product-list-item__price .price .price > span,
        .woocommerce div.product form.cart .group_table td.woocommerce-grouped-product-list-item__price .price ins, .woocommerce .star-rating span::before, .woocommerce .woocommerce-order-details .shop_table .order-total .amount, .woocommerce .woocommerce-order-details .shop_table tfoot .woocommerce-Price-amount, .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a',

        'stroke' => '',
      ),
    ),
    array(
      'id' => 'accent_color2',
      'type' => 'color',
      'title' => esc_html__('Accent Color 2', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array(
        'background-color' => '',

        'background' => '.banner-area .bottom-content .banner-pagination.style1 .swiper-pagination-bullet.swiper-pagination-bullet-active:after, .banner-area .bottom-content .banner-pagination.style2 .swiper-pagination-bullet.swiper-pagination-bullet-active:after, .app-button:hover',

        'border-color' => '',

        'color' => '.banner-area .bottom-content .banner-pagination.style3 .swiper-pagination-bullet.swiper-pagination-bullet-active:after, .contact-block .title, .page-top-block .game-team .points,
        .match-widget .game-team .points,
        .match-item .game-team .points',

        'stroke' => '',
      ),
    ),
    array(
      'id' => 'right_click_disable',
      'type' => 'button_set',
      'title' => esc_html__('Right Click Disable', 'plaxer'),
      'options' => array(
        'true' => esc_html__('On', 'plaxer'),
        'false' => esc_html__('Off', 'plaxer'),
      ),
      'default' => 'false',
    ),
    array(
      'id' => 'right_click_disable_message',
      'type' => 'editor',
      'title' => esc_html__('Right Click Message', 'plaxer'),
      'default' => wp_kses(__('<p style="text-align: center"><strong><span style="font-size: 18px">Content is protected. Right-click function is disabled.</span></strong></p>', 'plaxer'), 'post'),
      'args' => array(
        'teeny' => false,
        'textarea_rows' => 5,
      ),
      'required' => array('right_click_disable', '=', 'true'),
    ),
    array(
      'id' => 'protected_message',
      'type' => 'editor',
      'title' => esc_html__('Protected Page Message', 'plaxer'),
      'default' => esc_html__('This Content Is Password Protected To View It Please Enter Your Password Below', 'plaxer'),
      'args' => array(
        'teeny' => false,
        'textarea_rows' => 5,
      ),
    ),
    array(
      'id' => 'mobile_adaptation',
      'type' => 'button_set',
      'title' => esc_html__('Mobile Adaptation', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Original', 'plaxer'),
        'false' => esc_html__('Cropped', 'plaxer'),
      ),
      'default' => 'false',
    ),
    array(
      'id' => 'cat_prefix',
      'type' => 'button_set',
      'title' => esc_html__('Category Prefix', 'plaxer'),
      'desc' => wp_kses(__('Show/Hide Category prefix.<br><b>Example:</b><br><b>If Show -</b> Category: Lifestyle<br><b>If Hide -</b> Lifestyle', 'plaxer'), 'post'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'project_image_download',
      'type' => 'button_set',
      'title' => esc_html__('Image Download Link On Popup', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'false',
    ),
    array(
      'id' => 'custom_cursor',
      'type' => 'button_set',
      'title' => esc_html__('Custom Cursor', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'false',
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Preloader', 'plaxer'),
  'id' => 'general_preloader',
  'customizer_width' => '450px',
  'icon' => 'fas fa-sync-alt ',
  'fields' => array(
    array(
      'id' => 'preloader_show',
      'type' => 'button_set',
      'title' => esc_html__('Preloader', 'plaxer'),
      'options' => array(
        'true' => esc_html__('On', 'plaxer'),
        'false' => esc_html__('Off', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'preloader_type',
      'type' => 'select',
      'title' => esc_html__('Preloader Type', 'plaxer'),
      'options' => array(
        'cube' => esc_html__('Cube', 'plaxer'),
        'custom_image' => esc_html__('Custom Image', 'plaxer'),
      ),
      'default' => 'cube',
      'required' => array('preloader_show', '=', 'true'),
    ),
    array(
      'id' => 'preloader_words',
      'type' => 'textarea',
      'title' => esc_html__('Preloader Words', 'plaxer'),
      'required' => array('preloader_type', '=', 'words'),
    ),
    array(
      'id' => 'preloader_bg_color',
      'type' => 'color',
      'title' => esc_html__('Preloader Background Color', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('background' => 'body.dark-scheme .preloader-area, body .dark-scheme .preloader-area, body.dark-scheme .preloader-default-area, body .dark-scheme .preloader-default-area, body.dark-scheme .preloader-words-area, body .dark-scheme .preloader-words-area'),
      'required' => array('preloader_show', '=', 'true'),
    ),
    array(
      'id' => 'preloader_color',
      'type' => 'color',
      'title' => esc_html__('Preloader Color', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('background' => '.preloader-folding-cube .preloader-cube:before', 'color' => 'body.dark-scheme .preloader-words-area'),
      'required' => array('preloader_show', '=', 'true'),
    ),
    array(
      'id' => 'preloader_img',
      'type' => 'background',
      'title' => esc_html__('Prelaoder Image', 'plaxer'),
      'desc' => esc_html__('Choose A Default Logo Image To Display', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
      'required' => array('preloader_type', '=', 'custom_image'),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Logo', 'plaxer'),
  'id' => 'header_logo',
  'customizer_width' => '450px',
  'icon' => 'fas fa-address-book',
  'fields' => array(
    array(
      'id' => 'logo_text',
      'type' => 'text',
      'title' => esc_html__('Logo Text', 'plaxer'),
    ),
    array(
      'id' => 'light_logo',
      'type' => 'background',
      'title' => esc_html__('Logo Image Light', 'plaxer'),
      'desc' => esc_html__('Choose A Logo Image To Display For Light Header Skin', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
    ),
    array(
      'id' => 'dark_logo',
      'type' => 'background',
      'title' => esc_html__('Logo Image Dark', 'plaxer'),
      'desc' => esc_html__('Choose A Logo Image To Display For Dark Header Skin', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
    ),
    array(
      'id' => 'logo_size',
      'units' => 'px',
      'type' => 'dimensions',
      'units_extended' => 'false',
      'title' => esc_html__('Logo Max Width', 'plaxer'),
      'output' => array('.site-header .site-logo, .site-header .site-logo a'),
      'height' => true,
    ),
    array(
      'id' => 'mobile_logo_size',
      'units' => 'px',
      'type' => 'dimensions',
      'units_extended' => 'false',
      'title' => esc_html__('Mobile Logo Size', 'plaxer'),
      'output' => array('.is-mobile-body .site-header .site-logo, .is-mobile-body .site-header .site-logo a'),
      'height' => true,
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Header', 'plaxer'),
  'id' => 'header_style_area',
  'customizer_width' => '450px',
  'icon' => 'fas fa-heading',
  'fields' => array(
    array(
      'id' => 'header_container',
      'type' => 'select',
      'title' => esc_html__('Header Container', 'plaxer'),
      'options' => array(
        'container' => esc_html__('Center Container', 'plaxer'),
        'container-fluid' => esc_html__('Full Witdh', 'plaxer'),
      ),
      'default' => 'container',
    ),
    array(
      'id' => 'header_color_mode',
      'type' => 'select',
      'title' => esc_html__('Header Color Mode', 'plaxer'),
      'options' => array(
        'dark' => esc_html__('Dark', 'plaxer'),
        'light' => esc_html__('Light', 'plaxer'),
      ),
      'default' => 'light',
    ),
    array(
      'id' => 'header_style',
      'type' => 'image_select',
      'title' => esc_html__('Header Type', 'plaxer'),
      'options' => array(
        'logo-left' => array(
          'alt' => esc_html__('Logo Left', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/logo-left.png',
        ),
        'logo-center' => array(
          'alt' => esc_html__('Logo Center', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/logo-center.png',
        ),
        'logo-right' => array(
          'alt' => esc_html__('Logo Right', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/logo-right.png',
        ),
        'side' => array(
          'alt' => esc_html__('Side', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/side.png',
        ),
      ),
      'default' => 'logo-left',
    ),
    array(
      'id' => 'header_cart',
      'type' => 'button_set',
      'title' => esc_html__('Cart', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'header_search',
      'type' => 'button_set',
      'title' => esc_html__('Search', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'header_bg_color_light',
      'type' => 'color',
      'title' => esc_html__('Background Color For Light', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('background-color' => '.site-header.fixed.light-color'),
    ),
    array(
      'id' => 'header_bg_color_dark',
      'type' => 'color',
      'title' => esc_html__('Background Color For Dark', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('background-color' => '.site-header.fixed.dark-color'),
    ),
    array(
      'id' => 'header_text_light_color',
      'type' => 'color',
      'title' => esc_html__('Text Color For Light', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('color' => '.site-header.light-color'),
    ),
    array(
      'id' => 'header_text_dark_color',
      'type' => 'color',
      'title' => esc_html__('Text Color For Dark', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('color' => '.site-header.dark-color'),
    ),
    array(
      'id' => 'nav-options-start',
      'type' => 'section',
      'title' => esc_html__('Navigation Options', 'plaxer'),
      'indent' => true,
    ),
    array(
      'id' => 'navigation_type',
      'type' => 'image_select',
      'title' => esc_html__('Navigation Type', 'plaxer'),
      'options' => array(
        'disabled' => array(
          'alt' => esc_html__('Disabled', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/disabled.png',
        ),
        'hidden_menu' => array(
          'alt' => esc_html__('Hidden', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/hidden.png',
        ),
        'visible_menu' => array(
          'alt' => esc_html__('Visible', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/visible.png',
        ),
        'fullscreen' => array(
          'alt' => esc_html__('FullScreen', 'plaxer'),
          'img' => get_template_directory_uri() . '/images/redux/fullscreen.png',
        ),
      ),
      'default' => 'visible_menu',
    ),
    array(
      'id' => 'navigation_item_hover_style',
      'type' => 'image_select',
      'title' => esc_html__('Navigation hover style', 'plaxer'),
      'options' => array(
        'style1' => array(
          'alt' => 'Style 1',
          'img' => get_template_directory_uri() . '/images/redux/nav-h1.png',
        ),
        'style2' => array(
          'alt' => 'Style 2',
          'img' => get_template_directory_uri() . '/images/redux/nav-h2.png',
        ),
        'style3' => array(
          'alt' => 'Style 3',
          'img' => get_template_directory_uri() . '/images/redux/nav-h3.png',
        ),
        'style4' => array(
          'alt' => 'Style 4',
          'img' => get_template_directory_uri() . '/images/redux/nav-h4.png',
        ),
      ),
      'default' => 'style1',
    ),
    array(
      'id' => 'nav-options-end',
      'type' => 'section',
      'indent' => false,
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Typography', 'plaxer'),
  'id' => 'typography',
  'customizer_width' => '400px',
  'icon' => 'fa fa-font',
  'fields' => array(
    array(
      'id' => 'body-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('Body', 'plaxer'),
      'output' => array('body'),
      'default' => array(
        'weight' => 'regular',
        'family' => 'proxima-nova',
        'font-size' => '16px',
      ),
    ),
    array(
      'id' => 'h1-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('H1', 'plaxer'),
      'output' => array('h1, .h1'),
      'default' => array(
        'weight' => '600',
        'family' => 'raleway',
        'font-size' => '60px',
      ),
    ),
    array(
      'id' => 'h2-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('H2', 'plaxer'),
      'output' => array('h2, .h2'),
      'default' => array(
        'weight' => '600',
        'family' => 'raleway',
        'font-size' => '48px',
      ),
    ),
    array(
      'id' => 'h3-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('H3', 'plaxer'),
      'output' => array('h3, .h3'),
      'default' => array(
        'weight' => '600',
        'family' => 'raleway',
        'font-size' => '40px',
      ),
    ),
    array(
      'id' => 'h4-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('H4', 'plaxer'),
      'output' => array('h4, .h4'),
      'default' => array(
        'weight' => '600',
        'family' => 'raleway',
        'font-size' => '36px',
      ),
    ),
    array(
      'id' => 'h5-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('H5', 'plaxer'),
      'output' => array('h5, .h5'),
      'default' => array(
        'weight' => '600',
        'family' => 'raleway',
        'font-size' => '30px',
      ),
    ),
    array(
      'id' => 'h6-font-face',
      'type' => 'yprm_typography',
      'title' => esc_html__('H6', 'plaxer'),
      'output' => array('h6, .h6'),
      'default' => array(
        'weight' => '600',
        'family' => 'raleway',
        'font-size' => '24px',
      ),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Theme Fonts', 'plaxer'),
  'id' => 'theme_fonts',
  'icon' => 'fas fa-i-cursor',
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Fonts', 'plaxer'),
  'id' => 'theme_fonts_array',
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'custom_fonts',
      'type' => 'yprm_fonts',
      'default' => array(
        'fonts' => '{"type":"typekit","family":"Raleway","slug":"raleway","variants":"300, 300 Italic, Regular, Italic, 500, 500 Italic, 600, 600 Italic, 700, 700 Italic","subsets":false,"css":["raleway"]},{"type":"typekit","family":"Poppins","slug":"poppins","variants":"Regular, Italic, 500, 500 Italic, 600, 600 Italic, 700, 700 Italic","subsets":false,"css":["poppins"]},{"type":"typekit","family":"Proxima Nova","slug":"proxima-nova","variants":"300, 300 Italic, Regular, Italic, 500, 500 Italic, 600, 600 Italic, 700, 700 Italic","subsets":false,"css":["proxima-nova"]}',
        'typekit_project_id' => 'fir4xfr',
      ),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Icon Fonts', 'plaxer'),
  'id' => 'theme_icon_fonts_array',
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'icon_fonts',
      'type' => 'yprm_icon_fonts',
      'title' => esc_html__('Upload Custom Icon Fonts', 'plaxer'),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Social Links', 'plaxer'),
  'id' => 'social_links',
  'customizer_width' => '400px',
  'icon' => 'fab fa-twitter',
  'fields' => array(
    array(
      'id' => 'social_target',
      'type' => 'select',
      'title' => esc_html__('Open Link In', 'plaxer'),
      'options' => array(
        '_self' => esc_html__('Current Tab', 'plaxer'),
        '_blank' => esc_html__('New Tab', 'plaxer'),
      ),
      'default' => '_self',
    ),
    array(
      'id' => 'sl1',
      'type' => 'raw',
      'title' => esc_html__('Social Button 1', 'plaxer'),
    ),
    array(
      'id' => 'social_icon1',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link1',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
    array(
      'id' => 'sb2',
      'type' => 'raw',
      'title' => esc_html__('Social Button 2', 'plaxer'),
    ),
    array(
      'id' => 'social_icon2',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link2',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
    array(
      'id' => 'sb3',
      'type' => 'raw',
      'title' => esc_html__('Social Button 3', 'plaxer'),
    ),
    array(
      'id' => 'social_icon3',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link3',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
    array(
      'id' => 'sb4',
      'type' => 'raw',
      'title' => esc_html__('Social Button 4', 'plaxer'),
    ),
    array(
      'id' => 'social_icon4',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link4',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
    array(
      'id' => 'sb5',
      'type' => 'raw',
      'title' => esc_html__('Social Button 5', 'plaxer'),
    ),
    array(
      'id' => 'social_icon5',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link5',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
    array(
      'id' => 'sb6',
      'type' => 'raw',
      'title' => esc_html__('Social Button 6', 'plaxer'),
    ),
    array(
      'id' => 'social_icon6',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link6',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
    array(
      'id' => 'sb7',
      'type' => 'raw',
      'title' => esc_html__('Social Button 7', 'plaxer'),
    ),
    array(
      'id' => 'social_icon7',
      'type' => 'select',
      'title' => esc_html__('Social Icon', 'plaxer'),
      'options' => yprm_redux_social_icons(),
      'default' => '',
    ),
    array(
      'id' => 'social_link7',
      'type' => 'text',
      'title' => esc_html__('Link', 'plaxer'),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Footer', 'plaxer'),
  'id' => 'footer_area',
  'customizer_width' => '400px',
  'icon' => 'fas fa-th-large',
  'fields' => array(
    array(
      'id' => 'footer',
      'type' => 'button_set',
      'title' => esc_html__('Footer', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'footer_logo',
      'type' => 'button_set',
      'title' => esc_html__('Footer Logo', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'footer_light_logo',
      'type' => 'background',
      'title' => esc_html__('Logo Image - light', 'plaxer'),
      'desc' => esc_html__('Choose a logo image to display for "Light" header skin', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
      'required' => array('footer_logo', '=', 'true'),
    ),
    array(
      'id' => 'footer_dark_logo',
      'type' => 'background',
      'title' => esc_html__('Logo Image - Dark', 'plaxer'),
      'desc' => esc_html__('Choose a logo image to display for "Dark" header skin', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
      'required' => array('footer_logo', '=', 'true'),
    ),
    array(
      'id' => 'footer_logo_size',
      'units' => 'px',
      'type' => 'dimensions',
      'units_extended' => 'false',
      'title' => esc_html__('Logo Size', 'plaxer'),
      'output' => array('.site-footer .site-logo, .site-footer .site-logo a'),
      'height' => true,
      'required' => array('footer_logo', '=', 'true'),
    ),
    array(
      'id' => 'footer_mobile_logo_size',
      'units' => 'px',
      'type' => 'dimensions',
      'units_extended' => 'false',
      'title' => esc_html__('Mobile Logo Size', 'plaxer'),
      'output' => array('.is-mobile-body .site-footer .site-logo, .is-mobile-body .site-footer .site-logo a'),
      'height' => true,
      'required' => array('footer_logo', '=', 'true'),
    ),
    array(
      'id' => 'footer_scroll_top',
      'type' => 'button_set',
      'title' => esc_html__('Scroll Top', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'footer_copyright',
      'type' => 'text',
      'title' => esc_html__('Copyright', 'plaxer'),
    ),
    array(
      'id' => 'footer_right_text',
      'type' => 'text',
      'title' => esc_html__('Right Text', 'plaxer'),
    ),
    array(
      'id' => 'footer_links',
      'type' => 'textarea',
      'title' => esc_html__('Footer Links', 'plaxer'),
      'description' => wp_kses(__('New per row.<br>#||Link Label', 'plaxer'), 'post'),
    ),
    array(
      'id' => 'footer_cols_title',
      'type' => 'raw',
      'title' => esc_html__('Cols Size', 'plaxer'),
      'desc' => wp_kses(__('<b>Example:</b> col-12 col-sm-6 col-md-4 col-lg-3<br><a href="https: //getbootstrap.com/docs/4.3/layout/grid/?#grid-options" target="_blank">Bootstrap Grid Instructions</a><br>
      If you want hide column enter <b>hide</b>', 'plaxer'), 'post'),
    ),
    array(
      'id' => 'footer_col_1',
      'type' => 'text',
      'title' => esc_html__('Col 1', 'plaxer'),
      'default' => 'col-12 col-md-3',
    ),
    array(
      'id' => 'footer_col_2',
      'type' => 'text',
      'title' => esc_html__('Col 2', 'plaxer'),
      'default' => 'col-12 col-sm-4 col-md-3',
    ),
    array(
      'id' => 'footer_col_3',
      'type' => 'text',
      'title' => esc_html__('Col 3', 'plaxer'),
      'default' => 'col-12 col-sm-4 col-md-3',
    ),
    array(
      'id' => 'footer_col_4',
      'type' => 'text',
      'title' => esc_html__('Col 4', 'plaxer'),
      'default' => 'col-12 col-sm-4 col-md-3',
    ),
    array(
			'id' => 'footer_color_title',
			'type' => 'raw',
			'title' => esc_html__('Color Customizing', 'plaxer'),
			'desc' => wp_kses(__('Customizing background and text color', 'plaxer'), 'post'),
		),
		array(
			'id' => 'footer_bg_color',
			'type' => 'color',
			'title' => esc_html__('Background Color', 'plaxer'),
			'validate' => 'color',
			'transparent' => false,
			'output' => array('background-color' => '.site-footer, .dark-scheme .site-footer'),
		),
		array(
			'id' => 'footer_text_color',
			'type' => 'color',
			'title' => esc_html__('Text Color', 'plaxer'),
			'validate' => 'color',
			'transparent' => false,
			'output' => array('color' => '.site-footer, .dark-scheme .site-footer'),
		),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('404 Page', 'plaxer'),
  'id' => '404_page',
  'customizer_width' => '400px',
  'icon' => 'fa fa-exclamation-circle',
  'fields' => array(
    array(
      'id' => 'site_scheme_404',
      'type' => 'select',
      'title' => esc_html__('Color Scheme', 'plaxer'),
      'options' => array(
        'light' => esc_html__('Light', 'plaxer'),
        'dark' => esc_html__('Dark', 'plaxer'),
      ),
      'default' => 'dark',
    ),
    array(
      'id' => '404_bg_color',
      'type' => 'color',
      'title' => esc_html__('Background Color', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('background' => '.banner-404 .bg-overlay .color'),
    ),
    array(
      'id' => '404_bg',
      'type' => 'background',
      'title' => esc_html__('Background Image', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
    ),
    array(
      'id' => '404_sub_heading',
      'type' => 'textarea',
      'title' => esc_html__('Sub Heading', 'plaxer'),
      'default' => wp_kses(__('#oooops', 'plaxer'), 'post'),
    ),
    array(
      'id' => '404_heading',
      'type' => 'textarea',
      'title' => esc_html__('Heading', 'plaxer'),
      'default' => wp_kses(__('404 Error', 'plaxer'), 'post'),
    ),
    array(
      'id' => '404_text',
      'type' => 'textarea',
      'title' => esc_html__('Text', 'plaxer'),
      'default' => esc_html__('You are on a non existing page!', 'plaxer'),
    ),
    array(
      'id' => '404_page_text_color',
      'type' => 'color',
      'title' => esc_html__('Text Color', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('color' => '.block-404'),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Coming Soon Page', 'plaxer'),
  'id' => 'coming_soon',
  'customizer_width' => '400px',
  'icon' => 'fas fa-calendar-alt',
  'fields' => array(
    array(
      'id' => 'site_scheme_coming_soon',
      'type' => 'select',
      'title' => esc_html__('Color Scheme', 'plaxer'),
      'options' => array(
        'light' => esc_html__('Light', 'plaxer'),
        'dark' => esc_html__('Dark', 'plaxer'),
      ),
      'default' => 'dark',
    ),
    array(
      'id' => 'coming_soon_bg',
      'type' => 'background',
      'title' => esc_html__('Background Image', 'plaxer'),
      'background-attachment' => false,
      'background-position' => false,
      'background-repeat' => false,
      'background-origin' => false,
      'background-color' => false,
      'background-size' => false,
      'background-clip' => false,
      'preview_media' => true,
      'preview' => false,
    ),
    array(
      'id' => 'coming_soon_color',
      'type' => 'color',
      'title' => esc_html__('Text Color', 'plaxer'),
      'validate' => 'color',
      'transparent' => false,
      'output' => array('color' => '.coming-soon-block'),
    ),
    array(
      'id' => 'coming_soon_subscribe_code',
      'type' => 'text',
      'title' => esc_html__('Subscribe Form ShortCode', 'plaxer'),
    ),
    array(
      'id' => 'coming_soon_sub_heading',
      'type' => 'textarea',
      'title' => esc_html__('Sub Heading', 'plaxer'),
      'default' => esc_html__('#underconstruction', 'plaxer'),
    ),
    array(
      'id' => 'coming_soon_heading',
      'type' => 'textarea',
      'title' => esc_html__('Heading', 'plaxer'),
      'default' => esc_html__('Coming Soon', 'plaxer'),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Portfolio Project Page', 'plaxer'),
  'id' => 'project_page',
  'customizer_width' => '400px',
  'icon' => 'fas fa-tasks',
  'fields' => array(
    array(
      'id' => 'project_image',
      'type' => 'select',
      'title' => esc_html__('Project Image', 'plaxer'),
      'options' => array(
        'cover' => esc_html__('Cover', 'plaxer'),
        'original' => esc_html__('Original', 'plaxer'),
        'disabled' => esc_html__('Disabled', 'plaxer'),
      ),
      'default' => 'cover',
    ),
    array(
      'id' => 'project_style',
      'type' => 'select',
      'title' => esc_html__('Style Project Page', 'plaxer'),
      'options' => array(
        'grid' => esc_html__('Grid', 'plaxer'),
        'masonry' => esc_html__('Masonry', 'plaxer'),
        'packery' => esc_html__('Packery', 'plaxer'),
        'slider' => esc_html__('Slider', 'plaxer'),
      ),
      'default' => 'grid',
    ),
    array(
      'id' => 'project_count_cols',
      'type' => 'select',
      'title' => esc_html__('Cols Count', 'plaxer'),
      'options' => array(
        '1' => esc_html__('1', 'plaxer'),
        '2' => esc_html__('2', 'plaxer'),
        '3' => esc_html__('3', 'plaxer'),
        '4' => esc_html__('4', 'plaxer'),
      ),
      'required' => array('project_style', '=', array('grid', 'masonry', 'packery')),
      'default' => '3',
    ),
    array(
      'id' => 'project_featured_image',
      'type' => 'button_set',
      'title' => esc_html__('Featured Image', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'project_categories',
      'type' => 'button_set',
      'title' => esc_html__('Categories', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Project Items', 'plaxer'),
  'id' => 'project_items',
  'customizer_width' => '400px',
  'icon' => 'fa fa-th',
  'fields' => array(
    array(
      'id' => 'project_in_popup',
      'type' => 'button_set',
      'title' => esc_html__('Open Project In Popup', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Yes', 'plaxer'),
        'false' => esc_html__('No', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'portfolio_style',
      'type' => 'select',
      'title' => esc_html__('Portfolio Style', 'plaxer'),
      'options' => array(
        'masonry' => esc_html__('Masonry', 'plaxer'),
        'grid' => esc_html__('Grid', 'plaxer'),
      ),
      'default' => 'grid',
    ),
    array(
      'id' => 'portfolio_cols',
      'type' => 'select',
      'title' => esc_html__('Cols Count', 'plaxer'),
      'options' => array(
        'col2' => esc_html__('Col 2', 'plaxer'),
        'col3' => esc_html__('Col 3', 'plaxer'),
        'col4' => esc_html__('Col 4', 'plaxer'),
      ),
      'default' => 'col3',
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Portfolio LightBox', 'plaxer'),
  'id' => 'portfolio_light_box',
  'customizer_width' => '400px',
  'icon' => 'far fa-images',
  'fields' => array(
    array(
      'id' => 'project_image_zoom',
      'type' => 'button_set',
      'title' => esc_html__('Zoom', 'plaxer'),
      'options' => array(
        'show' => esc_html__('Show', 'plaxer'),
        'hide' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'show',
    ),
    array(
      'id' => 'project_image_full_screen',
      'type' => 'button_set',
      'title' => esc_html__('Toggle Full Screen', 'plaxer'),
      'options' => array(
        'show' => esc_html__('Show', 'plaxer'),
        'hide' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'show',
    ),
    array(
      'id' => 'project_image_share',
      'type' => 'button_set',
      'title' => esc_html__('Share', 'plaxer'),
      'options' => array(
        'show' => esc_html__('Show', 'plaxer'),
        'hide' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'show',
    ),
    array(
      'id' => 'project_image_download',
      'type' => 'button_set',
      'title' => esc_html__('Download Link', 'plaxer'),
      'options' => array(
        'show' => esc_html__('Show', 'plaxer'),
        'hide' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'hide',
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Blog post', 'plaxer'),
  'id' => 'blog_post',
  'customizer_width' => '400px',
  'icon' => 'far fa-edit',
  'fields' => array(
    array(
      'id' => 'blog_feature_image',
      'type' => 'button_set',
      'title' => esc_html__('Blog Feature Image', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'blog_feature_image_style',
      'type' => 'button_set',
      'title' => esc_html__('Blog Feature Image Style', 'plaxer'),
      'options' => array(
        'cover' => esc_html__('Cover', 'plaxer'),
        'original' => esc_html__('Original', 'plaxer'),
      ),
      'default' => 'cover',
    ),
    array(
      'id' => 'blog_date',
      'type' => 'button_set',
      'title' => esc_html__('Show Date', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'blog_like',
      'type' => 'button_set',
      'title' => esc_html__('Show Like', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'blog_comments',
      'type' => 'button_set',
      'title' => esc_html__('Show Comments', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'blog_categories',
      'type' => 'button_set',
      'title' => esc_html__('Show Categories', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
    array(
      'id' => 'blog_sidebar',
      'type' => 'button_set',
      'title' => esc_html__('Show Sidebar', 'plaxer'),
      'options' => array(
        'true' => esc_html__('Show', 'plaxer'),
        'false' => esc_html__('Hide', 'plaxer'),
      ),
      'default' => 'true',
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Translations', 'plaxer'),
  'id' => 'translations',
  'customizer_width' => '400px',
  'icon' => 'fa fa-language',
  'fields' => array(
    array(
      'id' => 'tr_load_more',
      'type' => 'text',
      'title' => esc_html__('Load More', 'plaxer'),
    ),
    array(
      'id' => 'tr_all',
      'type' => 'text',
      'title' => esc_html__('All', 'plaxer'),
    ),
    array(
      'id' => 'tr_read_more',
      'type' => 'text',
      'title' => esc_html__('Read More', 'plaxer'),
    ),
    array(
      'id' => 'tr_view_category',
      'type' => 'text',
      'title' => esc_html__('View Category', 'plaxer'),
    ),
    array(
      'id' => 'tr_back_to_top',
      'type' => 'text',
      'title' => esc_html__('back to top', 'plaxer'),
    ),
    array(
      'id' => 'tr_open_project',
      'type' => 'text',
      'title' => esc_html__('open project', 'plaxer'),
    ),
    array(
      'id' => 'tr_prev',
      'type' => 'text',
      'title' => esc_html__('Prev', 'plaxer'),
    ),
    array(
      'id' => 'tr_next',
      'type' => 'text',
      'title' => esc_html__('Next', 'plaxer'),
    ),
    array(
      'id' => 'tr_send',
      'type' => 'text',
      'title' => esc_html__('Send', 'plaxer'),
    ),
    array(
      'id' => 'tr_win',
      'type' => 'text',
      'title' => esc_html__('Win', 'plaxer'),
    ),
    array(
      'id' => 'tr_vs',
      'type' => 'text',
      'title' => esc_html__('VS', 'plaxer'),
    ),
    array(
      'id' => 'tr_twitch_stream',
      'type' => 'text',
      'title' => esc_html__('Twitch Stream', 'plaxer'),
    ),
    array(
      'id' => 'tr_youtube_stream',
      'type' => 'text',
      'title' => esc_html__('Youtube Stream', 'plaxer'),
    ),
    array(
      'id' => 'tr_date_match',
      'type' => 'text',
      'title' => esc_html__('Date match', 'plaxer'),
    ),
  ),
));

Redux::setSection($opt_name, array(
  'title' => esc_html__('Custom code & analytics & Map API', 'plaxer'),
  'id' => 'custom_code_analytics',
  'customizer_width' => '400px',
  'icon' => 'fa fa-code',
  'fields' => array(
    array(
      'id' => 'code_in_head',
      'type' => 'ace_editor',
      'title' => esc_html__('Code in <head>', 'plaxer'),
    ),
    array(
      'id' => 'code_before_body',
      'type' => 'ace_editor',
      'title' => esc_html__('Code before </body> tag', 'plaxer'),
    ),
    array(
      'id' => 'google_maps_api_key',
      'type' => 'text',
      'title' => esc_html__('Google Map API Key', 'plaxer'),
      'description' => __('Create an application in <a href="https://console.developers.google.com/flows/enableapi?apiid=places_backend,maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank">Google Console</a> and add the Key here.', 'plaxer'),
    ),
  ),
));