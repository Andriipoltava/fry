<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('fry_theme_container_type');
?>
<div class="bg-dark">
    <div class="container-fluid text-white  py-2">
        <!--        <span> Lang</span>-->
        <div class="row justify-content-between">
            <div class="col-6">
                <div id="flags_language_selector" class="left">
                    <?php dynamic_sidebar( 'statichero' ); ?>
                </div>
            </div>
            <!--            <div class="col-auto 1">-->
            <?php //do_shortcode('[wpml-string context="some-unique-site-context" name="This post is also available in"]This post is also available in:[/wpml-string]'); ?><!--</div>-->
            <div class="col-6 d-flex justify-content-end"><a href="#" class="btn btn-primary btn-sm rounded-4 px-3">Зв’язатися з нами</a></div>
        </div>
    </div>

</div>

<nav id="main-nav"
     class="navbar navbar-expand-xl navbar-light tk-neue-haas-grotesk-display position-relative  <?php echo is_front_page() ? "navbar-dark " : "bg-light" ?>"
     aria-labelledby="main-nav-label">

    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e('Main Navigation', 'fry_theme'); ?>
    </h2>


    <div class="container-fluid  justify-content-between">


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

            <div class="offcanvas-header justify-content-end">
                <button
                        class="btn-close text-reset"
                        type="button"
                        data-bs-dismiss="offcanvas"
                        aria-label="<?php esc_attr_e('Close menu', 'fry_theme'); ?>"
                ></button>
            </div><!-- .offcancas-header -->

            <!-- The WordPress Menu goes here -->
            <div class="offcanvas-body align-items-md-center justify-content-center ">
                <?php wp_nav_menu(
                    array(
                        'theme_location' => 'mobile',
                        'container_class' => 'navbar navbar-light',
                        'container_id' => '',
                        'menu_class' => 'navbar-nav justify-content-start flex-grow-1 pe-3 ',
                        'fallback_cb' => '',
                        'menu_id' => 'mobile-me',
                        'depth' => 4,
                        'walker' => new Understrap_WP_Bootstrap_Navwalker(),
                    )
                );
                ?>


            </div>

        </div><!-- .offcanvas -->

        <div class="d-flex align-items-md-center">

            <?php get_template_part('global-templates/navbar', 'search-and-card'); ?>

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

