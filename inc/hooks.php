<?php
/**
 * Custom hooks
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('fry_theme_site_info')) {
    /**
     * Add site info hook to WP hook library.
     */
    function fry_theme_site_info()
    {
        do_action('fry_theme_site_info');
    }
}

add_action('fry_theme_site_info', 'fry_theme_add_site_info');
if (!function_exists('fry_theme_add_site_info')) {
    /**
     * Add site info content.
     */
    function fry_theme_add_site_info()
    {
        $the_theme = wp_get_theme();

        $site_info = sprintf(
            '<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
            esc_url(__('https://wordpress.org/', 'fry_theme')),
            sprintf(
            /* translators: WordPress */
                esc_html__('Proudly powered by %s', 'fry_theme'),
                'WordPress'
            ),
            sprintf(
            /* translators: 1: Theme name, 2: Theme author */
                esc_html__('Theme: %1$s by %2$s.', 'fry_theme'),
                $the_theme->get('Name'),
                '<a href="' . esc_url(__('https://fry_theme.com', 'fry_theme')) . '">fry_theme.com</a>'
            ),
            sprintf(
            /* translators: Theme version */
                esc_html__('Version: %s', 'fry_theme'),
                $the_theme->get('Version')
            )
        );

        // Check if customizer site info has value.
        if (get_theme_mod('fry_theme_site_info_override')) {
            $site_info = get_theme_mod('fry_theme_site_info_override');
        }

        echo apply_filters('fry_theme_site_info_content', $site_info); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
}




/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add WC classes if on a custom template or when viewing search results */
    $classes[] = 'woocommerce woocommerce-page';

    return array_filter($classes);
});

//add_filter('yith_wcan_should_filter', 'fix_search_page_template', 10, 1);
//
//
//function fix_search_page_template($url)
//{
//
//    if (isset($_GET['s'])) {
//        global $wp_query;
////        $url = false;
//    }
//
//    return $url;
//}

add_action( 'template_redirect', 'no_products_found_redirect' );
function no_products_found_redirect() {
    global $wp_query;

    if( isset($_GET['s']) && ! empty($wp_query) && $wp_query->post_count > 0 && is_search()&& !is_shop() ) {
//        wp_safe_redirect( get_permalink(  ).'?'.http_build_query($_GET) );
//        exit();
    }
}
// Only show products in the front-end search results
add_filter('pre_get_posts','lw_search_filter_pages');
function lw_search_filter_pages($query) {
    // Frontend search only
    if ( ! is_admin() && $query->is_search() ) {
        $query->set('post_type', 'product');
        $query->set( 'wc_query', 'product_query' );
    }
    return $query;
}