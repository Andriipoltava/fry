<?php
/**
 * Understrap modify editor
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'admin_init', 'fry_theme_wpdocs_theme_add_editor_styles' );

if ( ! function_exists( 'fry_theme_wpdocs_theme_add_editor_styles' ) ) {
	/**
	 * Registers an editor stylesheet for the theme.
	 */
	function fry_theme_wpdocs_theme_add_editor_styles() {
		add_editor_style( 'css/custom-editor-style.min.css' );
	}
}

add_filter( 'mce_buttons_2', 'fry_theme_tiny_mce_style_formats' );

if ( ! function_exists( 'fry_theme_tiny_mce_style_formats' ) ) {
	/**
	 * Reveals TinyMCE's hidden Style dropdown.
	 *
	 * @param array $buttons Array of Tiny MCE's button ids.
	 * @return array
	 */
	function fry_theme_tiny_mce_style_formats( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}
}

add_filter( 'tiny_mce_before_init', 'fry_theme_tiny_mce_before_init' );

if ( ! function_exists( 'fry_theme_tiny_mce_before_init' ) ) {
	/**
	 * Adds style options to TinyMCE's Style dropdown.
	 *
	 * @param array $settings TinyMCE settings array.
	 * @return array
	 */
	function fry_theme_tiny_mce_before_init( $settings ) {

		$style_formats = array(
			array(
				'title'    => __( 'Lead Paragraph', 'fry_theme' ),
				'selector' => 'p',
				'classes'  => 'lead',
				'wrapper'  => true,
			),
			array(
				'title'  => _x( 'Small', 'Font size name', 'fry_theme' ),
				'inline' => 'small',
			),
			array(
				'title'   => __( 'Blockquote', 'fry_theme' ),
				'block'   => 'blockquote',
				'classes' => 'blockquote',
				'wrapper' => true,
			),
			array(
				'title'   => __( 'Blockquote Footer', 'fry_theme' ),
				'block'   => 'footer',
				'classes' => 'blockquote-footer',
				'wrapper' => true,
			),
			array(
				'title'  => __( 'Cite', 'fry_theme' ),
				'inline' => 'cite',
			),
		);

		if ( isset( $settings['style_formats'] ) ) {
			$orig_style_formats = json_decode( $settings['style_formats'], true );
			if ( is_array( $orig_style_formats ) ) {
				$style_formats = array_merge( $orig_style_formats, $style_formats );
			}
		}

		$settings['style_formats'] = wp_json_encode( $style_formats );

		/*
		 * Fix TinyMCE editor body margin that is set to 0 by Bootstrap's
		 * _reboot.scss (v4 & v5). `margin: 9px 10px` is the value used by WP's
		 * TinyMCE skin (/wp-includes/js/tinymce/skins/wordpress/wp-content.css).
		 */
		if ( isset( $settings['content_style'] ) ) {
			$settings['content_style'] .= ' body#tinymce { margin: 9px 10px; }';
		} else {
			$settings['content_style'] = 'body#tinymce { margin: 9px 10px; }';
		}

		return $settings;
	}
}

add_filter( 'mce_buttons', 'fry_theme_tiny_mce_blockquote_button' );

if ( ! function_exists( 'fry_theme_tiny_mce_blockquote_button' ) ) {
	/**
	 * Removes the blockquote button from the TinyMCE toolbar.
	 *
	 * We provide the blockquote via the style formats. Using the style formats
	 * blockquote receives the proper Bootstrap classes.
	 *
	 * @since 1.0.0
	 *
	 * @see fry_theme_tiny_mce_before_init()
	 *
	 * @param array $buttons TinyMCE buttons array.
	 * @return array TinyMCE buttons array without the blockquote button.
	 */
	function fry_theme_tiny_mce_blockquote_button( $buttons ) {
		foreach ( $buttons as $key => $button ) {
			if ( 'blockquote' === $button ) {
				unset( $buttons[ $key ] );
			}
		}
		return $buttons;
	}
}
