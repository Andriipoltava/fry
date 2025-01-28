<?php
/**
 * Pagination layout
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'fry_theme_pagination' ) ) {
	/**
	 * Displays the navigation to next/previous set of posts.
	 *
	 * @param array  $args {
	 *     (Optional) Array of arguments for generating paginated links for archives.
	 *
	 *     @type string $base               Base of the paginated url. Default empty.
	 *     @type string $format             Format for the pagination structure. Default empty.
	 *     @type int    $total              The total amount of pages. Default is the value WP_Query's
	 *                                      `max_num_pages` or 1.
	 *     @type int    $current            The current page number. Default is 'paged' query var or 1.
	 *     @type string $aria_current       The value for the aria-current attribute. Possible values are 'page',
	 *                                      'step', 'location', 'date', 'time', 'true', 'false'. Default is 'page'.
	 *     @type bool   $show_all           Whether to show all pages. Default false.
	 *     @type int    $end_size           How many numbers on either the start and the end list edges.
	 *                                      Default 1.
	 *     @type int    $mid_size           How many numbers to either side of the current pages. Default 2.
	 *     @type bool   $prev_next          Whether to include the previous and next links in the list. Default true.
	 *     @type bool   $prev_text          The previous page text. Default '&laquo;'.
	 *     @type bool   $next_text          The next page text. Default '&raquo;'.
	 *     @type string $type               Controls format of the returned value. Possible values are 'plain',
	 *                                      'array' and 'list'. Default is 'array'.
	 *     @type array  $add_args           An array of query args to add. Default false.
	 *     @type string $add_fragment       A string to append to each link. Default empty.
	 *     @type string $before_page_number A string to appear before the page number. Default empty.
	 *     @type string $after_page_number  A string to append after the page number. Default empty.
	 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Posts navigation'.
	 * }
	 * @param string $class                 (Optional) Classes to be added to the <ul> element. Default 'pagination'.
	 */
	function fry_theme_pagination( $args = array(), $class = 'pagination' ) {

		if ( ! $GLOBALS['wp_query'] instanceof WP_Query || ( ! isset( $args['total'] ) && $GLOBALS['wp_query']->max_num_pages <= 1 ) ) {
			return;
		}

        $total = $GLOBALS['wp_query']->found_posts;
        $current = count($GLOBALS['wp_query']->posts);
        $current = '<span class="current_total">' . $current . '</span>';
        $nominativeSingular = __('position', 'fry_theme'); // e.g.,
        $nominativePlural = __('position', 'fry_theme'); // e.g.,
        $genitivePlural = __('positions', 'fry_theme'); // e.g.,

        $ps = getNounForm((int)$total, $nominativeSingular, $nominativePlural, $genitivePlural);

        if ($GLOBALS['wp_query']->max_num_pages > 1) : ?>

            <div class="row">
                <div class="col-12 text-center small mt-3 showing_total">
                    <?php echo sprintf(
                    /* translators: 1: Theme name, 2: Theme author */
                        esc_html__('Showing %1$s of %2$d ', 'fry_theme'),
                        $current,
                        $total

                    ).$ps ?>
                </div>
                <div class="col-12 text-center my-3">
                    <a href="#" class="btn btn-primary load-more" data-load="<?php _e('Load More', 'fry_theme'); ?>"
                       data-loading="<?php _e('Loading..', 'fry_theme'); ?>"> <?php _e('Load More', 'fry_theme'); ?> </a>
                </div>
            </div>
        <?php endif;


	}
}
