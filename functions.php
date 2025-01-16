<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// UnderStrap's includes directory.
$fry_theme_inc_dir = 'inc';

// Array of files to include.
$fry_theme_includes = array(
    '/theme-settings.php',                  // Initialize theme default settings.
    '/setup.php',                           // Theme setup and custom theme supports.
    '/widgets.php',                         // Register widget area.
    '/enqueue.php',                         // Enqueue scripts and styles.
    '/template-tags.php',                   // Custom template tags for this theme.
    '/pagination.php',                      // Custom pagination for this theme.
    '/hooks.php',                           // Custom hooks.
    '/extras.php',                          // Custom functions that act independently of the theme templates.
    '/customizer.php',                      // Customizer additions.
    '/custom-comments.php',                 // Custom Comments file.
    '/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/fry_theme/fry_theme/issues/567.
    '/class-mobile-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/fry_theme/fry_theme/issues/567.
    '/New_Walker_Nav_Menu.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/fry_theme/fry_theme/issues/567.
    '/editor.php',                          // Load Editor functions.
    '/block-editor.php',                    // Load Block Editor functions.
    '/deprecated.php',                      // Load deprecated functions.

);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
    $fry_theme_includes[] = '/woocommerce.php';
}



// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
    $fry_theme_includes[] = '/jetpack.php';
}// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
    $fry_theme_includes[] = '/jetpack.php';
}
// Load ACF compatibility file if Jetpack is activiated.
if (true) {
    $fry_theme_includes[] = '/acf.php';
}

// Include files.
foreach ($fry_theme_includes as $file) {
    require_once get_theme_file_path($fry_theme_inc_dir . $file);
}


function tt3child_register_acf_blocks()
{
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type(__DIR__ . '/blocks/testimonial');
    register_block_type(__DIR__ . '/blocks/hero');
    register_block_type(__DIR__ . '/blocks/hero-only-title');
    register_block_type(__DIR__ . '/blocks/carousel');
    register_block_type(__DIR__ . '/blocks/carousel-gallery');
    register_block_type(__DIR__ . '/blocks/top-banner');
    register_block_type(__DIR__ . '/blocks/two-card-banner');
    register_block_type(__DIR__ . '/blocks/news-banner');
    register_block_type(__DIR__ . '/blocks/about');
    register_block_type(__DIR__ . '/blocks/only-title');
    register_block_type(__DIR__ . '/blocks/history-banner');
    register_block_type(__DIR__ . '/blocks/single-template');
    register_block_type(__DIR__ . '/blocks/content-image-banner');
}

// Here we call our tt3child_register_acf_block() function on init.
add_action('init', 'tt3child_register_acf_blocks');


add_filter('wpcf7_autop_or_not', '__return_false');


add_filter('woocommerce_product_get_price', function ($price) {

//    var_dump($price);
    return 1;
});
add_filter('woocommerce_get_regular_price', function ($price) {

//    var_dump($price);
    return 1;
});
add_filter('wc_price', function ($price) {

//    var_dump($price);
    return '';
});
add_filter('woocommerce_hide_invisible_variations', function ($price) {

//    var_dump($price);
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

/* language dropdown */

//add_filter( 'current_theme_supports-wc-product-gallery-zoom', '__return_false' );
//add_filter( 'current_theme_supports-wc-product-gallery-slider', '__return_false' );
//add_filter( 'current_theme_supports-wc-product-gallery-lightbox', '__return_false' );

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
}, 99);