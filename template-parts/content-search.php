<?php

$desc = strip_tags(strip_shortcodes(get_the_content()));

if(function_exists('get_field') && $short_desc = get_field('short_desc')) {
  $desc = strip_tags($short_desc);
}

if(!empty($desc)) {
  $desc = mb_strimwidth($desc, 0, 140, '...');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-item'); ?>>
  <div class="wrap">
    <h6 class="h"><?php echo strip_tags(get_the_title()); ?></h6>
    <?php if(!empty($desc)) { ?>
      <div class="desc"><?php echo strip_tags($desc) ?></div>
    <?php } ?>
    <div class="button"><a class="link-button accent" href="<?php echo esc_url(get_the_permalink()) ?>"><i class="pointers-right-arrow"></i><span><?php echo wp_kses(yprm_get_theme_setting('tr_read_more'), 'post') ?></span></a></div>
  </div>
</article>
