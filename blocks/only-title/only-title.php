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

$ar_pc = get_field('image_proportions_to_pc') ? get_field('image_proportions_to_pc') . '-xl' : 'arv-52-xl';
$ar_laptop = get_field('image_proportions_to_laptop') ? get_field('image_proportions_to_laptop') . '-lg' : 'arv-52-lg';
$ar_tablet = get_field('image_proportions_to_tablet') ? get_field('image_proportions_to_tablet') . '-md' : 'arv-54-md ';
$ar_mobile = get_field('image_proportions_to_mobile') ? get_field('image_proportions_to_mobile') : ' arv-54';
?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> bg-dark    ">
    <div class="overflow-hidden d-flex align-items-center  py-2 text-white   <?php echo $ar_pc . ' ' . $ar_laptop . ' ' . $ar_tablet . ' ' . $ar_mobile ?> "
         style="background-image: url(<?php echo $image ? wp_get_attachment_image_url($image['ID'], 'full') : '' ?>);background-size: cover;background-repeat: no-repeat;background-position: center;background-color:#252525 ">
        <div class="container">
        <div class="row   d-flex align-items-center  justify-content-center text-center">
            <div class="col-lg-10 col-xxl-8   px-xxl-4">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h1 class='h2 lh-1' > $title</h1>"; ?>

            </div>



        </div>
    </div>

</div>