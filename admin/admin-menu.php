<?php

function wpe_hack_plugin_sublevel_menu() {
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
