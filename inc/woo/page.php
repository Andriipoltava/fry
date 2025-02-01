<?php


add_filter('woocommerce_product_get_price', function ($price) {

    return 1;
});
add_filter('woocommerce_get_regular_price', function ($price) {

//    var_dump($price);
    return 1;
});
add_filter('wc_price', function ($price) {

    return '';
});
add_filter('woocommerce_hide_invisible_variations', function ($price) {

    return false;
});
function priceWOO($price)
{

    return 1;
}

add_filter('woocommerce_empty_price_html', 'priceWOO');
add_filter('woocommerce_show_variation_price', 'priceWOO');
add_filter('woocommerce_product_get_price', 'priceWOO');
add_filter('woocommerce_product_variation_get_price', 'priceWOO');
add_filter('woocommerce_get_regular_price', 'priceWOO');
add_filter('woocommerce_get_price', 'priceWOO');
add_filter('woocommerce_variation_prices_price', 'priceWOO');
add_filter('woocommerce_variation_prices_regular_price', 'priceWOO');

// Remove default WooCommerce wrappers
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove unnecessary actions
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// Add custom theme-specific wrappers
add_action('woocommerce_before_main_content', 'biliboo_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'biliboo_woocommerce_wrapper_end', 10);

if (!function_exists('biliboo_woocommerce_wrapper_start')) {
    /**
     * Theme-specific wrapper start
     */
    function biliboo_woocommerce_wrapper_start() {
        echo '<div id="product-' . get_the_ID() . '" class="' . esc_attr(implode(' ', wc_get_product_class('', get_the_ID()))) . '">';
    }
}

if (!function_exists('biliboo_woocommerce_wrapper_end')) {
    /**
     * Theme-specific wrapper end
     */
    function biliboo_woocommerce_wrapper_end() {
        echo '</div><!-- #woocommerce-wrapper -->';
    }
}

// Custom classes for single product image gallery
add_filter('woocommerce_single_product_image_gallery_classes', function ($class) {
    return array_merge($class, ['product_gallery', 'd-md-block', 'd-none']);
}, 98);

// Custom price class for products
add_filter('woocommerce_product_price_class', function () {
    return 'product_price';
}, 98);

// Remove default WooCommerce product tabs
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);
function woo_remove_product_tabs($tabs) {
    unset($tabs['description']);            // Remove description tab
    unset($tabs['reviews']);                 // Remove reviews tab
    unset($tabs['additional_information']);  // Remove additional information tab
    return $tabs;
}

// Custom mobile image gallery
add_action('woocommerce_single_product_summary', 'woo_product_page_image_in_mobile', 13);
function woo_product_page_image_in_mobile() {
    global $product;
    $image_ids = array_merge([$product->get_image_id()], $product->get_gallery_image_ids()); ?>

    <div class="d-md-none swiper swiper-mobile-product">
        <div class="swiper-wrapper">
            <?php foreach ($image_ids as $image_id): ?>
                <div class="swiper-slide">
                    <?php echo wp_get_attachment_image($image_id, 'square-500', false, ['class' => 'w-100']); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination mt-2"></div>
    </div>
    <?php
}

add_filter('the_title', 'woo_the_title', 10, 2);
function woo_the_title($post_title, $post_id)
{

    return !is_admin() && get_field('custom_title', $post_id) ? get_field('custom_title', $post_id) : $post_title;

}

add_filter('woocommerce_dropdown_variation_attribute_options_args', function ($args) {

    global $product;

    $options = $args['options'];
    $product = $args['product'];
    $attribute = $args['attribute'];


    if (empty($options) && !empty($product) && !empty($attribute)) {
        $attributes = $product->get_variation_attributes();
        $options = $attributes[$attribute];
    }
    if (!empty($options)) {
        if ($product && taxonomy_exists($attribute)) {
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );
            if (!$args['selected']) {

                $args['selected'] = $terms[0]->slug ?? '';
            }
        }
    }
    return $args;
}, 999999);

// Custom bottom description for taxonomy pages
add_action('woocommerce_after_main_content', 'woo_bottom_description_arch');
function woo_bottom_description_arch() {
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy ?? null;
    $term_id = $queried_object->term_id ?? null;

    if ($taxonomy && $term_id) {
        $bottom_description = get_field('bottom_description', "{$taxonomy}_{$term_id}");
        if ($bottom_description) {
            echo '<div class="container-fluid py-5 mt-lg-5 wp-block">' . $bottom_description . '</div>';
        }
    }
}

// Add product gallery inside accordion
add_action('woocommerce_after_single_product_summary', 'woocommerce_template_product_gallery', 40);
function woocommerce_template_product_gallery() {
    wc_get_template('single-product/gallery.php');
}

// Add custom accordion section
add_action('woocommerce_single_product_summary', 'woocommerce_template_product_accordion', 55);
function woocommerce_template_product_accordion() {
    wc_get_template('single-product/accordion.php');
}

// Add sticky scroll navbar for single product (disabled for now)
// add_action('woocommerce_before_main_content', 'woocommerce_template_product_scroll_navbar', 55);
function woocommerce_template_product_scroll_navbar() {
    if (is_product()) {
        // wc_get_template('single-product/scroll-navbar.php');
    }
}

