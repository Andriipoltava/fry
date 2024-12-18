<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$bootstrap_version = get_theme_mod('fry_theme_bootstrap_version', 'bootstrap4');
$navbar_type = get_theme_mod('fry_theme_navbar_type', 'collapse');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php fry_theme_body_attributes(); ?>>
<?php do_action('wp_body_open'); ?>
<div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <header id="wrapper-navbar"
            class="top-0 w-100 <?php echo is_front_page() ? 'position-fixed text-white' : 'position-sticky' ?>">

        <a class="skip-link <?php echo fry_theme_get_screen_reader_class(true); ?>" href="#content">
            <?php esc_html_e('Skip to content', 'fry_theme'); ?>
        </a>

        <?php get_template_part('global-templates/navbar', 'offcanvas-bootstrap5'); ?>

    </header><!-- #wrapper-navbar -->
