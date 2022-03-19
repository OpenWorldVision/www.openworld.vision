<?php
$class = "";

$id = get_the_ID();
$item = get_post($id);
setup_postdata($item);
$name = $item->post_title;
$thumb = get_post_meta($id, '_thumbnail_id', true);
$link = get_permalink($id);
$image = wp_get_attachment_image_src($thumb, 'large');
$video = false;

$cols_css = $categories = $project_short_desc = $project_video_sourse = $project_video_url = $project_video_media = $link_video_attr = '';

switch (yprm_get_theme_setting('portfolio_cols')) {
case 'col2':
  $cols_css = 'col-12 col-sm-6';
  break;
case 'col3':
  $cols_css = 'col-12 col-sm-6 col-md-4';
  break;
case 'col4':
  $cols_css = 'col-12 col-sm-6 col-md-4 col-lg-3';
  break;
default:
  $cols_css = 'col-12';
  break;
}

if (is_array($cat_array = wp_get_post_terms($id, 'fw-portfolio-category'))) {
  foreach ($cat_array as $category_item) {
    $categories .= $category_item->name . ', ';
  }

  $categories = trim($categories, ', ');
}

if(function_exists('get_field')) {
  $project_video_sourse = get_field('project_video_sourse', $id);
  $project_video_url = get_field('project_video_url', $id);
  $project_video_media = get_field('project_video_media', $id)['url'];
  $project_short_desc = strip_tags(strip_shortcodes(get_field('project_short_desc', $id)));
}

if (yprm_get_theme_setting('project_in_popup') == 'false') {
  $link = get_permalink($id);
} else {
  $link = wp_get_attachment_image_src($thumb, 'full')[0];
  $cols_css .= ' popup-item';

  if($project_video_sourse != 'none' && (!empty($project_video_url) || !empty($project_video_media))) {
    $link = '#';
    $video = true;
    if(!empty($project_video_url)) {
      $video_url = VideoUrlParser::get_url_embed($project_video_url);
    } else if(!empty($project_video_media)) {
      $video_url = VideoUrlParser::get_url_embed($project_video_media);
    }
    $link_video_attr = ' data-type="video" data-size="1920x1080" data-video=\'<div class="wrapper"><div class="video-wrapper"><iframe class="pswp__video" width="1920" height="1080" src="'.esc_url($video_url).'" frameborder="0" allowfullscreen></iframe></div></div>\'';
  } 
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item ' . $cols_css) ?>>
  <div class="wrap">
    <a class="plus-permalink permalink" href="<?php echo esc_url(get_permalink($id)) ?>"><i class="essential-set-add"></i><span><?php echo strip_tags(yprm_get_theme_setting('tr_open_project')) ?></span></a>
    <?php if ($video) { ?>
      <div class="with-video base-icon-youtube"></div>
    <?php }if (yprm_get_theme_setting('portfolio_style') == 'grid') { ?>
      <div class="img" style="background-image: url(<?php echo wp_get_attachment_image_src($thumb, 'large')[0] ?>)"></div>
    <?php } else { ?>
      <div class="img"><?php echo wp_get_attachment_image($thumb, 'large') ?></div>
    <?php } ?>
    <div class="content">
      <h6 class="title"><?php echo strip_tags($name) ?></h6>
      <?php if ($project_short_desc) { ?>
        <div class="desc"><?php echo mb_strimwidth($project_short_desc, 0, 40, '...') ?></div>
      <?php } ?>
    </div>
    <a href="<?php echo esc_url($link) ?>" class="link" data-size="<?php echo esc_attr($image[1] . 'x' . $image[2]) ?>"<?php echo esc_attr($link_video_attr) ?>></a>
  </div>
</article>
<?php wp_reset_postdata(); ?>