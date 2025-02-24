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


        ?>


        <div class="container-fluid main-content pt-4 pt-lg-5">
            <div class="row g-4">

                <div class="col-lg-12  d-lg-none d-flex flex-wrap justify-content-between">
                    <?php woocommerce_result_count();
                    if (!wc_get_loop_prop('is_paginated') || !woocommerce_products_will_display()) {
                        echo '<span></span>';
                    } ?>

                    <div class="border-0 bg-transparent  d-flex align-items-centerd d-lg-none">
                        <?php echo do_shortcode('[yith_wcan_mobile_modal_opener]'); ?>
                    </div>
                </div>
                <div class="col-lg-4  d-lg-block d-none">
                    <?php filter_btn_show_hide(); ?>
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
                    <?php echo do_shortcode('[yith-woocommerce-ajax-product-filter-label]'); ?>
                </div>
            </div>
            <div class="row w-100 g-xxl-5 g-lg-4  pt-4  gx-0">

                <div class="col-md-4 col-lg-3 filter-bar ">
                    <?php echo do_shortcode('[yith_wcan_filters slug="default-preset"]'); ?>
                </div>
                <div class="col-lg-8 col-xxl-9 woo-loops">
                    <?php
                    if (woocommerce_product_loop()) {
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

                        fry_theme_pagination();

                        //            do_action('woocommerce_after_shop_loop');
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
                </div>
            </div>
            <?php

            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */


            ?>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_main_content.
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        if (!is_search()){
            do_action('woocommerce_after_main_content');
        }


        /**
         * Hook: woocommerce_sidebar.
         *
         * @hooked woocommerce_get_sidebar - 10
         */
        do_action('woocommerce_sidebar');
        ?></main>
<?php
get_footer('shop');
