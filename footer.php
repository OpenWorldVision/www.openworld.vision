  <?php if (yprm_get_theme_setting('footer') == 'true') { 
    $footer_class = ' light-color';
    if($bg_color = yprm_get_theme_setting('footer_bg_color') ) {
      if(yprm_get_brightness($bg_color)->lightness > 130) {
        $footer_class = ' dark-color';
      } else {
        $footer_class = ' light-color';
      }
    }

    ?>
    <footer class="site-footer<?php echo esc_attr($footer_class) ?>">
      <?php if(yprm_get_theme_setting('footer_scroll_top') == 'true') { ?>
        <div class="scroll-to-top-button"><i class="base-icon-next-1"></i><span><?php echo wp_kses(yprm_get_theme_setting('tr_back_to_top'), 'post'); ?></span></div>
      <?php } ?>
      <div class="container">
        <div class="row">
          <div class="<?php echo esc_attr(yprm_get_theme_setting('footer_col_1')) ?>">
            <?php if(yprm_get_theme_setting('footer_logo') == 'true') { ?>
              <div class="site-logo"><?php echo yprm_site_footer_logo(); ?></div>
            <?php } if (is_active_sidebar('footer-1')) {
              dynamic_sidebar('footer-1');
            } ?>
          </div>
          <?php if (is_active_sidebar('footer-2')) { ?>
            <div class="<?php echo esc_attr(yprm_get_theme_setting('footer_col_2')) ?>">
              <?php dynamic_sidebar('footer-2'); ?>
            </div>
          <?php } if (is_active_sidebar('footer-3')) { ?>
            <div class="<?php echo esc_attr(yprm_get_theme_setting('footer_col_3')) ?>">
              <?php dynamic_sidebar('footer-3'); ?>
            </div>
          <?php } if (is_active_sidebar('footer-4')) { ?>
            <div class="<?php echo esc_attr(yprm_get_theme_setting('footer_col_4')) ?>">
              <?php dynamic_sidebar('footer-4'); ?>
            </div>
          <?php } ?>
        </div>
        <?php if(yprm_get_theme_setting('footer_copyright') || yprm_get_theme_setting('footer_links') || yprm_get_theme_setting('footer_right_text')) { ?>
          <div class="footer-bottom">
            <div class="left-text"><?php echo wp_kses(yprm_get_theme_setting('footer_copyright'), 'post') ?>
            <?php if ($links = yprm_get_theme_setting('footer_links')) {
              $links = strip_tags($links);
              $links = preg_split('/\r\n|[\r\n]/', $links);

              if(is_array($links) && count($links) > 0) { ?>
                <?php foreach ($links as $key => $link) {
                  $link = explode('||', $link);
                  ?>
                  <a href="<?php echo esc_url($link[0]) ?>"><?php echo strip_tags($link[1]) ?></a>
                  <?php if(count($links) != $key+1) { ?>
                    |
                  <?php } ?>
                <?php } ?>
              <?php }
            } ?>
            </div>
            <?php if($right_text = yprm_get_theme_setting('footer_right_text')) { ?>
              <div class="right-text"><?php echo wp_kses($right_text, 'post') ?></div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </footer>
  <?php } else if(yprm_get_theme_setting('footer') == 'minified') { ?>
    <footer class="site-footer-minified">
      <div class="container">
        <div class="left-text"><?php echo wp_kses(yprm_get_theme_setting('footer_copyright'), 'post') ?>
        <?php if ($links = yprm_get_theme_setting('footer_links')) {
          $links = strip_tags($links);
          $links = preg_split('/\r\n|[\r\n]/', $links);

          if(is_array($links) && count($links) > 0) { ?>
            <?php foreach ($links as $key => $link) {
              $link = explode('||', $link);
              ?>
              <a href="<?php echo esc_url($link[0]) ?>"><?php echo strip_tags($link[1]) ?></a>
              <?php if(count($links) != $key+1) { ?>
                |
              <?php } ?>
            <?php } ?>
          <?php }
        } ?>
        </div>
        <?php if($right_text = yprm_get_theme_setting('footer_right_text')) { ?>
          <div class="right-text"><?php echo wp_kses($right_text, 'post') ?></div>
        <?php } ?>
      </div>
    </footer>
  <?php } ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
