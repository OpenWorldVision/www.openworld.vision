<?php
/**
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/tgm/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'plaxer_register_required_plugins');

function plaxer_register_required_plugins() {

  $plugins = array(
    array(
      'name' => esc_html__('TinyMCE Advanced', 'plaxer'),
      'slug' => 'tinymce-advanced',
      'required' => true,
    ),
    array(
      'name' => esc_html__('Contact Form 7', 'plaxer'),
      'slug' => 'contact-form-7',
      'required' => true,
    ),
    array(
      'name' => esc_html__('Advanced Custom Fields', 'plaxer'),
      'slug' => 'advanced-custom-fields',
      'required' => true,
    ),
    array(
      'name' => esc_html__('Black Studio TinyMCE Widget', 'plaxer'),
      'slug' => 'black-studio-tinymce-widget',
      'required' => true,
    ),
    array(
      'name' => esc_html__('Redux Framework', 'plaxer'),
      'slug' => 'redux-framework',
      'required' => true,
    ),
    array(
      'name' => esc_html__('Unyson', 'plaxer'),
      'slug' => 'unyson',
      'required' => true,
    ),
    array(
      'name' => esc_html__('GDPR Cookie Consent', 'plaxer'),
      'slug' => 'cookie-law-info',
    ),
    array(
      'name' => esc_html__('WP User Avatar', 'plaxer'),
      'slug' => 'wp-user-avatar',
    ),
    array(
      'name' => esc_html__('Woocommerce', 'plaxer'),
      'slug' => 'woocommerce',
    ),
    array(
      'name' => esc_html__('Mailchimp for WordPress', 'plaxer'),
      'slug' => 'mailchimp-for-wp',
    ),
  );

  if (function_exists('curl_init')) {
    $ch = curl_init('http://updates.promo-theme.com/manifest.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $file = curl_exec($ch);
    curl_close($ch);
    
    $plugins_array = json_decode($file, true);

    if (is_array($plugins_array['plaxer'])) {
      foreach ($plugins_array['plaxer'] as $item) {
        array_push($plugins, $item);
      }
    }
  }

  $config = array(
    'id' => 'tgmpa',
    'default_path' => '',
    'menu' => 'tgmpa-install-plugins',
    'parent_slug' => 'themes.php',
    'capability' => 'edit_theme_options',
    'has_notices' => true,
    'dismissable' => true,
    'dismiss_msg' => '',
    'is_automatic' => true,
    'message' => '',
  );

  tgmpa($plugins, $config);
}