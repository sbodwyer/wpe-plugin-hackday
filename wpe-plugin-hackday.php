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
    include_once plugin_dir_path(__FILE__) . 'admin/class.wpe-hackday.php';
}

function init()
{
    register_rest_route(
        'wpehack/v1', '/test/', 
        array(
                'methods' => WP_REST_Server::READABLE,
                'permission_callback' => function () {
                    return true; 
                },
                'callback' => 'rest_example_special_message',
        )
    );
}

add_action('rest_api_init', 'init');


function rest_example_special_message()
{
    return '<p>This is a nice message!</p>';
}