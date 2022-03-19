<?php get_header(); ?>

<?php if(post_password_required()) {
  echo get_the_password_form();
} else { ?>
  <main class="main-container">
    <?php while ( have_posts() ) :
      the_post();
      
      $id = get_the_ID();

      $thumb = get_post_meta( $id, '_thumbnail_id', true );
      $img_html = wp_get_attachment_image($thumb, 'large');
      $img_array = wp_get_attachment_image_src($thumb, 'large');
      $img_full_array = wp_get_attachment_image_src($thumb, 'full');

      $prev_post = get_permalink(get_adjacent_post(false,'',false));
      $next_post = get_permalink(get_adjacent_post(false,'',true));

      $categories = $categories_html = '';
      if (is_array(wp_get_post_terms($id, 'category'))) {
        foreach(wp_get_post_terms($id, 'category') as $category_item) {
          $categories .= $category_item->name.', ';
          $categories_html .= '<a href="'.esc_url(get_term_link($category_item)).'">'.$category_item->name.'</a>';
        }
      }
      $categories = trim($categories, ', ');
    ?>
      <div class="container">
        <?php if(is_active_sidebar('blog-sidebar') && yprm_get_theme_setting('blog_sidebar') == 'true') {
          echo '<div class="row">';
            echo '<div class="col-12 col-lg-8">';
          }
        ?>
          <article id="post-<?php echo esc_attr($id) ?>" <?php post_class('post-content-block'); ?>>
            <?php if(!empty($thumb) && yprm_get_theme_setting('blog_feature_image') == 'true') { ?>
              <div class="featured-image">
                <?php if(yprm_get_theme_setting('blog_feature_image_style') == 'cover') { ?>
                  <span style="background-image: url(<?php echo esc_url($img_array[0]) ?>)"></span>
                <?php } else { ?>
                  <?php echo wp_kses($img_html, 'post'); ?></div>
                <?php } ?>
              </div>
            <?php } if(yprm_get_theme_setting('blog_date') == 'true' || $categories) { ?>
              <div class="post-top">
                <?php if(yprm_get_theme_setting('blog_date') == 'true') { ?>
                  <div class="date"><?php echo wp_kses(get_the_date(), 'post') ?></div>
                <?php } if($categories) { ?>
                  <div class="categories"><span>#</span><?php echo esc_html($categories) ?></div>
                <?php } ?>
              </div>
            <?php } ?>
            <div class="heading-block">
              <h1 class="h h4"><?php single_post_title() ?></h1>
            </div>
            <div class="post-content">
              <div class="clearfix"><?php the_content(''); ?></div>
              <?php if(function_exists('wp_link_pages')) { ?>
                <?php wp_link_pages(array('before' => '<div class="page-pagination">', 'after' => '</div>','link_before' => '<span>','link_after' => '</span>',)); ?>
              <?php } ?>
            </div>
          </article>
          <?php if(
            (function_exists('zilla_likes') && yprm_get_theme_setting('blog_like') == 'true') ||
            (comments_open() || get_comments_number() && yprm_get_theme_setting('blog_comments') == 'true') ||
            (yprm_get_theme_setting('blog_navigation') == 'true')
          ) { ?>
            <div class="post-bottom">
              <?php if(!empty($categories_html)) { ?>
                <div class="categories">
                  <?php echo wp_kses($categories_html, 'post') ?>
                </div>
              <?php } if(
                  (function_exists('zilla_likes') && yprm_get_theme_setting('blog_like') == 'true') ||
                  (comments_open() || get_comments_number() && yprm_get_theme_setting('blog_comments') == 'true')
                ) { ?>
                <div class="right">
                  <?php if(function_exists('zilla_likes') && yprm_get_theme_setting('blog_like') == 'true') { ?>
                    <div class="item"><?php echo zilla_likes($id); ?></div>
                  <?php } if(comments_open() || get_comments_number() && yprm_get_theme_setting('blog_comments') == 'true') { ?>
                    <div class="item"><i class="base-icon-chat-2"></i><span><?php comments_number('0', '1', '%') ?></span></div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          <?php }

          if ( (comments_open() || get_comments_number()) && yprm_get_theme_setting('blog_comments') == 'true' ) :
            comments_template();
          endif;
          
          if(is_active_sidebar('blog-sidebar') && yprm_get_theme_setting('blog_sidebar') == 'true') {
              echo '</div>';
              echo '<div class="site-sidebar col-12 col-lg-4">';
                echo '<div class="wrap">';
                  dynamic_sidebar('blog-sidebar');
                echo '</div>';
              echo '</div>';
            echo '</div>';
          }
        ?>
      </div>
    <?php endwhile; ?>
  </main>
<?php } ?>

<?php get_footer();
