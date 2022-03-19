<?php 

$block_class = '';

if(get_post_type() == 'fw-portfolio') {
  $block_class .= ' portfolio-items';
  if(yprm_get_theme_setting('project_in_popup') == 'true') {
    $block_class .= ' popup-gallery';
  }
} else if(get_post_type() == 'post') {
  $block_class .= ' blog-items archive-blog-items isotope';
}

get_header(); ?>

  <main class="main-container">
    <div class="container">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
        <div class="heading-block page-title">
          <h1 class="h"><?php single_post_title(); ?></h1>
        </div>
				<?php
      endif;
      
      if(is_active_sidebar('sidebar')) {
				echo '<div class="row">';
          echo '<div class="col-12 col-md-8">';
			}
      
      ?>
      
      <div class="row<?php echo esc_attr($block_class) ?>">
        <?php

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

      if(is_active_sidebar('sidebar')) {
          echo '</div>';
          echo '<div class="site-sidebar col-12 col-md-4">';
            echo '<div class="wrap">';
              dynamic_sidebar('sidebar');
            echo '</div>';
          echo '</div>';
        echo '</div>';
      };

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

    </div>
  </main>

<?php
get_footer();
