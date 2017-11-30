<?php
/**  _ Core_Admin _   **/

/* Show custom admin logo */
function elbrus_login_logo() {
	echo '
	   <style type="text/css">
			#login h1 a { background: url(' . esc_url ( get_template_directory_uri () ) . '/images/logo.png) no-repeat center 0 !important;
			height: 47px;
			width: 310px;
			text-align: center;
		}
		</style>';
}

/* Redirect To Theme Options Page on Activation */
if (is_admin () && isset ( $_GET ['activated'] )) {
	wp_redirect ( admin_url ( 'themes.php' ) );
}

/* Load custom admin scripts & styles */
function elbrus_load_custom_wp_admin_style() {
	if (function_exists ( 'WC' ) && WC ()) {
		$suffix = defined ( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		wp_register_script ( 'wc-enhanced-select', WC ()->plugin_url () . '/assets/js/admin/wc-enhanced-select' . $suffix . '.js', array (
				'jquery',
				'select2' 
		), WC_VERSION );
		wp_localize_script ( 'wc-enhanced-select', 'wc_enhanced_select_params', array (
				'i18n_matches_1' => esc_html_x ( 'One result is available, press enter to select it.', 'enhanced select', 'elbrus' ),
				'i18n_matches_n' => esc_html_x ( '%qty% results are available, use up and down arrow keys to navigate.', 'enhanced select', 'elbrus' ),
				'i18n_no_matches' => esc_html_x ( 'No matches found', 'enhanced select', 'elbrus' ),
				'i18n_ajax_error' => esc_html_x ( 'Loading failed', 'enhanced select', 'elbrus' ),
				'i18n_input_too_short_1' => esc_html_x ( 'Please enter 1 or more characters', 'enhanced select', 'elbrus' ),
				'i18n_input_too_short_n' => esc_html_x ( 'Please enter %qty% or more characters', 'enhanced select', 'elbrus' ),
				'i18n_input_too_long_1' => esc_html_x ( 'Please delete 1 character', 'enhanced select', 'elbrus' ),
				'i18n_input_too_long_n' => esc_html_x ( 'Please delete %qty% characters', 'enhanced select', 'elbrus' ),
				'i18n_selection_too_long_1' => esc_html_x ( 'You can only select 1 item', 'enhanced select', 'elbrus' ),
				'i18n_selection_too_long_n' => esc_html_x ( 'You can only select %qty% items', 'enhanced select', 'elbrus' ),
				'i18n_load_more' => esc_html_x ( 'Loading more results&hellip;', 'enhanced select', 'elbrus' ),
				'i18n_searching' => esc_html_x ( 'Searching&hellip;', 'enhanced select', 'elbrus' ),
				'ajax_url' => admin_url ( 'admin-ajax.php' ),
				'search_products_nonce' => wp_create_nonce ( 'search-products' ),
				'search_customers_nonce' => wp_create_nonce ( 'search-customers' ) 
		) );
		
		wp_enqueue_script ( 'wc-enhanced-select' );
	}
	
	wp_register_script ( 'elbrus_custom_wp_admin_script', get_template_directory_uri () . '/js/custom-admin.js', array (
			'jquery' 
	) );
	wp_localize_script ( 'elbrus_custom_wp_admin_script', 'meta_image', array (
			'title' => esc_html__ ( 'Choose or Upload an Image', 'elbrus' ),
			'button' => esc_html__ ( 'Use this image', 'elbrus' ) 
	) );
	wp_enqueue_script ( 'elbrus_custom_wp_admin_script' );
	wp_enqueue_style ( 'elbrus-custom-admin', get_template_directory_uri () . '/css/custom-admin.css' );
	
	wp_enqueue_style ( 'elbrus-admin-font', get_template_directory_uri () . '/fonts/font-awesome/css/font-awesome.min.css' );
	
	// Add the color picker css file
	wp_enqueue_style ( 'wp-color-picker' );
	// Include our custom jQuery file with WordPress Color Picker dependency
	wp_enqueue_script ( 'elbrus-color', get_template_directory_uri () . '/js/custom-script.js', array (
			'wp-color-picker' 
	), false, true );
}

add_action ( 'login_head', 'elbrus_login_logo' );
add_filter ( 'login_headerurl', create_function ( '', 'return get_home_url();' ) );
add_filter ( 'login_headertitle', create_function ( '', 'return false;' ) );
add_action ( 'admin_enqueue_scripts', 'elbrus_load_custom_wp_admin_style' );

/* Admin Panel */
require_once (get_template_directory () . '/library/core/admin/admin-panel.php');

require_once (get_template_directory () . '/library/core/admin/class-tgm-plugin-activation.php');

require_once (get_template_directory () . '/library/core/admin/post-fields.php');

require_once (get_template_directory () . '/library/core/admin/functions.php');