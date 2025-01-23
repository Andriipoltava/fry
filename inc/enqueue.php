<?php
/**
 * Understrap enqueue scripts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('fry_theme_scripts')) {
    /**
     * Load theme's JavaScript and CSS sources.
     */
    function fry_theme_scripts()
    {
        // Get the theme data.
        $the_theme = wp_get_theme();
        $theme_version = time() ?: $the_theme->get('Version');
        $bootstrap_version = get_theme_mod('fry_theme_bootstrap_version', 'bootstrap5');
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $suffix = '';

        // Grab asset urls.
        $theme_styles = "/css/theme{$suffix}.css";
        $theme_scripts = "/js/theme{$suffix}.js";

        $css_version = $theme_version . '.' . filemtime(get_template_directory() . $theme_styles);
        wp_enqueue_style('fry_theme-styles', get_template_directory_uri() . $theme_styles, array(), $css_version);

        // Fix that the offcanvas close icon is hidden behind the admin bar.
        if ('bootstrap4' !== $bootstrap_version && is_admin_bar_showing()) {
            fry_theme_offcanvas_admin_bar_inline_styles();
        }

        wp_enqueue_script('jquery');

        $js_version = $theme_version . '.' . filemtime(get_template_directory() . $theme_scripts);
        wp_enqueue_script('fry_theme-scripts', get_template_directory_uri() . $theme_scripts, array(), $js_version, true);
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        global $wp_query;

        wp_localize_script(
            'fry_theme-scripts',
            'fry_theme_loadmore_params',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'posts' => json_encode( $wp_query->query_vars ),
                'current_page' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
                'max_page' => $wp_query->max_num_pages,
                'curren_total' => count($wp_query->posts),
            )
        );
    }
} // End of if function_exists( 'fry_theme_scripts' ).

add_action('wp_enqueue_scripts', 'fry_theme_scripts');

if (!function_exists('fry_theme_offcanvas_admin_bar_inline_styles')) {
    /**
     * Add inline styles for the offcanvas component if the admin bar is visible.
     *
     * Fixes that the offcanvas close icon is hidden behind the admin bar.
     *
     * @since 1.2.0
     */
    function fry_theme_offcanvas_admin_bar_inline_styles()
    {
        $navbar_type = get_theme_mod('fry_theme_navbar_type', 'collapse');
        if ('offcanvas' !== $navbar_type) {
            return;
        }

        $css = '
		body.admin-bar .offcanvas.show  {
			margin-top: 32px;
		}
		@media screen and ( max-width: 782px ) {
			body.admin-bar .offcanvas.show {
				margin-top: 46px;
			}
		}';
        wp_add_inline_style('fry_theme-styles', $css);
    }
}
