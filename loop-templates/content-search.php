<?php
/**
 * Search results partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('col-lg-4'); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header zoom-img-hover overflow-hidden">
        <a href="<?php echo get_permalink() ?>">
            <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
        </a>

    </header><!-- .entry-header -->

    <div class="entry-summary pt-3">
        <?php
        the_title(
            sprintf('<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
            '</a></h5>'
        );
        ?>

        <?php the_excerpt(); ?>

    </div><!-- .entry-summary -->


</article><!-- #post-<?php the_ID(); ?> -->
