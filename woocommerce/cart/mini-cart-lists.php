<?php
do_action('woocommerce_before_mini_cart_contents');

foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
        /**
         * This filter is documented in woocommerce/templates/cart/cart.php.
         *
         * @since 2.1.0
         */
        $product_name = $_product->get_title();
        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
        $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
        ?>
        <div class="woocommerce-mini-cart-item order_info row <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">

            <div class="left_side col-4">
                <div class="item_img">
                    <?php if (empty($product_permalink)) : ?>
                        <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url($product_permalink); ?>">
                            <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                    <?php endif; ?>

                </div>
                <div class="item_text">


                </div>
            </div>
            <div class="count_item--wrap col-8">
                <h5 class="item_text_title">
                    <?php if (empty($product_permalink)) : ?>
                        <?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <?php else : ?>
                        <a class="text-decoration-none" href="<?php echo esc_url($product_permalink); ?>">
                            <?php echo $product_name; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                    <?php endif; ?>
                </h5>
                <?php if ($_product->get_attributes()) {
                    $array = [];
                    foreach ($_product->get_attributes() as $key => $value) {
                        if (is_string($value)) $array[] = $value;
                    }
                    echo ' <span>' . implode(', ', $array) . '</span>';
                }
                ?>
                <div class="count_item">
                    <?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) . '</span>', $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                </div>
                <?php
                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                        '<a href="%s" class=" remove_from_cart_button d-flex flex-nowrap align-items-center" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><svg width="20" height="20" class="icon icon--remove me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.8 14.2">
  <title>Remove - Trash Can</title>
  <path d="m12.8,2.5h-3.3v-1c0-.83-.67-1.5-1.5-1.5h-3.2c-.83,0-1.5.67-1.5,1.5v1H0v1.4h1.7v10.3h9.4V3.9h1.7v-1.4Zm-8.1-1c0-.06.04-.1.1-.1h3.2c.06,0,.1.04.1.1v1h-3.4v-1Zm5,11.3H3.1V3.9h6.6v8.9Z"></path>
  <rect x="7.1" y="4.7" width="1.2" height="7.2"></rect>
  <rect x="4.4" y="4.7" width="1.2" height="7.2"></rect>
</svg>Remove</a>',
                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                        /* translators: %s is the product name */
                        esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                        esc_attr($product_id),
                        esc_attr($cart_item_key),
                        esc_attr($_product->get_sku())
                    ),
                    $cart_item_key
                );
                ?>

            </div>


            <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
        <?php
    }
}

do_action('woocommerce_mini_cart_contents');
?>