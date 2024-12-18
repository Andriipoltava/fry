<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;
$now = time();
$default_last_activity = $now - 300; // Default to 5 minutes ago if not set

if (is_user_logged_in()) {
    $last_activity = get_user_meta(get_current_user_id(), '_wc_last_activity', true);

    // If the last activity is not recent, update it
    if (empty($last_activity) || ($now - $last_activity) > 300) {
        update_user_meta(get_current_user_id(), '_wc_last_activity', $now);
        $last_activity = $now;
    }
} elseif (!is_user_logged_in()) {
    if (isset($_COOKIE['woocommerce_cart_last_activity'])) {
        $last_activity = $_COOKIE['woocommerce_cart_last_activity'];
    }
}

// Fallback to default if last activity is not set or invalid
if (empty($last_activity)) {
    $last_activity = $default_last_activity;
}

$remaining_time = 300;


$zones = WC_Shipping_Zones::get_zones();


do_action('woocommerce_before_mini_cart'); ?>
<div id="shopping_cart" class="shopping_cart popup">

    <?php if (!WC()->cart->is_empty()) : ?>


        <div class="woocommerce-mini-cart cart_list order_info--wrap product_list_widget <?php echo esc_attr($args['list_class']); ?>">
            <?php wc_get_template(
                'cart/mini-cart-lists.php',

            ); ?>
        </div>
        <hr>
        <div class="shopping_cart--footer ">
            <div class="total_price woocommerce-mini-cart__total total">

                <?php
                /**
                 * Hook: woocommerce_widget_shopping_cart_total.
                 *
                 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
                 */
                do_action('woocommerce_widget_shopping_cart_total');
                ?>
            </div>
            <div class="buttons_wrap woocommerce-mini-cart__buttons buttons text-center pt-4">
                <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

                <?php do_action('woocommerce_widget_shopping_cart_buttons'); ?>

                <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>
            </div>
            <a href="#" class="resume_shop w-100 d-block text-center pt-2" data-bs-toggle="offcanvas"
               data-bs-target="#cartOffcanvas"
               aria-controls="cartOffcanvas"
               aria-expanded="false"><?php esc_html_e('Or continue shopping'); ?></a>
        </div>

    <?php else : ?>
        <div class="shopping_cart--footer">
            <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>
            <a href="#" class="resume_shop">Continue shopping</a>
        </div>
    <?php endif; ?>

    <?php do_action('woocommerce_after_mini_cart'); ?>
</div>
