<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('fry_theme_container_type');
?>

<?php if (is_home()) : ?>

        <div class="container-fluid">
            <div class="row shop-page">
                <div class="col-lg-12 pt-4 pb-5">

                    <?php echo "<h1 class='h2 pt-3 pb-3  lh-1' > ".get_queried_object()->post_title."</h1>"; ?>
                    <?php woocommerce_breadcrumb(); ?>

                </div>
            </div>

        </div>


<?php endif; ?>

    <div class="wrapper" id="index-wrapper">

        <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">


            <main class="site-main row gy-4 py-4" id="main">

                <?php
                wp_reset_postdata();
                wp_reset_query();
                if (have_posts()) {
                    // Start the Loop.
                    while (have_posts()) {
                        the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('loop-templates/content', get_post_format());
                    }
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>

            </main>

            <?php
            // Display the pagination component.
            fry_theme_pagination();

            ?>


        </div><!-- #content -->

    </div><!-- #index-wrapper -->

<?php
get_footer();
