<?php

/*
Template Name: Page with sidebar
*/

get_header(); ?>
  <?php if(post_password_required()) {
    echo get_the_password_form();
  } else { ?>
    <?php echo yprm_page_top_block() ?>
    
    <main class="main-container">
      <div class="container">
        
        <?php
        if(is_active_sidebar('blog-sidebar')) {
          echo '<div class="row">';
            echo '<div class="col-12 col-md-8">';
        }

          while ( have_posts() ) : the_post();

            the_content();

          endwhile;

        if(is_active_sidebar('blog-sidebar')) {
            echo '</div>';
            echo '<div class="site-sidebar col-12 col-md-4">';
              echo '<div class="wrap">';
                dynamic_sidebar('blog-sidebar');
              echo '</div>';
            echo '</div>';
          echo '</div>';
        };
        ?>

      </div>
    </main>
  <?php } ?>
<?php get_footer();