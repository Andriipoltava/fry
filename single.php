<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('fry_theme_container_type');
?>

    <div class="wrapper pb-0" id="single-wrapper">


        <?php
        while (have_posts()) {
            the_post();
            the_content();

        }
        ?>


    </div><!-- #single-wrapper -->

<?php
get_footer();
