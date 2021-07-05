<?php
/**
 * Plugin Name: WPE Hack plugin
 * Plugin URI:  https://www.wpengine.com
 * Description: Hacking plugin
 * Version:     1.0.0
 * Author:      WP Engine
 */


if (is_admin() ) {
    include_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
    include_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
}
require_once plugin_dir_path(__FILE__) . 'admin/class.wpe-hackday-rest-api.php';

add_action('rest_api_init', array( 'Wpe_Hackday_REST_API', 'init' ));
