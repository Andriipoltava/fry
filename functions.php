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
}, 999999);

add_action('wp_ajax_fry_theme_loadmore', 'fry_theme_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_fry_theme_loadmore', 'fry_theme_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}

function fry_theme_loadmore_ajax_handler()
{

    // prepare our arguments for the query
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = (int)$_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    ob_start();
    // it is always better to use WP_Query but not here
    query_posts($args);

    if (have_posts()) :

        // run the loop
        while (have_posts()): the_post();

            do_action('woocommerce_shop_loop');
            wc_get_template_part('content', 'product');

        endwhile;

    endif;
    global $wp_query;
    $total = count($wp_query->posts);

    $html = ob_get_clean();

     wp_send_json(
        [
            'html' => $html,
            'curren_total' => $total,
        ]
    );
}

function filter_btn_show_hide()
{
    ?>

    <button class="border-0 bg-transparent hide-filter d-flex align-items-center ">
        <svg class="icon icon--filter me-2" width="16" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 10 8">
            <title>Filter</title>
            <path d="M9.5,1.2H8.7C8.5,0.5,7.8,0,7,0S5.5,0.5,5.3,1.2H0.5C0.2,1.2,0,1.5,0,1.8s0.2,0.5,0.5,0.5h4.8C5.5,3,6.2,3.5,7,3.5
  c0.8,0,1.5-0.5,1.7-1.2h0.8C9.8,2.2,10,2,10,1.8S9.8,1.2,9.5,1.2z M7,2.5c-0.4,0-0.8-0.3-0.8-0.8S6.6,1,7,1s0.8,0.3,0.8,0.8
  S7.4,2.5,7,2.5z"></path>
            <path d="M9.5,5.8H4.7C4.5,5,3.8,4.5,3,4.5C2.2,4.5,1.5,5,1.3,5.8H0.5C0.2,5.8,0,6,0,6.2s0.2,0.5,0.5,0.5h0.8C1.5,7.5,2.2,8,3,8
  s1.5-0.5,1.7-1.2h4.8c0.3,0,0.5-0.2,0.5-0.5S9.8,5.8,9.5,5.8z M3,7C2.6,7,2.2,6.7,2.2,6.2S2.6,5.5,3,5.5s0.8,0.3,0.8,0.8S3.4,7,3,7z
  "></path>
        </svg>
        <span class="hide-t"><?php echo esc_html__('Show Filters', 'fry_theme'); ?></span>
        <span class="show-t"><?php echo esc_html__('Hide Filters', 'fry_theme'); ?></span>
    </button>
    <?php
}

function getNounForm(int $number, string $nominativeSingular, string $nominativePlural, string $genitivePlural): string
{
    // Get the last two digits to handle cases like 11, 21, etc.
    $lastTwoDigits = $number % 100;
    $lastDigit = $number % 10;

    // Check if the last two digits are in the range 11-19 (always genitive plural)
    if ($lastTwoDigits >= 11 && $lastTwoDigits <= 19) {
        return $genitivePlural;
    }

    // Determine the form based on the last digit
    switch ($lastDigit) {
        case 1:
            return $nominativeSingular;
        case 2:
        case 3:
        case 4:
            return $nominativePlural;
        default:
            return $genitivePlural;
    }
}


add_shortcode('yith-woocommerce-ajax-product-filter-label', function () {

    if (class_exists('YITH_WCAN_Query')) {
        $yith = new YITH_WCAN_Query;
        $active_filters = $yith->get_active_filters('view');

        if ($active_filters) {
            ?>
            <div class="yith-wcan-active-filters custom-style enhanced">
                <div class="yith-wcan-active-filtersno-titles <?php echo 'custom' === yith_wcan_get_option('yith_wcan_filters_style', 'default') ? 'custom-style' : ''; ?>">

                    <?php do_action('yith_wcan_before_active_filters'); ?>

                    <?php if (!empty($labels_heading) && !empty($active_filters)) : ?>
                        <h4><?php echo esc_html($labels_heading); ?></h4>
                    <?php endif; ?>

                    <?php foreach ($active_filters as $filter => $options) : ?>
                        <?php
                        if (empty($options['values'])) :
                            continue;
                        endif;
                        ?>
                        <div class="active-filter">

                            <?php foreach ($options['values'] as $value) : ?>
                                <a
                                        href="<?php echo esc_url(YITH_WCAN_Query()->get_filter_url(array(), $value['query_vars'])); ?>"
                                    <?php yith_wcan_add_rel_nofollow_to_url(true, true); ?>
                                        class="active-filter-label"
                                        data-filters="<?php echo esc_attr(wp_json_encode($value['query_vars'])); ?>"
                                >
                                    <?php echo wp_kses_post($value['label']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
    return ob_get_clean();
});

add_filter('body_class', function ($classes) {
    if (is_tax()) { // Check if it's a taxonomy page
        $term = get_queried_object(); // Get the current taxonomy term object
        if (isset($term->parent) && $term->parent > 0) { // Check if the term has a parent
            $classes[] = 'sub-tax'; // Add a custom class for sub-taxonomy
        } else {
            $classes[] = 'parent-tax'; // Add a class for parent taxonomy
        }
    }
    return $classes;
});