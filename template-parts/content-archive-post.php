<?php

$id = get_the_ID();
$item = get_post($id);

$block_item_class = array('blog-item');

$cols = '3';
$type = 'grid';

if(is_front_page() && is_active_sidebar('sidebar')) {
  $cols = '2';
}

switch ($cols) {
  case '1':
    $item_col = "col-12";
    break;
  case '2':
    $item_col = "col-12 col-sm-6";
    $mobile_cols = "2";
    $tablet_cols = "2";
    $desktop_cols = "2";
    break;
  case '3':
    $item_col = "col-12 col-sm-6 col-md-4";
    $mobile_cols = "2";
    $tablet_cols = "3";
    $desktop_cols = "3";
    break;
  case '4':
    $item_col = "col-12 col-sm-4 col-md-3";
    $mobile_cols = "2";
    $tablet_cols = "3";
    $desktop_cols = "4";
    break;

  default:
    $item_col = "";
    break;
}

$block_item_class[] = $item_col;

$block_item_class[] = 'type-'.$type;

$heading = $item->post_title;
$categories = array();

if (function_exists('get_field') && $short_desc = get_field('short_desc', $id)) {
  $desc = $short_desc;
} else {
  $desc = strip_tags(strip_shortcodes($item->post_content));
}

if($type == 'grid' || $type == 'masonry') {
  $desc_size = '145';
} else if($type == 'carousel') {
  $desc_size = '100';
}

$desc = mb_strimwidth($desc, 0, $desc_size, '...');

if (is_array(wp_get_post_terms($id, 'category'))) {
  foreach(wp_get_post_terms($id, 'category') as $category_item) {
    $block_item_class[] = 'category-' . $category_item->slug;
    $categories[] = $category_item->name;
  }
}

$thumb = get_post_meta($id, '_thumbnail_id', true);
$image_array = wp_get_attachment_image_src($thumb, 'large');
$image_html = wp_get_attachment_image($thumb, 'large');

$link = get_permalink($id);

?>
<article <?php post_class(yprm_implode($block_item_class)) ?>>
  <div class="wrap">
    <?php if(is_sticky()) { ?>
      <i class="sticky fa fa-thumbtack"></i>
    <?php } if(!empty($image_array[0])) { ?>
      <div class="img"><a href="<?php echo esc_url($link) ?>" style="background-image: url(<?php echo esc_url($image_array[0]) ?>)"></a></div>
    <?php } ?>
    <div class="date"><?php echo get_the_date() ?></div>
    <a class="title" href="<?php echo esc_url($link) ?>"><?php echo strip_tags($heading) ?></a>
    <div class="button"><a class="button-style2" href="<?php echo esc_url($link) ?>"><span><?php echo wp_kses(yprm_get_theme_setting('tr_read_more'), 'post') ?></span></a></div>
  </div>
</article>