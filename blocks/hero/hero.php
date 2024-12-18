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
$image = get_field('image');
$background_color = get_field('background'); // ACF's color picker.
$text_color = get_field('text_color'); // ACF's color picker.


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
$styles = array('background-color: ' . $background_color, 'color: ' . $text_color);
$style = implode('; ', $styles);

?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?>"
     style="<?php echo esc_attr($style); ?>">
    <div class="container-fluid g-0 px-0">
        <div class="row gx-0 ">
            <div class="col-lg-6 p-4 p-xxl-5 order-lg-first order-last pt-lg-5 mt-lg-5 d-flex align-items-lg-end">
                <div>
                    <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                    <?php if ($title) echo "<h1 class='h2 pt-3' > $title</h1>"; ?>
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
            <?php if ($image) : ?>
                <div class="col-lg-6"
                     style="background-image: url(<?php echo wp_get_attachment_image_url($image['ID'], 'full') ?>);background-size: cover">
                    <?php echo wp_get_attachment_image($image['ID'], 'full', '', array('class' => 'opacity-0 w-100')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>