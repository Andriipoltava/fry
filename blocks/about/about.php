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
$class_name = 'about';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> bg-dark p-md-5 p-4">
    <div class="container-fluid py-5 text-white"    >
        <div class="row   d-flex align-items-lg-end  justify-content-between" style="background-image: url(<?php echo $image ? wp_get_attachment_image_url($image['ID'], 'full') : '' ?>);background-size: contain;background-repeat: no-repeat;background-position: center;background-color:#252525 ">
            <div class="col-11 offset-xxl-1 col-xl-11  py-5 my-lg-5 mb-5">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h2 style='    word-break: break-all;' > $title</h2>"; ?>

            </div>

            <?php
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <div class="col-lg-5 col-xl-4 offset-lg-7  pt-lg-5 mt-md-5">
                    <?php if ($description) echo "<div> $description</div>"; ?>
                    <div>
                        <a class="link link-light mt-3" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>