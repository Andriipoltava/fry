<?php
/**
 * Template Name: Full Width Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('fry_theme_container_type');


?>


    <main class="site-main" id="main" role="main">

        <?php
        while (have_posts()) {
            the_post();
            get_template_part('loop-templates/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        }
        ?>

    </main>


<?php
get_footer();
