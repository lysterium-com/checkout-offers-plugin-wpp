<?php

/**
 * @package CheckoutOffers
 * Plugin Name: Checkout offers
 * Description: Plugin to add checkout offers
 * Author: Raphael Serafim
 * Author URI: https://github.com/raphaelvserafim
 * Version: 1.0.0
 */


require_once ABSPATH . 'wp-admin/includes/upgrade.php';



if (!defined("ABSPATH")) {
  exit;
}


include_once plugin_dir_path(__FILE__) . 'includes/class-checkout-offers.php';



$checkoutOffers = new CheckoutOffers();
$checkoutOffers->init("https://checkout-offers-admin.placidas.com");