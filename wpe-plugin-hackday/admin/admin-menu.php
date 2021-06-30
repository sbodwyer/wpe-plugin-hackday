<?php

function wpe_plugin_hackday_display_settings_page() {
	include(dirname( __FILE__ ) . "/admin-ui.php");
}


// add sub-level administrative menu
function wpe_hack_plugin_sublevel_menu() {
	/*
	add_submenu_page(
	string   $parent_slug,
	string   $page_title,
	string   $menu_title,
	string   $capability,
	string   $menu_slug,
	callable $function = ''
	);
	*/

	add_submenu_page(
		'options-general.php',
		esc_html__( 'Hack Plugin Settings', 'wpe-plugin-hackday' ),
		esc_html__( 'Hack Plugin', 'wpe-plugin-hackday' ),
		'manage_options',
		'wpe-plugin-hackday',
		'wpe_plugin_hackday_display_settings_page'
	);
}
add_action( 'admin_menu', 'wpe_hack_plugin_sublevel_menu' );