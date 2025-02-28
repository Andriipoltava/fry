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
$imageMobile = get_field('backgroundMobile');
$imageBG = $image ? wp_get_attachment_image_url($image['ID'], 'full') : '';
$imageBGmobile = $imageMobile ? wp_get_attachment_image_url($imageMobile['ID'], 'full') : $imageBG;

// Support custom "anchor" values.
$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'about-banner';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}


?>

<div <?php echo esc_attr($anchor); ?>class="<?php echo esc_attr($class_name); ?> bg-dark py-lg-5  py-4">
    <div class="container-fluid py-5 text-white"    >
        <div class="row   justify-content-center position-relative">

            <div class="col-12 col-lg-6 d-flex justify-content-center py-lg-0 pb-4 pt-5  px-0 my-lg-0 mt-5 px-xxl-3">
                <?php if ($image) {
                    ?>
                    <?php echo wp_get_attachment_image($image['ID'], 'full', null, ['class' => 'd-md-block d-none']); ?>
                    <?php echo wp_get_attachment_image($imageMobile ? $imageMobile['ID'] : $image['ID'], 'full', null, ['class' => 'd-md-none']); ?>

                    <?php
                } ?>
            </div>
            <div class="col-12 col-xl-11  pb-sm-5 mb-lg-5 pb-3 mb-md-5 px-4 position-absolute top-0 me-xl-5">
                <?php if ($subtitle) echo "<span class='uppercase-subtitles'> $subtitle</span>"; ?>
                <?php if ($title) echo "<h2> $title</h2>"; ?>
            </div>


            <?php
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <div class=" col-lg-7  col-xl-5 offset-lg-4 offset-xl-7   px-4 pb-md-0 position-absolute bottom-0 mb-xl-3 pb-lg-5">
                    <?php if ($description) echo "<div> $description</div>"; ?>
                    <div class="mb-xxl-5 mt-2 pt-3">
                        <a class="link link-light mt-3" href="<?php echo esc_url($link_url); ?>"
                           target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>