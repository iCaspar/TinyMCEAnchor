<?php
/**
 * @package TinyMCEAnchor
 * @version 0.1
 */
/*
Plugin Name: TinyMCE Anchor Button
Plugin URI: https://github.com/iCaspar/TinyMCEAnchor
Description: Adds an button to the visual editor to allow easy insertion of an anchor point in the text
Author: Caspar Green
Version: 0.1
Author URI: https://caspar.green/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: cjg_tinymceanchor
Domain Path: /languages
*/

add_action( 'admin_init', 'tinymce_mods_buttons_setup' );

/**
 * Checks user permissions and adds editor filters
 * @return null
 */
function tinymce_mods_buttons_setup() {
	// if user can't edit don't bother
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) return;

	add_filter( 'mce_buttons', 'tinymce_mods_add_buttons');
	add_filter( 'mce_external_plugins', 'tinymce_mods_register_js' );
}

/**
 * Add the anchor (bookmark) button to the top row of the visual editor
 * @param  array $buttons buttons to show on editor row
 * @return array          buttons including anchor button
 */
function tinymce_mods_add_buttons( $buttons ) {
   $insert = array( 'anchor' );
   array_splice( $buttons, 12, 0, $insert );
   return $buttons;
}

/**
 * Add the TinyMCE plugin script for the anchor button
 * @param  array $plugin_array plugins registered with TinyMCE
 * @return array               modified array (with anchor plugin registered)
 */
function tinymce_mods_register_js( $plugin_array ) {
	$plugin_array['anchor'] = plugins_url( '/anchor.min.js', __FILE__ );
	return $plugin_array;
}