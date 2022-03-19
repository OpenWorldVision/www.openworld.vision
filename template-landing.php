<?php

/*
Template Name: Landing page
*/

get_header(); ?>
  <?php if(post_password_required()) {
    echo get_the_password_form();
  } else { ?>
    <main class="main-container">
      <div class="container">

        <?php while ( have_posts() ) : the_post();

          the_content();

        endwhile; ?>

      </div>
    </main>
  <?php } ?>
<?php get_footer();