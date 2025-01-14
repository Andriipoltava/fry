<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');
?>
    <main class="shop-page">
        <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * @hooked woocommerce_breadcrumb - 20
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action('woocommerce_before_main_content');

        /**
         * Hook: woocommerce_shop_loop_header.
         *
         * @since 8.6.0
         *
         * @hooked woocommerce_product_taxonomy_archive_header - 10
         */
        do_action('woocommerce_shop_loop_header');

        if (woocommerce_product_loop()) {
        ?>
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

        <div class="container-fluid main-content pt-4 pt-lg-5">
            <div class="row g-4">

                <div class="col-lg-12  d-lg-none d-flex flex-wrap justify-content-between">
                    <?php echo woocommerce_result_count(); ?>


                    <button type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter"
                            aria-controls="offcanvasFilter"
                            class="border-0 bg-transparent hide-filter d-flex align-items-center">
                        <span>Filter & Sort </span>
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

                    <button class="border-0 bg-transparent hide-filter d-flex align-items-center">
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
                        <span class="show-t"><?php echo esc_html__('Show Filters', 'fry_theme'); ?></span>
                        <span class="hide-t"><?php echo esc_html__('Hide Filters', 'fry_theme'); ?></span>
                    </button>
                </div>
                <div class="col-lg-8 woocommerce_before_shop_loop d-lg-flex justify-content-end d-none">
                    <?php

                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action('woocommerce_before_shop_loop');
                    ?>
                </div>
                <div class="col-12">
                    <?php echo do_shortcode('[yith_wcan_active_filters_labels]'); ?>
                </div>
            </div>
            <div class="row w-100 g-xxl-5 g-4  pt-4">
                <div class="col-md-4 col-lg-3 filter-bar  d-lg-block d-none">
                    <?php echo do_shortcode('[yith_wcan_filters slug="default-preset"]'); ?>
                </div>
                <div class="col-lg-8 col-xxl-9 woo-loops">
                    <?php

                    woocommerce_product_loop_start();

                    if (wc_get_loop_prop('total')) {

                        while (have_posts()) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        }
                    }
                    woocommerce_product_loop_end();

                    ?>
                </div>
            </div>
            <?php

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
            } else {
                ?>
                <div class="container-fluid no-results-found">
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
        </div>
        <?php
        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('woocommerce_after_main_content');

        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action('woocommerce_sidebar');
        ?></main>
<?php
get_footer('shop');
