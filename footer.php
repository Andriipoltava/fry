<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;


$description__footer = get_field('description_footer', 'options');
$title_footer = get_field('title_footer', 'options');
$logo_footer = get_field('logo_footer', 'options');
$logo_from_ua = get_field('logo_from_ua', 'options');
$copyright = get_field('copyright', 'options');

?>
<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo do_shortcode('[contact-form-7 id="1ecb7ee" title="Product form"]'); ?>

            </div>

        </div>
    </div>
</div>

<div class="wrapper bg-black overflow-hidden" id="wrapper-footer">

    <div class="container-fluid">

        <div class="row text-white py-lg-5 py-4 gy-4 justify-content-between">

            <div class="col-md-4 ">
                <?php if ($logo_footer) : ?>

                    <a class="site-logo" href="<?php echo home_url() ?>">
                        <?php echo wp_get_attachment_image($logo_footer['ID'], [200,150]); ?>
                    </a>

                <?php endif; ?>

                <?php if ($title_footer) echo "<h3 class='pt-3' > $title_footer</h3>"; ?>
                <?php if ($description__footer) { ?>
                    <div class=" py-3">
                        <?php echo $description__footer; ?>
                    </div>
                <?php }; ?>


            </div><!-- col -->
            <div class="col-xxl-6 col-lg-8  ">
                <!-- The WordPress Menu goes here -->
                <div class="row justify-content-md-end  gy-4 gx-4 gx-lg-5 mx-0">
                    <?php $array_footer_menu = ['footer_col_1', 'footer_col_2', 'footer_col_3', 'footer_col_4'];
                    foreach ($array_footer_menu as $location) {
                        ?>
                        <?php
                        $locations = get_nav_menu_locations(); //get all menu locations
                        $menu = wp_get_nav_menu_object($locations[$location]);//get the menu object
                        ?>
                        <div class="col-xl-auto col- col-6">
                            <h5 class="h6 pb-1 has-gray-color">
                                <?php echo $menu->name; // n
                                ?>
                            </h5>
                            <?php wp_nav_menu(
                                array(
                                    'theme_location' => $location,

                                    'menu_id' => 'nav-' . $location,
                                    'menu_class' => 'list-inline list-links lh-lg',
                                    'fallback_cb' => '',
                                    'depth' => 1,
                                    'walker' => new Understrap_WP_Bootstrap_Navwalker(),
                                )
                            );
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-xxl-3 col-lg-5 col-md-6">
                <div class="form-subscribe">

                    <?php echo do_shortcode('[contact-form-7 id="abd1e89" title="Subscribe"]'); ?>
                </div>
            </div>
            <div class="col-lg-6 offset-xxl-3 offset-lg-2 d-flex justify-content-end">
                <?php if ($logo_from_ua) : ?>

                    <a href="<?php echo home_url() ?>">
                        <?php echo wp_get_attachment_image($logo_from_ua['ID'], [100, 100], '', array('class' => '')); ?>
                    </a>

                <?php endif; ?>
            </div>

        </div>
        <div class="row text-white py-lg-5 py-4  gy-4">


            <div class="col-lg-4">
                <?php
                $rows = get_field('social_network', 'options');
                if ($rows) {
                    echo '<div class="icon">';
                    foreach ($rows as $row) {
                        $image = $row['icon'];
                        $url = $row['url'];
                        echo '<a target="_blank" class="p-2" href="' . $url . '">';
                        echo wp_get_attachment_image($image['id'], [25, 20], null, ['style' => '    height: inherit;aspect-ratio: 2 / 3;']);
                        echo '</a>';
                    }
                    echo '</div>';
                } ?>
            </div>
            <div class="col-lg-8 d-flex justify-content-end align-items-center flex-wrap">
                <!-- The WordPress Menu goes here -->
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer_copyright',

                        'container_class' => '',
                        'container_id' => '',
                        'menu_class' => 'nav nav-light ',
                        'fallback_cb' => '',
                        'depth' => 1,
                        'walker' => new Understrap_WP_Bootstrap_Navwalker(),
                    )
                );
                ?>
                <span class="small lh-lg ms-4">
                    <?php echo $copyright; ?>
                </span>
            </div>

        </div><!-- .row -->

    </div><!-- .container(-fluid) -->

</div><!-- #wrapper-footer -->

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>




