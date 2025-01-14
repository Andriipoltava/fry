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

        <div class="row text-white py-lg-5 py-4 gy-4 justify-content-between align-items-lg-start align-items-md-center">

            <div class="col-md-5 ">
                <?php if ($logo_footer) : ?>

                    <a class="site-logo" href="<?php echo home_url() ?>">
                        <?php echo wp_get_attachment_image($logo_footer['ID'], [300, 170]); ?>
                    </a>

                <?php endif; ?>

                <div class="d-md-block d-none">
                    <?php if ($title_footer) echo "<h3 class='pt-3' > $title_footer</h3>"; ?>
                    <?php if ($description__footer) { ?>
                        <div class=" py-3">
                            <?php echo $description__footer; ?>
                        </div>
                    <?php }; ?>

                </div>

            </div><!-- col -->
            <div class="col-lg-7  col-md-8  order-lg-0 order-2">
                <!-- The WordPress Menu goes here -->
                <div class="row justify-content-lg-end  gy-4 gx-4 gx-lg-5">
                    <?php $array_footer_menu = ['footer_col_1', 'footer_col_2', 'footer_col_3',];
                    foreach ($array_footer_menu as $location) {
                        ?>
                        <?php
                        $locations = get_nav_menu_locations(); //get all menu locations
                        $menu = wp_get_nav_menu_object($locations[$location]);//get the menu object
                        ?>
                        <div class="col-xl-3 col-lg-auto col-6">
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
            <div class="col-xxl-3 col-lg-5 col-md-6 pb-lg-0 pb-4">

                <div class="d-md-none">
                    <?php if ($title_footer) echo "<h3 class='pt-3' > $title_footer</h3>"; ?>
                    <?php if ($description__footer) { ?>
                        <div class=" py-3">
                            <?php echo $description__footer; ?>
                        </div>
                    <?php }; ?>

                </div>
                <div class="form-subscribe">
                    <?php echo do_shortcode('[contact-form-7 id="abd1e89" title="Subscribe"]'); ?>
                </div>
                <?php
                       $link = get_field('download_catalog', 'options');
                        if ($link):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <div class="pt-3">
                                <a href="<?php echo esc_url($link_url); ?>"
                                   target="<?php echo esc_attr($link_target); ?>"
                                   class="btn btn-outline-light mt-3"><?php echo esc_html($link_title); ?></a>
                            </div>
                        <?php endif; ?>


            </div>
            <div class="col-6 offset-xxl-3 offset-lg-0 d-flex justify-content-end order-md-0 order-3">
                <?php if ($logo_from_ua) : ?>
                    <?php echo wp_get_attachment_image($logo_from_ua['ID'], 'medium', '', array('style' => '    width: 120px;')); ?>
                <?php endif; ?>
            </div>


            <div class="col-lg-4 col-5 order-md-0 order-2 pt-lg-4 pt-4">
                <?php
                $rows = get_field('social_network', 'options');
                if ($rows) {
                    echo '<div class="icon">';
                    foreach ($rows as $row) {
                        $image = $row['icon'];
                        $url = $row['url'];
                        echo '<a target="_blank" class="p-2" href="' . $url . '">';
                        echo wp_get_attachment_image($image['id'], [25, 25], null, ['style' => '  aspect-ratio: 1; ']);
                        echo '</a>';
                    }
                    echo '</div>';
                } ?>
            </div>
            <div class="col-lg-8 d-flex justify-content-end justify-content-between align-items-lg-center align-items-end flex-wrap order-md-0 order-4 pt-lg-4">
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




