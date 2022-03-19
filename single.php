<?php get_header(); ?>

<?php if(post_password_required()) {
  echo get_the_password_form();
} else { ?>
  <main class="main-container">
    <div class="container">
      <?php if(get_post_type() == 'post') { ?>
        <div class="heading-block page-title">
          <h1 class="h"><?php single_post_title() ?></h1>
        </div>
      <?php } if(is_active_sidebar('sidebar')) {
        echo '<div class="row">';
          echo '<div class="col-12 col-lg-8">';
        }
        while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content', get_post_type() );

          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;

        endwhile;
        
        if(is_active_sidebar('sidebar')) {
            echo '</div>';
            echo '<div class="site-sidebar col-12 col-lg-4">';
              echo '<div class="wrap">';
                dynamic_sidebar('sidebar');
              echo '</div>';
            echo '</div>';
          echo '</div>';
        }
      ?>
    </div>
  </main>
<?php } ?>

<?php get_footer();
