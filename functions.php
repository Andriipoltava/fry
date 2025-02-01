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

