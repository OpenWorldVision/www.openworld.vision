<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $woocommerce_loop;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

switch (wc_get_loop_prop( 'columns' )) {
  case '1':
    $item_col = "col-12";
    break;
  case '2':
    $item_col = "col-12 col-sm-6";
    break;
  case '3':
    $item_col = "col-12 col-sm-6 col-md-4";
    break;
  case '4':
    $item_col = "col-12 col-sm-4 col-md-4 col-lg-3";
    break;

  default:
    $item_col = "";
    break;
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
  sprintf('<a rel="nofollow" href="%s" data-quantity="1" data-product_id="%s" data-product_sku="%s" class="%s" data-magic-cursor="link"><span>%s</span></a>',
    esc_url($product->add_to_cart_url()),
    esc_attr($product->get_id()),
    esc_attr($product->get_sku()),
    esc_attr($class),
    esc_html($label)
  ),
$product);

if(wc_get_loop_prop('type') == 'carousel') { ?>
  <div class="swiper-slide">
    <div class="wrap">
      <div class="image" style="<?php echo esc_attr(yprm_get_image($product->get_image_id(), 'bg')); ?>"></div>
      <h4 class="title">
        <?php echo strip_tags($product->get_name()) ?>
        <?php if($price_html = $product->get_price_html()) {
          echo '<div class="price">'.wp_kses($price_html, 'post').'</div>';
        } ?>
      </h4>
      <a class="full-link" href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo yprm_get_theme_setting('tr_view') ?></a>
    </div>
  </div>
<?php } else { ?>
  <li <?php wc_product_class($item_col, $product); ?>>
    <div class="product-wrap">
      <?php
      /**
       * Hook: woocommerce_before_shop_loop_item_title.
       *
       * @hooked woocommerce_show_product_loop_sale_flash - 10
       * @hooked woocommerce_template_loop_product_thumbnail - 10
       */
      do_action( 'woocommerce_before_shop_loop_item_title' );
      ?>
    </div>
  </li>
<?php } ?>