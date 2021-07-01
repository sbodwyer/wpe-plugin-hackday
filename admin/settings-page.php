<?php
function wpe_plugin_hackday_display_settings_page() {
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<?php render_panels(); ?>
	</div>
	<?php
}

function wpe_hackday_ajax_admin_enqueue_scripts( $hook ) {
	// define script url
	$script_url = plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/ajax-admin.js';

	// enqueue script
	wp_enqueue_script( 'ajax-admin', $script_url, array( 'jquery' ) );

	// create nonce
	$nonce = wp_create_nonce( 'ajax_admin' );

	// define script
	$script = array( 'nonce' => $nonce );

	// localize script
	wp_localize_script( 'ajax-admin', 'ajax_admin', $script );

}
add_action( 'admin_enqueue_scripts', 'wpe_hackday_ajax_admin_enqueue_scripts' );

function admin_post() {
	?>
	<form class="object-cache-panel-admin" action="<?php echo admin_url( 'admin-post.php' ); ?>" method="post">
		<h2>Object Cache - Admin POST</h2>
		<p>Stores the results of queries to the site’s database.</p>
		<input type="hidden" name="action" value="object_cache_flush"/>
		<input class="clear-cache-button" type="submit" value="Clear Object Cache">
		<?php render_success_message(); ?>
	</form>
	<?php
}

function ajax_post_example() {
	?>
	<form class="object-cache-panel" method="post">
		<h2>Object Cache - Ajax</h2>
		<p>Stores the results of queries to the site’s database.</p>
		<input type="hidden"/>
		<input class="clear-cache-button" type="submit" value="Clear Object Cache">
		<p class="ajax-response-clear-cache"></p>
	</form>
	<?php
}

function wpe_hackday_ajax_admin_handler() {
	check_ajax_referer( 'ajax_admin', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$success = wp_cache_flush();
	if ( $success == 1 ) {
		echo 'Cleared!';
	} else {
		echo 'Error!';
	}
	wp_die();
}
add_action( 'wp_ajax_admin_hook', 'wpe_hackday_ajax_admin_handler' );

function ajax_random_quote() {
	?>
	<form class="random-quote-panel" method="post">
		<h2>O'Dwyer Quote - Ajax</h2>
		<p>Retrieve a random quote from the man himself!</p>
		<input type="submit" value="Gimme" class="random-quote-button">
		<p class="ajax-quote-response"></p>
	</form>
	<?php
}

function wpe_hackday_ajax_admin_quote_hander() {
	check_ajax_referer( 'ajax_admin', 'nonce' );
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$quotes = array(
		'Muesli',
		'I Love Muesli',
		'Why Dont You Love Muesli?',
		'Where is my muesli?',
		'Has anyone seen my muesli?',
		'Can you review this muesli please?',
		'Want to pair on some muesli?',
		'Can anybody get me some muesli?',
	);
	$quote  = array_rand( $quotes );
	echo $quotes[ $quote ];
	wp_die();
}
add_action( 'wp_ajax_admin_quote_handler', 'wpe_hackday_ajax_admin_quote_hander' );

function render_panels() {
	?>
	<div class="panels">
		<?php
			admin_post();
			ajax_post_example();
			ajax_random_quote();
		?>
	</div>
	<?php
}

function has_cleared_object_cache() {
	return $_GET['object'] == 'true';
}

function render_success_message() {
	if ( has_cleared_object_cache() ) {
		echo "<p class='clear-success'>Object cache cleared!</p>";
	}
}

function flush_object_cache() {
	wp_cache_flush();
	wp_redirect( admin_url( 'admin.php?page=wpe-plugin-hackday&object=true' ) );
}
add_action( 'admin_post_object_cache_flush', 'flush_object_cache' );


function load_admin_styles() {
	wp_enqueue_style( 'wpe-plugin-hackday', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/wpe-plugin-hackday.css', array(), null, 'screen' );
}

add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
