<?php get_header(); ?>
  <?php if(post_password_required()) {
    echo get_the_password_form();
  } else { ?>
    <?php echo yprm_page_top_block() ?>
    <main class="main-container">
      <div class="container">
        <?php
        while ( have_posts() ) :
          the_post();

          get_template_part( 'template-parts/content', 'page' );

          if ( comments_open() || get_comments_number() ) :
            comments_template();
          endif;

        endwhile;
        ?>
      </div>
    </main>
  <?php } ?>
<?php get_footer();
