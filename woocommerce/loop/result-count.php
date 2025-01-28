<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$nominativeSingular = __( 'Showing the single result', 'fry_theme' ); // e.g.,
$nominativePlural =__( 'position', 'fry_theme' ); // e.g.,
$genitivePlural = __( 'positions', 'fry_theme' ); // e.g.,
?>
<p class="woocommerce-result-count" <?php echo ( empty( $orderedby ) || 1 === intval( $total ) ) ? '' : 'role="alert" aria-relevant="all" data-is-sorted-by="true"'; ?>>
	<?php

	// phpcs:disable WordPress.Security
	if ( 1 === intval( $total ) ) {
        echo  getNounForm($total,$nominativeSingular,$nominativePlural,$genitivePlural);

	} else  {


        echo $total.' '.getNounForm($total,$nominativeSingular,$nominativePlural,$genitivePlural);
	}
	// phpcs:enable WordPress.Security
	?>
</p>
