<?php
if (!defined('ABSPATH')) {
  exit;
}
?>

<div class="wrap">
  <h1><?php _e('Checkout Offers - Settings', 'checkout-offers'); ?></h1>
  <form method="post" action="options.php">
    <?php
    settings_fields('checkout_offers_settings');
    do_settings_sections('checkout-offers-settings');
    submit_button(__('Save Settings', 'checkout-offers'));
    ?>
  </form>
</div>