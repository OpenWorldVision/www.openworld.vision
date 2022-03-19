<?php

class YPRM_Verification {
  public static $verify_url = 'http://promo-theme.com/plaxer/lic_index.php';

  public function __construct() {
    add_option('enable_full_version');
    add_option('envato_purchase_code');
    add_action('wp_ajax_validation_code', array($this, 'validation_ajax'));
  }

  public static function validation_form($next_link = '') {
    $value = '';
    if (get_option('envato_purchase_code')) {
      $value = get_option('envato_purchase_code');
    }
    self::is_activated();
    ?>
    <form class="yprm-validation-form yprm-form" action="validation_code" data-next-link="<?php echo esc_url($next_link) ?>">
      <div class="yprm-input-row<?php echo !empty($value) ? ' is-ok' : '' ?>">
        <div class="label"><?php echo esc_html__('Envato Purchase Code', 'plaxer') ?></div>
        <input type="text" class="yprm-input required" name="envato-purchase-code" placeholder="<?php echo esc_html__('Enter Envato Purchase Code', 'plaxer') ?>" value="<?php echo esc_attr($value) ?>">
      </div>
      <div class="yprm-log-massage"></div>
      <div class="yprm-buttons">
        <button class="yprm-button submit register<?php echo $value ? ' hide': ''; ?>">
          <span><?php echo esc_html__('Register Code', 'plaxer') ?></span>
        </button>
        <button class="yprm-button deregister<?php echo !$value ? ' hide': ''; ?>">
          <span><?php echo esc_html__('Deregister Code', 'plaxer') ?></span>
        </button>
        <?php if($next_link) { ?>
          <a href="<?php echo esc_url($next_link) ?>" class="yprm-button next">
            <span><?php echo esc_html__('Next Step', 'plaxer') ?></span>
          </a>
        <?php } ?>
      </div>
      <?php if(!empty($value) && FALSE) { ?>
        <div class="yprm-message is-ok"><?php echo esc_html__('Your theme is activated.', 'plaxer') ?></div>
      <?php } else { ?>
        <div class="yprm-message"><?php echo esc_html__('You can register one license per one website.', 'plaxer') ?></div>
      <?php } ?>
    </form>
  <?php }

  public static function validation_ajax() {
    echo self::is_activated($_POST['envato_purchase_code'], $_POST['removed_status'], 'echo');

    wp_die();
  }

  public static function get_info() {
    if (get_option('envato_purchase_code')) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, self::$verify_url . '?p_code=' . get_option('envato_purchase_code'));
      ob_start();
      curl_exec($ch);
      $output = ob_get_clean();
      curl_close($ch);

      $output = json_decode($output, true);

      return $output;
    }
  }

  public static function is_activated($code_to_verify = '', $verify = 0, $return = '') {
    
    if(empty($code_to_verify)) {
      if(get_option('envato_purchase_code')) {
        $code_to_verify = get_option('envato_purchase_code');
      } else {
        return false;
      }
    }

    $path = $_SERVER['HTTP_HOST'];
    $agent = base64_encode($_SERVER['HTTP_USER_AGENT']);
    $email = trim(wp_get_current_user()->data->user_email, ' ');

    if (function_exists('curl_version') && !empty($code_to_verify)) {
      $ch = curl_init();
      $url = self::$verify_url . '?p_code=' . $code_to_verify . '&path=' . $path . '&email=' . $email . '&removed_status=' . $verify . '&agent=' . $agent;
      $url = str_replace(' ', '', $url);
      curl_setopt($ch, CURLOPT_URL, $url);

      ob_start();
      curl_exec($ch);
      $output = ob_get_clean();
      if(!empty($return)) {
        echo $output;
      }
      $output = json_decode($output, true);
      curl_close($ch);

      if ($output['result'] == 'access_success') {
        if (!get_option('envato_purchase_code')) {
          update_option('envato_purchase_code', $code_to_verify);
        }
        if (!get_option('enable_full_version')) {
          update_option('enable_full_version', 1);
        }
      } else if(($output['result'] == 'access_denied' && $output['reason'] != 'db_error') || $output['result'] == 'remove_success') {
        update_option('envato_purchase_code', '');
        update_option('enable_full_version', 0);
      }

      if(empty($return)) {
        return $output;
      }
    }
  }
}

new YPRM_Verification();