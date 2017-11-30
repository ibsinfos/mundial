<?php /** Is coming */

/********** WOOCOMERCE **********/

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 18);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20);


add_filter( 'woocommerce_show_page_title' , 'elbrus_woo_hide_page_title' );
function elbrus_woo_hide_page_title() {
	return false;
}

add_action( 'woocommerce_before_shop_loop_item_title', 'elbrus_woo_shop_loop_item_overlay_begin', 16);
function elbrus_woo_shop_loop_item_overlay_begin() {
	echo '<a class="woo-item-overlay-grid" href="' . get_the_permalink() . '">';
};

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_shop_loop_item_title_overlay', 17);
function woocommerce_shop_loop_item_title_overlay() {
	echo '<span class="product-name">' . get_the_title() . '</span>';
};

add_action( 'woocommerce_before_shop_loop_item_title', 'elbrus_woo_shop_loop_item_link_close', 19);
function elbrus_woo_shop_loop_item_link_close() {
	echo '</a>';
};

//add_action( 'woocommerce_before_shop_loop_item_title', 'elbrus_woo_shop_loop_item_overlay_end', 21);
//function elbrus_woo_shop_loop_item_overlay_end() {
//	echo '</div>';
//};


add_action( 'woocommerce_shop_loop_item_title', 'elbrus_woo_shop_loop_item_title_open', 5);
function elbrus_woo_shop_loop_item_title_open() {
	echo '<div class="woo-item-footer">';
};

add_action( 'woocommerce_shop_loop_item_title', 'elbrus_woo_shop_loop_item_title', 10);
function elbrus_woo_shop_loop_item_title() {
	echo '<div class="product-name"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
};

add_action( 'woocommerce_after_shop_loop_item_title', 'elbrus_woo_shop_loop_item_title_close', 15);
function elbrus_woo_shop_loop_item_title_close() {
	echo '</div>';
};

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.elbrus_get_option('elbrus_products_per_page','9').';' ), 20 );


add_filter('loop_shop_columns', 'elbrus_loop_columns');
if (!function_exists('elbrus_loop_columns')) {
	function elbrus_loop_columns() {
		return 3; // 3 products per row
	}
}


add_filter( 'woocommerce_output_related_products_args', 'elbrus_related_products_args' );
function elbrus_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}

