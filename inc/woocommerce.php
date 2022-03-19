<?php

/**
 * WooCommerce Loop Product Thumbs
 **/
if (!function_exists('plaxer_woocommerce_template_loop_product_thumbnail')) {
  function plaxer_woocommerce_template_loop_product_thumbnail() {
    echo plaxer_woocommerce_get_product_thumbnail();
  }
}

if (!function_exists('plaxer_woocommerce_get_product_thumbnail')) {

  function plaxer_woocommerce_get_product_thumbnail($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0) {
    global $post, $woocommerce, $product, $woocommerce_loop;
    if (!$placeholder_width) {
      $placeholder_width = wc_get_image_size('shop_catalog')['width'];
    }

    if (!$placeholder_height) {
      $placeholder_height = wc_get_image_size('shop_catalog')['height'];
    }

    $class = implode(' ', array_filter(array(
      'add_to_cart_button',
      'product_type_' . $product->get_type(),
      $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
    )));

    $label = esc_html__('Add to cart', 'plaxer');

    if ($product->get_type() != 'simple') {
      $label = yprm_get_theme_setting('tr_view');
    }

    $button_html = apply_filters('woocommerce_loop_add_to_cart_link',
      sprintf('<a rel="nofollow" href="%s" data-quantity="1" data-product_id="%s" data-product_sku="%s" class="%s" data-magic-cursor="link"><i class="base-icon-shopping-cart"></i><span>%s</span></a>',
        esc_url($product->add_to_cart_url()),
        esc_attr($product->get_id()),
        esc_attr($product->get_sku()),
        esc_attr($class),
        esc_html($label)
      ),
      $product);

    $output = '';
    $output = '<div class="image">';
    if ($product->is_on_sale()) {
      $output .= '<span class="onsale accent"><span>' . esc_html__('Sale', 'plaxer') . '</span></span>';
    }

    $output .= '<div class="buttons">';
    $output .= $button_html;
    $output .= '</div>';

    if (class_exists('YPRM_Plaxer_Addons') && $attachment_ids = $product->get_gallery_image_ids()) {
      if (is_array($attachment_ids)) {
        if ($thumb = $product->get_image_id()) {
          array_unshift($attachment_ids, $thumb);
        }

        $output .= '<div class="product-thumb-slider swiper-container">';
        $output .= '<div class="nav-arrows"><div class="prev base-icon-back" data-magic-cursor="link"></div><div class="next base-icon-next-1" data-magic-cursor="link"></div></div>';
        $output .= '<div class="swiper-wrapper">';
        foreach ($attachment_ids as $img_item) {
          $output .= '<div class="swiper-slide"><a href="' . get_the_permalink() . '">' . wp_get_attachment_image($img_item, 'shop_catalog', '', array('class' => 'show')) . '</a></div>';
        }
        $output .= '</div>';
        $output .= '</div>';

        wp_enqueue_script('swiper');
        wp_enqueue_style('swiper');
      }
    } else {
      $output .= '<a href="' . get_the_permalink() . '" class="img">';
      if (has_post_thumbnail()) {
        $output .= wp_get_attachment_image($product->get_image_id(), 'shop_catalog', '', array('class' => 'show'));
      } else {
        $output .= '<img src="' . wc_placeholder_img_src() . '" alt="' . esc_attr__('Placeholder', 'plaxer') . '" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
      }
      $output .= '</a>';
    }
    $output .= '</div>';
    $output .= '<div class="bottom">';
    $output .= '<div class="categories">'.wc_get_product_category_list($post->ID, ', ').'</div>';
    $output .= '<h6 class="h"><a href="' . get_the_permalink() . '">' . strip_tags($product->get_name()) . '</a></h6>';
    if ($price_html = $product->get_price_html()) {
      $output .= '<div class="price ' . esc_attr($product->get_type()) . '">' . wp_kses($price_html, 'post') . '</div>';
    }
    $output .= '</div>';

    return $output;
  }
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'plaxer_woocommerce_template_loop_product_thumbnail', 10);

/**
 * AJAX MiniCart
 */

function woocommerce_header_add_to_cart_fragment($fragments) {
  ob_start();
  echo yprm_wc_minicart();
  $fragments['.header-minicart-plaxer'] = ob_get_clean();
  return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

/**
 * Related Product Counts
 */

add_filter('woocommerce_output_related_products_args', 'plaxer_single_products_args', 20);
add_filter('woocommerce_upsell_display_args', 'plaxer_single_products_args', 20);
function plaxer_single_products_args($args) {
  $args['posts_per_page'] = 2;
  $args['columns'] = 3;
  return $args;
}

/**
 * Cross Sells Columns
 */

add_filter('woocommerce_cross_sells_columns', 'plaxer_woocommerce_cross_sells_columns', 20);
function plaxer_woocommerce_cross_sells_columns() {
  return 1;
}

/**
 * Mini Cart Buttons
 */

add_action('woocommerce_widget_shopping_cart_buttons', function () {
  remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);
  remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);

  add_action('woocommerce_widget_shopping_cart_buttons', 'yprm_button_view_cart', 10);
  add_action('woocommerce_widget_shopping_cart_buttons', 'yprm_proceed_to_checkout', 20);
}, 1);

function yprm_button_view_cart() {
  $link = wc_get_cart_url();
  echo '<a href="' . esc_url($link) . '" class="button-style1"><span>' . esc_html__('View cart', 'plaxer') . '</span></a>';
}

function yprm_proceed_to_checkout() {
  $link = wc_get_checkout_url();
  echo '<a href="' . esc_url($link) . '" class="button-style1 checkout"><span>' . esc_html__('Checkout', 'plaxer') . '</span></a>';
}

/**
 * Edit Actions
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 50);
add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55);