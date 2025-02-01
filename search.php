<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('fry_theme_container_type');

?>

    <div class="wrapper" id="search-wrapper">

        <div class="container-fluid" id="content" tabindex="-1">


            <main class="site-main main-content" id="main">

                <?php if (woocommerce_product_loop()) {
                    ?>

                    <header class="page-header pb-5 pt-4 pt-lg-5">

                        <h1 class="page-title h3">
                            <?php
                            printf(
                            /* translators: %s: query term */
                                __( 'Search Results for &#8220;%s&#8221;' ),
                                '<span>' . get_search_query() . '</span>'
                            );
                            ?>
                        </h1>

                    </header><!-- .page-header -->


                    <div class="offcanvas offcanvas-end " id="offcanvasFilter" aria-labelledby="offcanvasFilterLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasFilterLabel"><?php  echo esc_html__('Filter', 'fry_theme')?></h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <?php echo do_shortcode('[yith_wcan_filters slug="default-preset"]'); ?>
                            <div class="text-center">
                                <?php echo do_shortcode('[yith_wcan_reset_button]'); ?>
                            </div>
                        </div>
                    </div>


                    <div class="row g-4 pt-4 pt-lg-5">

                        <div class="col-lg-12 col-6  d-lg-none d-flex flex-wrap justify-content-between">


                        <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter"
                                    aria-controls="offcanvasFilter"
                                    class="border-0 bg-transparent hide-filter d-flex align-items-center">
                            <span><?php _e('Filter & Sort', 'fry_theme'); ?> </span>
                                <svg class="icon icon--filter ms-2" width="16" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 10 8">
                                    <title>Filter</title>
                                    <path d="M9.5,1.2H8.7C8.5,0.5,7.8,0,7,0S5.5,0.5,5.3,1.2H0.5C0.2,1.2,0,1.5,0,1.8s0.2,0.5,0.5,0.5h4.8C5.5,3,6.2,3.5,7,3.5
  c0.8,0,1.5-0.5,1.7-1.2h0.8C9.8,2.2,10,2,10,1.8S9.8,1.2,9.5,1.2z M7,2.5c-0.4,0-0.8-0.3-0.8-0.8S6.6,1,7,1s0.8,0.3,0.8,0.8
  S7.4,2.5,7,2.5z"></path>
                                    <path d="M9.5,5.8H4.7C4.5,5,3.8,4.5,3,4.5C2.2,4.5,1.5,5,1.3,5.8H0.5C0.2,5.8,0,6,0,6.2s0.2,0.5,0.5,0.5h0.8C1.5,7.5,2.2,8,3,8
  s1.5-0.5,1.7-1.2h4.8c0.3,0,0.5-0.2,0.5-0.5S9.8,5.8,9.5,5.8z M3,7C2.6,7,2.2,6.7,2.2,6.2S2.6,5.5,3,5.5s0.8,0.3,0.8,0.8S3.4,7,3,7z
  "></path>
                                </svg>

                            </button>
                        </div>
                        <div class="col-lg-4  d-lg-block d-none">

                            <?php filter_btn_show_hide(); ?>
                        </div>
                        <div class="col-lg-8 col-6 woocommerce_before_shop_loop d-flex justify-content-end  text-end">
                            <?php global $wp_query;
                            $not_singular = $wp_query->found_posts > 1 ? esc_html__('results', 'fry_theme'): esc_html__('result', 'fry_theme'); // if found posts is greater than one echo results(plural) else echo result (singular)
                            echo $wp_query->found_posts . " $not_singular " .esc_html__('found', 'fry_theme');;
                            ?>
                        </div>
                        <div class="col-12">
<!--                            --><?php //echo do_shortcode('[yith_wcan_active_filters_labels]'); ?>
                            <?php echo do_shortcode('[yith-woocommerce-ajax-product-filter-label]'); ?>
                        </div>
                    </div>
                    <div class="row  g-xxl-5 g-4  pt-4">
                        <div class="col-lg-4 col-xxl-3 filter-bar  d-lg-block d-none">
                            <?php echo do_shortcode('[yith_wcan_filters slug="default-preset"]'); ?>
                        </div>
                        <div class="col-lg-8 col-xxl-9 woo-loops">
                            <?php

                            woocommerce_product_loop_start();



                                while (have_posts()) {
                                    the_post();
                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     */
                                    do_action('woocommerce_shop_loop');

                                    wc_get_template_part('content', 'product');

                                }
                            woocommerce_product_loop_end();

                            ?>
                        </div>
                    </div>
                    <?php
                    woocommerce_product_loop_end();


                } else {
                    ?>
                    <div class="no-results-found">
                        <?php
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action('woocommerce_no_products_found');
                        ?></div>
                    <?php
                }

                ?>

            </main>

            <?php
            // Display the pagination component.
            fry_theme_pagination();


            ?>


        </div><!-- #content -->

    </div><!-- #search-wrapper -->

<?php
get_footer();
