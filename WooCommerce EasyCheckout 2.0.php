<?php
/*
Plugin Name: WooCommerce EasyCheckout 2.0
Description: Hide billing fields for virtual and downloadable products.
Version: 2.0
Author: Samuel Barden
Author URI: https://samuelbarden.com
*/

// Check if the cart contains any physical product
function wce_cart_contains_physical_product() {
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data'];
        if (!$product->is_virtual() && !$product->is_downloadable()) {
            return true;
        }
    }
    return false;
}

// Conditionally hide billing fields
function wce_hide_billing_fields_for_virtual_downloadable_products($fields) {
    if (!wce_cart_contains_physical_product()) {
        $hidden_fields = get_option('wce_hidden_fields', array());
        foreach ($hidden_fields as $field => $enabled) {
            if ($enabled) {
                unset($fields['billing'][$field]);
            }
        }
    }
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'wce_hide_billing_fields_for_virtual_downloadable_products', 999);

// Create the settings page
function wce_register_settings_page() {
    add_options_page('WooCommerce EasyCheckout Settings', 'WooCommerce EasyCheckout', 'manage_options', 'wce-easycheckout', 'wce_settings_page');
}
add_action('admin_menu', 'wce_register_settings_page');

// Register settings
function wce_register_settings() {
    register_setting('wce-settings-group', 'wce_hidden_fields');
}
add_action('admin_init', 'wce_register_settings');

// Settings page HTML
function wce_settings_page() {
    ?>
    <div class="wrap">
        <h1>WooCommerce EasyCheckout Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('wce-settings-group'); ?>
            <?php do_settings_sections('wce-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Fields to Hide</th>
                    <td>
                        <label><input type="checkbox" name="wce_hidden_fields[billing_address_1]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_address_1'], true); ?> /> Address 1</label><br />
                        <label><input type="checkbox" name="wce_hidden_fields[billing_address_2]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_address_2'], true); ?> /> Address 2</label><br />
                        <label><input type="checkbox" name="wce_hidden_fields[billing_city]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_city'], true); ?> /> City</label><br />
                        <label><input type="checkbox" name="wce_hidden_fields[billing_postcode]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_postcode'], true); ?> /> Postcode</label><br />
                        <label><input type="checkbox" name="wce_hidden_fields[billing_country]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_country'], true); ?> /> Country</label><br />
                        <label><input type="checkbox" name="wce_hidden_fields[billing_state]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_state'], true); ?> /> State</label><br />
                        <label><input type="checkbox" name="wce_hidden_fields[billing_phone]" value="1" <?php checked(1, get_option('wce_hidden_fields')['billing_phone'], true); ?> /> Phone</label><br />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
?>
