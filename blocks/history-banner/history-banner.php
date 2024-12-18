<?php
/**
 * Hero Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$subtitle = get_field('subtitle');
$title = get_field('title');
$description = get_field('description');
$link = get_field('link');
$image = get_field('background');

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
    <div class="row   d-flex py-lg-5 py-4">
        <div class="col-lg-6 ">

            <?php if ($title) echo "<h2 class='h3 pt-3' > $title</h2>"; ?>

        </div>

        <?php if ($description) echo "<div class='col-lg-6'> $description</div>"; ?>

    </div>
</div>
