/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the navbar type setting and informs the preview
 * when users open or close the front page sections section.
 */

 ( function () {
	wp.customize.bind( 'ready', function () {
		// Only show the navbar type setting when running Bootstrap 5.
		wp.customize( 'fry_theme_bootstrap_version', function ( setting ) {
			wp.customize.control(
				'fry_theme_navbar_type',
				function ( control ) {
					const visibility = function () {
						if ( 'bootstrap5' === setting.get() ) {
							control.container.slideDown( 180 );
						} else {
							control.container.slideUp( 180 );
						}
					};

					visibility();
					setting.bind( visibility );
				}
			);
		} );
	} );
} )();
