<?php

class YPRM_Admin_Pages {
  public function __construct() {
    add_action('admin_menu', array($this, 'add_menu'));
  }

  public function add_menu() {
    add_menu_page(esc_html__('Theme Dashboard', 'plaxer'), esc_html__('Plaxer Theme', 'plaxer'), 'manage_options', 'plaxer_dashboard', array($this, 'render'), 'dashicons-art', 2);
  }

  public function render() {
    if (current_user_can('manage_options')) {
      $info = array(
        'supported_until' => 0
      );
      if(class_exists('YPRM_Verification')) {
        $info  = YPRM_Verification::get_info();
      }
      if(isset($info['supported_until']) && !empty($info['supported_until'])) {
        $status = strtotime($info['supported_until']) < strtotime(date(DATE_RSS));
      } else {
        $status = true;
      }
    ?>
    <div class="yprm-main-row yprm-dashboard">
      <h1 class="yprm-heading"><?php echo esc_html__('Plaxer Dashboard', 'plaxer') ?></h1>
      <div class="row yprm-dashicons">
        <div class="col-12 col-sm-4">
          <div class="yprm-dashicon-item<?php echo esc_html($status ? ' with-error' : ''); ?>">
            <i class="admin-ui-customer-service"></i>
            <div class="content">
              <div class="title"><?php echo esc_html__('Support status ', 'plaxer').($status ? __('<span>Expired</span>', 'plaxer') : __('<span>Active</span>', 'plaxer')) ?></div>
              <?php if(isset($info['supported_until']) && !empty($info['supported_until'])) { ?>
                <div class="date"><?php echo esc_html__('to ', 'plaxer').mysql2date('F j, Y', $info['supported_until']) ?></div>
              <?php } ?>
            </div>
            <a href="https://themeforest.net/item/plaxer-gaming-and-esports-wordpress-theme/25318231" target="_blank"></a>
          </div>
        </div>
        <div class="col-12 col-sm-4">
          <div class="yprm-dashicon-item">
            <i class="admin-ui-manual"></i>
            <div class="content">
              <div class="title"><?php echo esc_html__('Documentation', 'plaxer') ?></div>
              <div class="sub-t"><?php echo esc_html__('Click to view', 'plaxer') ?></div>
            </div>
            <a href="https://promo-theme.com/plaxer/docs/" target="_blank"></a>
          </div>
        </div>
        <div class="col-12 col-sm-4">
          <div class="yprm-dashicon-item">
            <i class="admin-ui-paper-plane"></i>
            <div class="content">
              <div class="title"><?php echo esc_html__('Technical Support', 'plaxer') ?></div>
              <div class="sub-t"><?php echo esc_html__('Click to contact', 'plaxer') ?></div>
            </div>
            <a href="https://themeforest.net/item/plaxer-gaming-and-esports-wordpress-theme/25318231/support" target="_blank"></a>
          </div>
        </div>
      </div>
      <div class="row">
        <?php if(class_exists('YPRM_Verification')) { ?>
          <div class="col-12 col-md-6"><?php echo self::validation_form() ?></div>
        <?php } ?>
        <div class="col-12 col-md-6"><?php echo self::server_info() ?></div>
      </div>
    </div>
    <?php
    }
  }

  public function server_info() {
    $post_max_size = wp_convert_hr_to_bytes(ini_get('post_max_size'));
    $max_execution_time = ini_get('max_execution_time');

    $array = array(
      array(
        'label' => esc_html__('PHP Version', 'plaxer'),
        'status' => version_compare(phpversion(), '7.0', '>'),
        'value' => phpversion(),
        'default' => '7.0'
      ),
      array(
        'label' => esc_html__('PHP Post_Max_Size', 'plaxer'),
        'status' => $post_max_size >= 33554432,
        'value' => ini_get('post_max_size'),
        'default' => '32M'
      ),
      array(
        'label' => esc_html__('Max_Execution_Time', 'plaxer'),
        'status' => $max_execution_time >= 120,
        'value' => $max_execution_time,
        'default' => 120
      ),
      array(
        'label' => esc_html__('Max_Upload_Size', 'plaxer'),
        'status' => wp_convert_hr_to_bytes(ini_get('upload_max_filesize')) >= 33554432,
        'value' => ini_get('upload_max_filesize'),
        'default' => '32M'
      ),
    );

    ?>
    <div class="yprm-widget dark-style">
      <div class="title"><?php echo esc_html__('Server Info', 'plaxer') ?></div>
      <div class="yprm-server-info">
        <?php foreach($array as $item) { ?>
          <div class="item">
            <div class="label"><?php echo esc_html($item['label']) ?>:</div>
            <div class="value">
              <span class="status <?php echo esc_attr(($item['status']) ? 'good': 'bad') ?>">
                <i class="dashicons <?php echo esc_attr(($item['status']) ? 'admin-ui-confirm': 'admin-ui-close-button') ?>"></i>
              </span>
              <?php echo esc_html($item['value'].' / '.$item['default']).' '.esc_html__('(Recommend)', 'plaxer') ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php
  }

  public function validation_form() {
    ?>
    <div class="yprm-widget dark-style">
      <div class="title"><?php echo esc_html__('License Keys', 'plaxer') ?></div>
      <?php echo YPRM_Verification::validation_form(); ?>
    </div>
    <?php
  }
}


new YPRM_Admin_Pages();