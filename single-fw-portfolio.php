<?php get_header(); ?>
  <?php if(post_password_required()) {
    echo get_the_password_form();
  } else { ?>
    <main class="main-container project-single-page">
      <div class="container">
        <?php
          while (have_posts()):
            the_post();

            $fields_html = $video_player = '';

            $id = get_the_ID();

            $thumb = get_post_meta($id, '_thumbnail_id', true);

            $prev_post = get_permalink(get_adjacent_post(false, '', false));
            $next_post = get_permalink(get_adjacent_post(false, '', true));

            $thumbnails = fw_ext_portfolio_get_gallery_images($id);

            $categories = $categories_html = '';
            if (is_array(wp_get_post_terms($id, 'fw-portfolio-category'))) {
              foreach(wp_get_post_terms($id, 'fw-portfolio-category') as $category_item) {
                $categories .= $category_item->name.', ';
                $categories_html .= '<a href="'.esc_url(get_term_link($category_item)).'">'.$category_item->name.'</a>';
              }
            }
            $categories = trim($categories, ', ');

            switch ($item_s_col = yprm_get_theme_setting('project_count_cols')) {
            case '1':
              $item_col = 'col-12';
              break;
            case '2':
              $item_col = 'col-12 col-sm-6 col-md-6';
              break;
            case '3':
              $item_col = 'col-12 col-sm-4 col-md-4';
              break;
            case '4':
              $item_col = 'col-12 col-sm-4 col-md-3';
              break;

            default:
              $item_col = '';
              break;
            }

            if (function_exists('get_field')) {
              if(get_field('project_video_sourse') != 'none') {
                if(!empty($video_url = get_field('project_video_url'))) {
                  $video_player = VideoUrlParser::get_player($video_url);
                }

                if(!empty($video_url = get_field('project_video_media')['url'])) {
                  $video_player = VideoUrlParser::get_player($video_url);
                }
              }
            }

            $video_allowed_html = array(
              'iframe' => array(
                'src'             => true,
                'height'          => true,
                'width'           => true,
                'frameborder'     => true,
                'allowfullscreen' => true,
              ),
              'video' => array()
            );

            $project_image = yprm_get_theme_setting('project_image');
          ?>
            <?php if (is_array($thumbnails) && count($thumbnails) > 0 && ($project_style = yprm_get_theme_setting('project_style')) == 'slider') {
              wp_enqueue_script('swiper');
              wp_enqueue_style('swiper');
            ?>
              <div class="project-slider">
                <div class="prev base-icon-back" data-magic-cursor="link-small"></div>
                <div class="next base-icon-next-1" data-magic-cursor="link-small"></div>
                <div class="swiper-container">
                  <div class="swiper-wrapper">
                    <?php foreach ($thumbnails as $key => $thumb) {
                      $img_id = $thumb['attachment_id'];
                      $img_full_url = wp_get_attachment_image_src($img_id, 'full')[0];
                      $img_array = wp_get_attachment_image_src($img_id, 'large');
                      $img_html = wp_get_attachment_image($img_id, 'large');
                    ?>
                    <div class="swiper-slide item<?php echo esc_attr(($project_image == 'original') ? ' type-original' : ''); ?>">
                      <a href="<?php echo esc_url($img_full_url); ?>" data-size="<?php echo esc_attr($img_array[1].'x'.$img_array[2]); ?>">
                        <?php if($project_image == 'original') {
                          echo wp_kses($img_html, 'post');
                        } else {
                          echo '<span style="background-image: url('.esc_url($img_array[0]).')"></span>';
                        } ?>
                      </a>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php } else if (!empty($thumb) && $project_image != 'disabled') { ?>
              <div class="featured-image">
                <?php if($project_image == 'cover') {
                  echo '<div style="background-image: url('.wp_get_attachment_image_src($thumb, 'full')[0].')"></div>';
                } else if($project_image == 'original') {
                  echo wp_kses(wp_get_attachment_image($thumb, 'full'), 'post');
                } ?>
              </div>
            <?php } ?>
            <article id="post-<?php echo esc_attr($id) ?>" <?php post_class('project-content-block'); ?>>
              <div class="heading-block">
                <?php if($categories) { ?>
                  <div class="sub-h">#<?php echo esc_html($categories) ?></div>
                <?php } ?>
                <h1 class="h h2"><?php single_post_title() ?></h1>
              </div>
              <div class="post-content">
                <div class="clearfix"><?php the_content(''); ?></div>
                <?php if (function_exists('wp_link_pages')) { ?>
                  <?php wp_link_pages(array('before' => '<div class="page-pagination">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
                <?php } ?>
              </div>
              <?php if(!empty($video_player)) { ?>
                <div class="project-video">
                  <div class="wrap"><?php echo wp_kses($video_player, $video_allowed_html) ?></div>
                </div>
              <?php } if (is_array($thumbnails) && count($thumbnails) > 0 && $project_style != 'slider') {
                $items_class = ' style-'.$project_style;
                $items_class .= ' cols-'.$item_s_col;
              ?>
                <div class="project-gallery<?php echo esc_attr($items_class); ?> popup-gallery isotope row">
                  <div class="grid-sizer <?php echo esc_attr($item_col) ?>"></div>
                  <?php foreach ($thumbnails as $key => $thumb) {
                    $img_id = $thumb['attachment_id'];
                    $img_full_url = wp_get_attachment_image_src($img_id, 'full')[0];
                    $img_array = wp_get_attachment_image_src($img_id, 'large');
                    $img_html = wp_get_attachment_image($img_id, 'large');

                    $item_class = $item_col;
                  ?>
                    <div class="item <?php echo esc_attr($item_class) ?> popup-item">
                      <a href="<?php echo esc_url($img_full_url); ?>" data-size="<?php echo esc_attr($img_array[1].'x'.$img_array[2]); ?>">
                        <?php if($project_style == 'grid' || $project_style == 'packery') { ?>
                          <span style="background-image: url(<?php echo esc_url($img_array[0]); ?>)"></span>
                        <?php } else if($project_style == 'masonry') {
                          echo wp_kses($img_html, 'post');
                        } ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </article>
            <?php
            if (comments_open() || get_comments_number()):
              comments_template();
            endif;

          endwhile;
        ?>
      </div>
    </main>
  <?php } ?>
<?php get_footer();