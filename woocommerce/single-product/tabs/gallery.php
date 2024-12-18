<?php

$images = get_field('gallery');
$size = 'full'; // (thumbnail, medium, large, full or custom size);
$heading = apply_filters('woocommerce_product_description_gallery', __('Gallery', 'woocommerce'));

if ($images): ?>
    <div class="row py-4 ">
        <div class="col-12 pb-4">
            <h4><?php echo  $heading; ?></h4>
        </div>
        <?php foreach ($images as $image): ?>
            <div class="col-md-6 pt-4">
                <?php echo wp_get_attachment_image($image['id'], $size, null, ['class' => 'w-100', 'style' => '    aspect-ratio: 3 / 2;
    object-fit: cover;']); ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>