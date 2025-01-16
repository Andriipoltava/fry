<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('col-lg-4'); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header">
        <a href="<?php echo get_the_permalink(); ?>">
        <?php echo get_the_post_thumbnail($post->ID, 'square-500'); ?>
        </a>
    </header><!-- .entry-header -->


    <div class="entry-content mt-3">
        <?php
        the_title(
            sprintf('<h2 class="h5 entry-title"><a href="%s" rel="bookmark" class="text-decoration-none">', esc_url(get_permalink())),
            '</a></h2>'
        );
        ?>

        <?php
        the_excerpt();
        ?>
        <a class="link link-dark mt-3"
           href="<?php echo get_the_permalink(); ?>"><?php _e('Read More','fry_theme');; ?></a>
    </div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->
