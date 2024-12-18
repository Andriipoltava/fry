<?php

// First unhook the WooCommerce content wrappers.
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
//add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 10 );

//remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Then hook in your own functions to display the wrappers your theme requires.
add_action('woocommerce_before_main_content', 'biliboo_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'biliboo_woocommerce_wrapper_end', 10);

if (!function_exists('biliboo_woocommerce_wrapper_start')) {
    /**
     * Display the theme specific start of the page wrapper.
     */
    function biliboo_woocommerce_wrapper_start()
    {
        global $product;

        echo '<div  id="product-' . get_the_ID() . '" class="' . esc_attr(implode(' ', wc_get_product_class('', get_the_ID()))) . '">';

    }
}

if (!function_exists('biliboo_woocommerce_wrapper_end')) {
    /**
     * Display the theme specific end of the page wrapper.
     */
    function biliboo_woocommerce_wrapper_end()
    {

        echo '</div><!-- #woocommerce-wrapper -->';
    }
}

add_filter('woocommerce_single_product_image_gallery_classes', function ($class) {

    return array_merge($class, ['product_gallery']);
}, 98);
add_filter('woocommerce_product_price_class', function ($class) {

    return 'product_price ';

}, 98);

add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

//remove meta
//remove_action( 'woocommerce_single_product_summary', "woocommerce_template_single_meta", 40 );
////remove related products
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
//

function woo_remove_product_tabs($tabs)
{
    unset($tabs['description']);          // Remove the description tab
    unset($tabs['reviews']);          // Remove the reviews tab
    unset($tabs['additional_information']);   // Remove the additional information tab
    return $tabs;
}

function woocommerce_template_product_gallery()
{
    wc_get_template('single-product/gallery.php');
}

add_action('woocommerce_after_single_product_summary', 'woocommerce_template_product_gallery', 40);


function woocommerce_template_product_accordion()
{
    wc_get_template('single-product/accordion.php');
}

add_action('woocommerce_single_product_summary', 'woocommerce_template_product_accordion', 55);


function woocommerce_template_product_scroll_navbar()
{
    if (is_product()) {
        wc_get_template('single-product/scroll-navbar.php');
    }
}


add_action('woocommerce_before_main_content', 'woocommerce_template_product_scroll_navbar', 55);


//