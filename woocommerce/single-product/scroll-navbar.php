<?php
global $product;
//var_dump($product->get_available_variations());
?>
<div class="bg-white top-woo-navbar position-fixed w-100 d-lg-block d-none">
    <div class="container-fluid">
        <div class="row align-items-center py-2">
            <div class="col-5">
                <span class="h6"> <?php the_title(); ?></span>
            </div>
            <div class="col-7 d-flex justify-content-end">

                <?php
                if ($product->get_type() === 'variation') {
                    $attrs = $product->get_attributes();
                    foreach ($product->get_variation_attributes() as $key => $options) {

                        if (count($options) == 1) continue;
                        ?>
                        <a href="#woocommerce-wrapper"
                           class="btn btn-primary mx-2 scroll-to-top"><?php echo wc_attribute_label($key); // WPCS: XSS ok. ?></a>

                        <?php

                    };
                } else {
                    ?>
                    <a href="#woocommerce-wrapper" value="<?php echo esc_attr($product->get_id()); ?>"
                            class="btn btn-primary scroll-to-top""><?php echo esc_html($product->single_add_to_cart_text()); ?></a>

                    <?php
                }
                ?>


            </div>

        </div>
    </div>

</div>
