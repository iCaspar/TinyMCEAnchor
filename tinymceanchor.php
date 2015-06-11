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

add_action("admin_init","tinymce_mods_buttons_setup");

function tinymce_mods_buttons_setup() {
	//only if editing permissions do we bother
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;

	if ( get_user_option('rich_editing') == 'true') {
		add_filter('mce_buttons', 'tinymce_mods_add_buttons');
	}
}

function tinymce_mods_add_buttons($buttons) {
   array_push($buttons, "anchor");
   return $buttons;
}
