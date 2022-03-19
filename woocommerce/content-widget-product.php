<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if (!defined('ABSPATH')) {
  exit;
}

global $product;

if (!is_a($product, 'WC_Product')) {
  return;
}

if (!isset($args) || !is_array($args)) {
  $args = array();
}

?>
<li>
  <?php do_action('woocommerce_widget_product_item_start', $args); ?>
  <div class="content">
    <a href="<?php echo esc_url($product->get_permalink()); ?>">
      <div class="img" style="background-image: url(<?php echo wp_get_attachment_image_src($product->get_image_id(), 
      'medium')[0] ?>)"></div>
      <span class="c">
        <span class="title"><?php echo wp_kses($product->get_name(), 'post'); ?></span>
        <span class="p-count"><?php echo wp_kses($product->get_price_html(), 'post'); ?></span>
      </span>
    </a>
  </div>

  <?php do_action('woocommerce_widget_product_item_end', $args); ?>
</li>
