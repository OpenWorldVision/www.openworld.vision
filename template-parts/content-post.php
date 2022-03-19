<?php

$id = get_the_ID();

$thumb = get_post_meta( $id, '_thumbnail_id', true );
$img_html = wp_get_attachment_image($thumb, 'large');
$img_array = wp_get_attachment_image_src($thumb, 'large');
$img_full_array = wp_get_attachment_image_src($thumb, 'full');

$prev_post = get_permalink(get_adjacent_post(false,'',false));
$next_post = get_permalink(get_adjacent_post(false,'',true));

?>

<article id="post-<?php echo esc_attr($id) ?>" <?php post_class('post-content-block'); ?>>
  <?php if(!empty($thumb) && yprm_get_theme_setting('blog_feature_image') == 'true') { ?>
    <div class="featured-image">
      <a href="<?php echo esc_url($img_full_array[0]) ?>" class="single-pupup-item" data-size="<?php echo esc_attr($img_full_array[1].'x'.$img_full_array[2]) ?>">
        <?php if(yprm_get_theme_setting('blog_feature_image_style') == 'cover') { ?>
          <span style="background-image: url(<?php echo esc_url($img_array[0]) ?>)"></span>
        <?php } else {
          echo wp_kses($img_html, 'post');
        } ?>
      </a>
    </div>
  <?php } if(yprm_get_theme_setting('blog_date') == 'true') { ?>
    <div class="post-date"><?php echo wp_kses(get_the_date(), 'post') ?></div>
  <?php } ?>
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
    <div class="row">
      <?php if(
        (function_exists('zilla_likes') && yprm_get_theme_setting('blog_like') == 'true') ||
        (comments_open() || get_comments_number() && yprm_get_theme_setting('blog_comments') == 'true')
      ) { ?>
        <div class="col-12 col-sm">
          <div class="post-bottom-col">
            <div class="row">
              <?php if(function_exists('zilla_likes') && yprm_get_theme_setting('blog_like') == 'true') { ?>
                <div class="col"><?php echo zilla_likes($id); ?></div>
              <?php } if(comments_open() || get_comments_number() && yprm_get_theme_setting('blog_comments') == 'true') { ?>
                <div class="col"><i class="essential-set-edit-1"></i><span><?php comments_number() ?></span></div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } if(yprm_get_theme_setting('blog_navigation') == 'true') { ?>
        <div class="col-12 col-sm">
          <div class="post-bottom-col">
            <div class="row">
              <?php if(!empty($prev_post)) { ?>
                <a class="col" href="<?php echo esc_url($prev_post) ?>"><i class="base-icon-back"></i><span><?php echo esc_html__('Prev', 'plaxer') ?></span></a>
              <?php } if(!empty($next_post)) { ?>
                <a class="col" href="<?php echo esc_url($next_post) ?>"><span><?php echo esc_html__('Next', 'plaxer') ?></span><i class="base-icon-next-1"></i></a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } ?>