<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

echo yprm_page_top_block('woocommerce');

do_action( 'woocommerce_before_main_content' );


if ( woocommerce_product_loop() ) {

  echo '<div class="shop-top row">';
    echo '<div class="'.(is_active_sidebar('shop-sidebar') ? 'with-sidebar ' : '').'col">';
      /**
       * Hook: woocommerce_before_shop_loop.
       *
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */
      do_action( 'woocommerce_before_shop_loop' );
    echo '</div>';
  echo '</div>';
  
  if(is_active_sidebar('shop-sidebar')) {
    global $woocommerce_loop;
    $woocommerce_loop["columns"] = 2;

    echo '<div class="row">';
      echo '<div class="col-12 col-md-8">';
  }

	woocommerce_product_loop_start();
  

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
      
			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
  do_action( 'woocommerce_after_shop_loop' );
  
  if(is_active_sidebar('shop-sidebar')) {
      echo '</div>';
      echo '<div class="site-sidebar col-12 col-md-4">';
        echo '<div class="wrap">';
          dynamic_sidebar('shop-sidebar');
        echo '</div>';
      echo '</div>';
    echo '</div>';
  };
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
