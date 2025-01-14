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
$imageMobile = get_field('background_mobile') ?: $image;

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'top-banner';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


?>

<div
    <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> w-100 arh-6-lg arv-sm-14 arv-16 position-relative"
>
    <?php if ($image) { ?>
        <?php echo wp_get_attachment_image($image['id'], 'full', null, ['class' => 'd-md-block d-none ofc position-absolute top-50 start-50  translate-middle w-100 h-100']); ?>
    <?php }; ?>
    <?php if ($imageMobile) { ?>
        <?php echo wp_get_attachment_image($imageMobile['id'], 'full', null, ['class' => 'd-md-none ofc position-absolute top-50 start-50  translate-middle w-100 h-100']); ?>
    <?php }; ?>

    <div class="container-fluid  text-white h-100 position-relative">
        <div class="row   d-flex align-items-end mt-lg-5 justify-content-between h-100">
            <div class="col-lg-10 col-xl-9  py-lg-5 py-4">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h2 class='h3 pt-3' > $title</h2>"; ?>
                <?php if ($description) echo "<div> $description</div>"; ?>
            </div>

            <?php
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <div class="col-lg-2  py-lg-5 d-lg-block d-none">
                    <div>
                        <a class="btn-light btn mt-3" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>