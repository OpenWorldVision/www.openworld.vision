<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')) ?>" >
  <div><input type="text" value="<?php echo esc_attr(get_search_query()) ?>" placeholder="<?php echo esc_attr__('Type and hit enter', 'plaxer') ?>" name="s" class="input" /></div>
  <button type="submit" class="searchsubmit" value=""><i class="base-icon-magnifying-glass"></i></button>
</form>