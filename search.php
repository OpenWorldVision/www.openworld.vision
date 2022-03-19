<?php get_header(); ?>

  <?php echo yprm_page_top_block('search') ?>

  <main class="main-container">
    
    <div class="container">

    <?php if ( have_posts() ) : ?>

			<?php

			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

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
