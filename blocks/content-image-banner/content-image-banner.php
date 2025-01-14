<?php
/**
 * Hero Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$title = get_field('title');
$description = get_field('description');
$image = get_field('image');

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'hero';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> container-fluid  text-white bg-dark px-xl-5 px-3 ">
    <div class="row d-flex py-lg-5 py-4 gx-md-5 align-items-md-center">
        <div class="col-lg-6 pe-md-5">

            <?php if ($title) echo "<h2 class='h3 pe-lg-5' > $title</h2>"; ?>
            <?php if ($description) echo "<div class='content pe-lg-5'> $description</div>"; ?>
        </div>

        <?php if ($image) echo "<div class='col-lg-6 order-lg-last order-first mb-4'> " . wp_get_attachment_image($image['ID'], 'full', null, ['class' => 'w-100']) . "</div>"; ?>


    </div>
</div>
