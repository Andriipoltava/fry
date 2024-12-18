<?php

/**
 * Flex Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'featured-product-slider-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'featured-product-slider-block ';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}
$title = get_field('title');
$subtitle = get_field('subtitle');
$link = get_field('link');
$itemType = get_field('select_type');
$button_text = get_field('button_text');
$style = get_field('style');
$arrayStyle = ['dark' => 'light', 'light' => 'dark']
?>

<div id="<?php echo $id ?>"
     class=" <?php echo $className ?> <?php echo 'bg-' . $style ?> <?php echo 'text-' . $arrayStyle[$style] ?>">
    <div class="py-md-5 py-5 container-fluid pe-0">
        <div class="row mb-4 pe-xl-5 pe-3">
            <div class="col-md-8">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h3 class='pt-3' > $title</h3>"; ?>
            </div>
            <?php
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <div class="col-md-4 d-flex justify-content-md-end pt-md-0 pt-4">
                    <div>
                        <a class="<?php echo $itemType !== 'category' ? ('btn btn-'. $arrayStyle[$style]) : ('link' .' link-' . $arrayStyle[$style]) ?>  mt-3"
                           href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php $featured_posts = get_field($itemType);
        if ($featured_posts): ?>
            <div class=" position-relative slider ">
                <div class="swiper-container swiper products-slider ">
                    <div class="swiper-wrapper ">
                        <?php foreach ($featured_posts as $post):
                            // Setup this post for WP functions (variable must be named $post).
                            if ($itemType == 'category') {
                                $product_cat = get_term($post, 'product_cat');
                                $main_image = get_field('main_image', $product_cat);
                                $thumbnail_id = get_term_meta($product_cat->term_id, 'thumbnail_id', true);
                                $main_image = !$main_image ? $thumbnail_id : $main_image['id'];
                                $title = $product_cat->name;
                                $link = get_term_link($product_cat);
                            }
                            if ($itemType == 'product') {
                                $product_cat = get_term($post, 'product_cat');
                                $main_image = get_post_thumbnail_id($post->ID);
                                $title = $post->post_title;
                                $link = get_the_permalink($post);
                            }

                            ?>
                            <div class="loop-product-column">
                                <?php if ($main_image) { ?>
                                    <?php echo wp_get_attachment_image($main_image, 'square-500',null,['class'=>'w-100']); ?>
                                <?php }; ?>
                                <h5 class="pt-3"><?php echo $title; ?></h5>
                                <a class='text-uppercase fw-bold link  <?php echo 'link-' . $arrayStyle[$style] ?>'
                                   href="<?php echo($link); ?>"><?php echo $button_text ?: __('Купуйте зараз'); ?></a>
                            </div>

                            <?php ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="row align-items-center mt-5">
                        <!-- If we need scrollbar -->
                        <div class="col-md-10 col-8">
                            <div class="swiper-scrollbar">

                            </div>
                        </div>
                        <div class="d-flex align-item-center col-md-2 justify-content-center col-4">
                            <div class="swiper-button-icon swiper-button-prev-icon <?php echo 'bg-' . $arrayStyle[$style] ?> rounded-circle p-2 mx-2 d-flex align-items-center justify-content-center">
                                <svg fill="white" class="icon icon--arrow-right" xmlns="http://www.w3.org/2000/svg"
                                     width="20" height="20" viewBox="0 0 17.31 18.12">
                                    <title>Arrow - Left</title>
                                    <polygon class="cls-1"
                                             points="8.25 0 7.19 1.06 14.44 8.31 0 8.31 0 9.81 14.44 9.81 7.19 17.06 8.25 18.12 17.31 9.06 8.25 0"></polygon>
                                </svg>
                            </div>
                            <div class="swiper-button-icon swiper-button-next-icon <?php echo 'bg-' . $arrayStyle[$style] ?> rounded-circle p-2 mx-2 d-flex align-items-center justify-content-center">
                                <svg fill="white" class="icon icon--arrow-right" xmlns="http://www.w3.org/2000/svg"
                                     width="20" height="20" viewBox="0 0 17.31 18.12">
                                    <title>Arrow - Right</title>
                                    <polygon class="cls-1"
                                             points="8.25 0 7.19 1.06 14.44 8.31 0 8.31 0 9.81 14.44 9.81 7.19 17.06 8.25 18.12 17.31 9.06 8.25 0"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <?php
            // Reset the global post object so that the rest of the page works correctly.
            wp_reset_postdata(); ?>
        <?php endif; ?>

    </div>

</div>