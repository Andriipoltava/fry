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
$class_name = 'news-banner';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
$ar_pc = get_field('image_proportions_to_pc') ? get_field('image_proportions_to_pc') . '-xl' : 'arh-5-xl';
$ar_laptop = get_field('image_proportions_to_laptop') ? get_field('image_proportions_to_laptop') . '-lg' : 'arh-6-lg';
$ar_tablet = get_field('image_proportions_to_tablet') ? get_field('image_proportions_to_tablet') . '-md' : 'arh-10-md ';
$ar_mobile = get_field('image_proportions_to_mobile') ? get_field('image_proportions_to_mobile') : ' ar-1';

?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?>  <?php echo $ar_pc . ' ' . $ar_laptop . ' ' . $ar_tablet . ' ' . $ar_mobile ?>  "
     style="background-image: url(<?php echo $image ? wp_get_attachment_image_url($image['ID'], 'full') : '' ?>);background-size: cover;background-position: center">
    <div class="container-fluid   text-white h-100">
        <div class="row  d-flex align-items-end   py-5   justify-content-between h-100" >
            <div class="col-xxl-7 col-lg-10 col-xxl-5 ">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h2 class='h3 pt-3' > $title</h2>"; ?>
                <?php if ($description) echo "<div> $description</div>"; ?>
                <?php
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>

                    <a class="btn-light btn mt-3" href="<?php echo esc_url($link_url); ?>"
                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>

                <?php endif; ?>
            </div>

        </div>
    </div>

</div>