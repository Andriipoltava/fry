<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$call_for_our_header = get_field('call_for_our_header', 'options');
$container = get_theme_mod('fry_theme_container_type');
?>
<div class="bg-secondary">
    <div class="container-fluid text-white  py-sm-2 py-1">
        <!--        <span> Lang</span>-->
        <div class="row justify-content-between">
            <div class="col-auto">

            </div>
            <!--            <div class="col-auto 1">-->
            <?php //do_shortcode('[wpml-string context="some-unique-site-context" name="This post is also available in"]This post is also available in:[/wpml-string]'); ?><!--</div>-->
            <div class="col-lg-6 col-12  d-flex justify-content-md-end justify-content-between align-items-center">
                <div class="d-flex">
                <div id="flags_language_selector_top" class="left">
                    <?php dynamic_sidebar('statichero'); ?>
                </div>


                <?php if ($call_for_our_header) {
                    $link_url = $call_for_our_header['url'];
                    $link_title = $call_for_our_header['title'];
                    $link_target = $call_for_our_header['target'] ? $call_for_our_header['target'] : '_self'; ?>
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"
                       class="text-white  text-decoration-none d-flex align-items-center py-sm-1 lh-1 mt-sm-1 d-flex align-items-sm-start">
                        <i class="fa fa-phone  pe-2" style="    font-size: 18px;"></i>
                        <span class="d-sm-inline d-none"> <?php echo esc_html($link_title); ?></span>

                    </a>
                <?php }; ?>
                </div>
                <div class="ms-3 d-md-block ">
                    <?php get_template_part('global-templates/navbar', 'search'); ?>
                </div>

            </div>
        </div>
    </div>

</div>

<nav id="main-nav"
     class="navbar navbar-expand-xl navbar-light tk-neue-haas-grotesk-display position-relative  <?php echo is_front_page() ? "navbar-dark " : "bg-light" ?>"
     aria-labelledby="main-nav-label">

    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e('Main Navigation', 'fry_theme'); ?>
    </h2>


    <div class="container-fluid  justify-content-between align-items-xl-start">


        <!-- Your site branding in the menu -->
        <?php get_template_part('global-templates/navbar-branding'); ?>

        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'container_class' => 'd-xl-block d-none',
                'container_id' => '',
                'menu_class' => 'navbar-nav justify-content-start flex-grow-1 pe-3 ',
                'fallback_cb' => '',
                'menu_id' => 'new-header',
                'depth' => 4,
                'walker' => new New_WP_Bootstrap_Navwalker(),
            )
        );
        ?>


        <div class="offcanvas offcanvas-start bg-white d-xl-none " tabindex="-1" id="navbarNavOffcanvas">

            <div class="offcanvas-header justify-content-between align-items-center">
                <div class="text-dark offcanvas-titles">
                    <h6 class="mb-0 offcanvas-title collapse show"><?php esc_attr_e('Menu', 'fry_theme'); ?></h6>
                    <h6 class="mb-0 offcanvas-back collapse "><?php esc_attr_e('Back', 'fry_theme'); ?></h6>
                </div>
                <button
                        class="btn-close text-reset"
                        type="button"
                        data-bs-dismiss="offcanvas"
                        aria-label="<?php esc_attr_e('Close menu', 'fry_theme'); ?>"
                ></button>
            </div><!-- .offcancas-header -->

            <!-- The WordPress Menu goes here -->
            <div class="offcanvas-body overflow-hidden align-items-md-center justify-content-center position-relative">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'mobile',
                        'container_class' => '',
                        'container_id' => '',
                        'menu_class' => 'navbar-nav justify-content-start flex-grow-1 pe-3 ',
                        'fallback_cb' => '',
                        'menu_id' => 'mobile-me',
                        'depth' => 4,
                        'walker' => new Mobile_WP_Bootstrap_Navwalker(),
                    )
                );
                ?>

                <?php if ($call_for_our_header) {
                    $link_url = $call_for_our_header['url'];
                    $link_title = $call_for_our_header['title'];
                    $link_target = $call_for_our_header['target'] ? $call_for_our_header['target'] : '_self'; ?>
                    <hr class="border-dark">
                    <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"
                       class="text-dark  text-decoration-none d-flex py-1 lh-1 mt-1 d-flex">
                        <i class="fa fa-phone  pe-2" style="    font-size: 18px;"></i>
                        <span class=""> <?php echo esc_html($link_title); ?></span>

                    </a>
                <?php }; ?>


            </div>

        </div><!-- .offcanvas -->

        <div class=" d-flex align-items-md-center">


        <button
                    class="navbar-toggler d-xl-none ms-4"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#navbarNavOffcanvas"
                    aria-controls="navbarNavOffcanvas"
                    aria-expanded="false"
                    aria-label="<?php esc_attr_e('Open menu', 'fry_theme'); ?>"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>


    </div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->

