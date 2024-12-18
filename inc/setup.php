<?php
/**
 * Theme basic setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Set the content width based on the theme's design and stylesheet.
if (!isset($content_width)) {
    $content_width = 640; /* pixels */
}

add_action('after_setup_theme', 'fry_theme_setup');

if (!function_exists('fry_theme_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function fry_theme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on fry_theme, use a find and replace
         * to change 'fry_theme' to the name of your theme in all the template files
         */
        load_theme_textdomain('fry_theme', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => __('Header Menu', 'fry_theme'),
                'mobile' => __('Mobile Menu', 'fry_theme'),
                'footer_col_1' => __('Footer Column 1 Menu', 'fry_theme'),
                'footer_col_2' => __('Footer Column 2 Menu', 'fry_theme'),
                'footer_col_3' => __('Footer Column 3 Menu', 'fry_theme'),
                'footer_col_4' => __('Footer Column 4 Menu', 'fry_theme'),
                'footer_copyright' => __('Footer Copyright Menu', 'fry_theme'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            )
        );

        /*
         * Adding Thumbnail basic support
         */
        add_theme_support('post-thumbnails');

        /*
         * Adding support for Widget edit icons in customizer
         */
        add_theme_support('customize-selective-refresh-widgets');

        /*
         * Enable support for Post Formats.
         * See https://wordpress.org/support/article/post-formats/
         */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'fry_theme_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Set up the WordPress Theme logo feature.
        add_theme_support('custom-logo');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');


        add_image_size('square-500', 500, 500, true);


        // Check and setup theme default settings.
        fry_theme_setup_theme_default_settings();

    }
}
