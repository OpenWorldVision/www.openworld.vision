<div id="post-<?php echo esc_attr($id) ?>" <?php post_class(); ?>>
  <div class="content-area clearfix">
    <?php the_content(''); ?>
  </div>
  <?php if(function_exists('wp_link_pages')) { ?>
    <?php wp_link_pages(array('before' => '<div class="page-pagination">', 'after' => '</div>','link_before' => '<span>','link_after' => '</span>', 'type' => 'list')); ?>
  <?php } ?>
</div>

