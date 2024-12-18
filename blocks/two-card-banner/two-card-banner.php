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

$subtitle_right = get_field('subtitle_right');
$title_right = get_field('title_right');
$description_right = get_field('description_right');
$link_right = get_field('link_right');
$image_right = get_field('background_right');

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'two-card-banner';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> container-fluid  px-0 text-white overflow-hidden">
    <div class="row align-items-lg-end ">
        <div class="col-lg-6 p-5 position-relative overflow-hidden zoom-img-hover" style="    aspect-ratio: 4 / 3;
    min-height: 450px;">
            <div class="py-xl-5 h-100 d-flex align-items-end">
                <?php if ($image_right) echo "<div class=' '> " . wp_get_attachment_image($image_right['ID'], 'full', null, ['class' => 'position-absolute start-0 top-0 w-100 h-100', 'style' => 'object-fit: cover;']) . "</div>"; ?>
                <div class="position-relative pt-5 mt-5">
                    <?php if ($subtitle_right) echo "<span class='uppercase-subtitles'> $subtitle_right</span>"; ?>
                    <?php if ($title_right) echo "<h2 class='h3 pt-3' > $title_right</h2>"; ?>
                    <?php if ($description_right) echo "<div> $description_right</div>"; ?>
                    <?php
                    if ($link_right):
                        $link_url = $link_right['url'];
                        $link_title = $link_right['title'];
                        $link_target = $link_right['target'] ? $link_right['target'] : '_self';
                        ?>

                        <a class="link link-light mt-3" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6 p-5 position-relative overflow-hidden zoom-img-hover" style="    aspect-ratio: 4 / 3;
    min-height: 450px;">
            <div class="py-xl-5 h-100 d-flex align-items-end">
                <?php if ($image) echo "<div class=' '> " . wp_get_attachment_image($image['ID'], 'full', null, ['class' => 'position-absolute start-0 top-0 w-100 h-100', 'style' => 'object-fit: cover;']) . "</div>"; ?>
                <div class="position-relative pt-5 mt-5">

                    <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                    <?php if ($title) echo "<h2 class='h3 pt-3' > $title</h2>"; ?>
                    <?php if ($description) echo "<div> $description</div>"; ?>
                    <?php
                    if ($link):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>

                        <a class="link link-light mt-3" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>