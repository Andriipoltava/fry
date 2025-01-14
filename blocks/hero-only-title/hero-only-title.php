<?php
/**
 * Hero Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$subtitle = get_field('subtitle');
$title = get_field('title')?:get_the_title();


// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero-title';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> ">
    <div class="container-fluid">
        <div class="row shop-page">
            <div class="col-lg-12 pt-4 pb-5">

                <?php if ($title) echo "<h1 class='h2 pt-3 pb-3  lh-1' > $title</h1>"; ?>
                <?php woocommerce_breadcrumb(); ?>

            </div>
        </div>

    </div>
</div>