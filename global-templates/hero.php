<?php
/**
 * Hero setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$latest_post = get_posts('post_type=post&numberposts=1');
$last_ID = $latest_post[0]->ID;
$image = get_post_thumbnail_id($last_ID);
$title = get_the_title($last_ID);
$description = get_the_excerpt($last_ID);
$link = get_the_permalink($last_ID);
?>

    <div class="wrapper" id="wrapper-hero">
        <div class="container-fluid py-5 text-white"
             style="background-image: url(<?php echo $image ? wp_get_attachment_image_url($image, 'full') : '' ?>);background-size: cover;background-repeat: no-repeat;background-position: center;background-color:#252525 ">
            <div class="row   d-flex align-items-lg-end  justify-content-between pt-5 mt-5">
                <div class="col-lg-10  col-xl-6  pt-5 my-lg-5 mb-5">

                    <?php if ($title) echo "<h2 class='' > $title</h2>"; ?>
                    <?php if ($description) echo "<div> $description</div>"; ?>
                    <a class="btn btn-dark mt-3"
                       href="<?php echo esc_url($link); ?>"><?php echo esc_html('Read More'); ?></a>
                </div>


            </div>
        </div>


    </div>

<?php
