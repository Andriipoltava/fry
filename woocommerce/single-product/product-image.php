<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.0.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">

    <div class="woocommerce-product-gallery__wrapper row g-2 ">

        <?php
        $attachment_ids = array();
        $image_id = $product->get_image_id();
        $attachment_ids = array_merge([$image_id], $product->get_gallery_image_ids());
        foreach ($attachment_ids as $key => $attachment_id) {
            $size = 'square-500';
            $col = 'col-6';
            if ($key == 0) {
                $size = 'full';
                $col .= ' col-12 mt-0';
            }

            ?>
            <div class="<?php echo $col ?>">
                <a class="modal-gallery"
                   href="#image-<?php echo $attachment_id; ?>" data-i="<?php echo $attachment_id; ?>">
                    <?php
                    echo wp_get_attachment_image($attachment_id, $size, null, ['class' => 'w-100 ar-1 ofc']);
                    ?>
                </a>
            </div>
            <?php
        }; ?>
    </div>
</div>
