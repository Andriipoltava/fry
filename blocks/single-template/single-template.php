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
$images = get_field('gallery');
$size = 'full'; // (thumbnail, medium, large, full or custom size);

?>

<div
    <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?>  ">
    <div class=" container-fluid ">
        <div class="row   d-flex py-lg-5 py-md-4 g-4">
            <div class="col-lg-6">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>

                <?php if ($title) echo "<h2 class='h3 pt-3' > $title</h2>"; ?>

            </div>
            <div class='col-lg-6'>
                <?php if ($description) echo "<div class='description'> $description</div>"; ?>
                <?php
                if ($link):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <div>
                        <a class="link link-light mt-3" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row g-0">
            <?php foreach ($images as $image): ?>
                <div class="col-md-6 zoom-img-hover overflow-hidden">
                    <?php echo wp_get_attachment_image($image['id'], $size, null, ['class' => 'w-100', 'style' => '    aspect-ratio: 3 / 2;
    object-fit: cover;']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
