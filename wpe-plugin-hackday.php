<?php
/**
 * Plugin Name: WPE Hack plugin
 * Plugin URI:  https://www.wpengine.com
 * Description: Hacking plugin
 * Version:     1.0.0
 * Author:      WP Engine
 *
 */

namespace wpengine\hack_plugin;




function _handle_form_action(){

    echo 'form processed';
    wp_redirect( admin_url( 'options-general.php?page=wpe-plugin-hackday'));

}


if ( is_admin() ) {
    include_once plugin_dir_path( __FILE__ ) . 'wpe-plugin-hackday/admin/admin-menu.php';
}
add_action('admin_post_submit-hack-form', 'wpengine\\hack_plugin\\_handle_form_action'); // If the user is logged in
add_action('admin_post_nopriv_submit-hack-form', 'wpengine\\hack_plugin\\_handle_form_action'); // If the user in not logged in
