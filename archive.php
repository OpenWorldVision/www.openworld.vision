<?php

$block_class = '';

if(get_post_type() == 'fw-portfolio') {
  $block_class .= ' portfolio-items portfolio-type-'.yprm_get_theme_setting('portfolio_style');
  if(yprm_get_theme_setting('portfolio_style') == 'masonry') {
    $block_class .= ' isotope';
  }
  if(yprm_get_theme_setting('project_in_popup') == 'true') {
    $block_class .= ' popup-gallery';
  }
}

get_header();

?>
  <?php echo yprm_page_top_block('archive') ?>

  <main class="main-container">
    <div class="container">

		<?php if ( have_posts() ) : ?>

      <div class="row<?php echo esc_attr($block_class) ?>">
        <?php if(get_post_type() == 'fw-portfolio' && yprm_get_theme_setting('portfolio_style') == 'masonry') { ?>
          <div class="grid-sizer col-1"></div>
        <?php }

        while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content-archive', get_post_type() );

        endwhile;
        
        ?>
      </div>
      <?php
			if (function_exists('yprm_wp_corenavi')) {
				echo yprm_wp_corenavi();
			} else {
				wp_link_pages(); 
			}

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

    </div>
  </main>

<?php
get_footer();
