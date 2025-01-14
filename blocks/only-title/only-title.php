<?php
/**
 * Hero Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.

$subtitle = get_field('subtitle');
$title = get_field('title');

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

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> bg-dark ">
    <div class="container-fluid  py-5 text-white"    style="background-image: url(<?php echo $image ? wp_get_attachment_image_url($image['ID'], 'full') : '' ?>);background-size: cover;background-repeat: no-repeat;background-position: center;background-color:#252525 ">
        <div class="row   d-flex align-items-lg-end  justify-content-center text-center">
            <div class="col-lg-10 col-xxl-6   py-5 my-lg-5 mb-5">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h1 class='h2 lh-1' > $title</h1>"; ?>

            </div>



        </div>
    </div>

</div>