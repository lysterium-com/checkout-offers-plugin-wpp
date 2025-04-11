<?php

/**
 * @package  CheckoutOffers
 */

class CheckoutOffers
{

  public $db;
  public string $prefix;
  public string $charsetCollate;

  public function __construct()
  {
    global $wpdb;
    $this->db = $wpdb;
    $this->prefix = $wpdb->prefix;
    $this->charsetCollate = $wpdb->get_charset_collate();
  }
  public function init($url)
  {
    $this->registerSettings();
    $this->includeScripts($url);
    $this->menu();
  }




  public function addQueryVars($vars)
  {
    $vars[] = 'wame-webhook';
    return $vars;
  }


  private function menu()
  {
    add_action('admin_menu', function () {
      add_menu_page(
        'Checkout Offers',
        'Checkout Offers',
        'manage_options',
        'checkout-offers-settings',
        [$this, 'menuPageContent'],
        'dashicons-embed-photo',
        20
      );
    });
  }


  private function includeScripts($url)
  {
    add_action('wp', function () use ($url) {
      if (
        function_exists('is_checkout') &&
        is_checkout() &&
        isset($_GET['key'])
      ) {
        add_action('wp_footer', function () use ($url) {
          $key = get_option('checkout_offers_key', '');
          if (!empty($key)) {
            echo sprintf(
              '<script src="%s/ad.js" data-key="%s"></script>',
              esc_url($url),
              esc_attr($key)
            );
          }
        });
      }
    });
  }




  public function menuPageContent()
  {
    include_once plugin_dir_path(__FILE__) . 'settings-page.php';

  }

  private function registerSettings()
  {
    add_action('admin_init', function () {
      register_setting('checkout_offers_settings', 'checkout_offers_key');

      add_settings_section(
        'checkout_offers_main_section',
        'API Key Configuration',
        function () {
          echo '<p>Please enter the key used for integration.</p>';
        },
        'checkout-offers-settings'
      );

      add_settings_field(
        'checkout_offers_key_field',
        'API Key',
        function () {
          $value = get_option('checkout_offers_key', '');
          echo '<input type="text" name="checkout_offers_key" value="' . esc_attr($value) . '" class="regular-text">';
        },
        'checkout-offers-settings',
        'checkout_offers_main_section'
      );
    });
  }
}