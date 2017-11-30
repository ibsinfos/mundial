<?php

/********* HEADER SETTINGS ==> ***********/
add_action ( 'add_meta_boxes', 'elbrus_layout_side' );
function elbrus_layout_side() {
	add_meta_box ( 'elbrus_layout_side', esc_html__ ( 'Page Settings', 'elbrus' ), 'elbrus_layout_side_content', array (
			'post',
			'page',
			'portfolio' 
	), 'side', 'default' );
}
function elbrus_layout_side_content($post) {
	echo '<p><strong>' . esc_html__ ( 'Main Color', 'elbrus' ) . '</strong></p>';
	$sel_v = get_post_meta ( $post->ID, 'page_main_color', 1 );
	echo '<input type="text" name="page_main_color" value="' . esc_attr ( $sel_v ) . '" class="admin-color-field" data-default-color="" />';
	
	echo '<p><strong>' . esc_html__ ( 'Additional Color', 'elbrus' ) . '</strong></p>';
	$sel_a = get_post_meta ( $post->ID, 'page_additional_color', 1 );
	echo '<input type="text" name="page_additional_color" value="' . esc_attr ( $sel_a ) . '" class="admin-color-field" data-default-color="" />';
	
	echo '<p><label for="header_logo" class="row-title">' . esc_html__ ( 'Header Logo Light', 'elbrus' ) . '</label>';
	$sel_logo = get_post_meta ( $post->ID, 'header_logo', true );
	echo '	<input type="text" name="header_logo" id="header_logo" value="' . esc_url ( $sel_logo ) . '" />
            <button data-input="header_logo" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
            <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
    </p>';
	if ($sel_logo) {
		echo '<p class="pix-bg-png"> <img src="' . esc_url ( $sel_logo ) . '" alt="' . esc_attr__ ( 'Logo Light', 'elbrus' ) . '"> </p>';
	}
	
	echo '<p><label for="header_logo_inverse" class="row-title">' . esc_html__ ( 'Header Logo Dark', 'elbrus' ) . '</label>';
	$sel_logo_inverse = get_post_meta ( $post->ID, 'header_logo_inverse', true );
	echo '	<input type="text" name="header_logo_inverse" id="header_logo_inverse" value="' . esc_url ( $sel_logo_inverse ) . '" />
            <button data-input="header_logo_inverse" class="btn pix-image-upload pix-btn-icon"><i class="fa fa-picture-o"></i></button>
            <button type="button" class="btn pix-reset pix-btn-icon"><i class="fa fa-trash-o"></i></button>
    </p>';
	if ($sel_logo_inverse) {
		echo '<p class="pix-bg-png"> <img src="' . esc_url ( $sel_logo_inverse ) . '" alt="' . esc_attr__ ( 'Logo Dark', 'elbrus' ) . '"> </p>';
	}
}

add_action ( 'save_post', 'elbrus_layout_side_save' );
function elbrus_layout_side_save($post_id) {
	if (! empty ( $_POST ['extra_fields_nonce'] ) && ! wp_verify_nonce ( $_POST ['extra_fields_nonce'], __FILE__ ))
		return false;
	if (defined ( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
		return false;
	if (! current_user_can ( 'edit_post', $post_id ))
		return false;
	
	if (! isset ( $_POST ['page_main_color'] ) && ! isset ( $_POST ['page_additional_color'] ) && ! isset ( $_POST ['header_logo'] ) && ! isset ( $_POST ['header_logo_inverse'] ))
		return false;
	
	$_POST ['header_logo_inverse'] = trim ( $_POST ['header_logo_inverse'] );
	$_POST ['header_logo'] = trim ( $_POST ['header_logo'] );
	$_POST ['page_main_color'] = trim ( $_POST ['page_main_color'] );
	$_POST ['page_additional_color'] = trim ( $_POST ['page_additional_color'] );
	
	if (! isset ( $_POST ['page_main_color'] )) {
		delete_post_meta ( $post_id, 'page_main_color' );
	} else {
		update_post_meta ( $post_id, 'page_main_color', $_POST ['page_main_color'] );
	}
	
	if (! isset ( $_POST ['page_additional_color'] )) {
		delete_post_meta ( $post_id, 'page_additional_color' );
	} else {
		update_post_meta ( $post_id, 'page_additional_color', $_POST ['page_additional_color'] );
	}
	
	if (! isset ( $_POST ['header_logo'] )) {
		delete_post_meta ( $post_id, 'header_logo' );
	} else {
		update_post_meta ( $post_id, 'header_logo', $_POST ['header_logo'] );
	}
	
	if (! isset ( $_POST ['header_logo_inverse'] )) {
		delete_post_meta ( $post_id, 'header_logo_inverse' );
	} else {
		update_post_meta ( $post_id, 'header_logo_inverse', $_POST ['header_logo_inverse'] );
	}
	
	return $post_id;
}

add_action ( 'add_meta_boxes', 'elbrus_posts_init' );
function elbrus_posts_init() {
	if (class_exists ( 'WooCommerce' )) {
		add_meta_box ( 'woo_layout', esc_html__ ( 'Product Layout', 'elbrus' ), 'elbrus_woo_layout', 'page', 'side', 'low' );
	}
	add_meta_box ( 'sidebar_options', esc_html__ ( 'Elbrus - Sidebar Options', 'elbrus' ), 'elbrus_sidebar_options', 'post', 'side', 'low' );
	add_meta_box ( 'sidebar_options', esc_html__ ( 'Elbrus - Sidebar Options', 'elbrus' ), 'elbrus_sidebar_options', 'page', 'side', 'low' );
	add_meta_box ( 'sidebar_options', esc_html__ ( 'Elbrus - Sidebar Options', 'elbrus' ), 'elbrus_sidebar_options', 'product', 'side', 'low' );
	add_meta_box ( 'portfolio_layout_options', esc_html__ ( 'Elbrus - Portfolio Layout Options', 'elbrus' ), 'elbrus_portfolio_layout_options', 'portfolio', 'side', 'low' );
	add_meta_box ( 'page_layout_options', esc_html__ ( 'Elbrus - Page Layout Options', 'elbrus' ), 'elbrus_page_layout_options', 'post', 'side', 'low' );
	add_meta_box ( 'page_layout_options', esc_html__ ( 'Elbrus - Page Layout Options', 'elbrus' ), 'elbrus_page_layout_options', 'page', 'side', 'low' );
	add_meta_box ( 'page_layout_options', esc_html__ ( 'Elbrus - Page Layout Options', 'elbrus' ), 'elbrus_page_layout_options', 'portfolio', 'side', 'low' );
	add_meta_box ( 'page_layout_options', esc_html__ ( 'Elbrus - Page Layout Options', 'elbrus' ), 'elbrus_page_layout_options', 'product', 'side', 'low' );
}

/**
 * START SIDEBAR OPTIONS
 */
function elbrus_sidebar_options() {
	global $post;
	$post_id = $post;
	if (is_object ( $post_id )) {
		$post_id = $post_id->ID;
	}
	
	$selected_type_sidebar = (get_post_meta ( $post_id, 'pix_page_layout', true ) == "") ? 2 : get_post_meta ( $post_id, 'pix_page_layout', true );
	
	$selected_sidebar = get_post_meta ( $post_id, 'pix_selected_sidebar', true );
	
	if (! is_array ( $selected_sidebar )) {
		$tmp = $selected_sidebar;
		$selected_sidebar = array ();
		$selected_sidebar [0] = $tmp;
	}
	
	?>

<p>
	<strong><?php echo esc_html__('Sidebar type', 'elbrus')?></strong>
</p>

<select class="rwmb-select" name="pix_page_layout" id="pix_page_layout"
	size="0">
	<option value="1" <?php if ($selected_type_sidebar == 1):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Full width', 'elbrus')?></option>
	<option value="2" <?php if ($selected_type_sidebar == 2):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Right Sidebar', 'elbrus')?></option>
	<option value="3" <?php if ($selected_type_sidebar == 3):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Left Sidebar', 'elbrus')?></option>
</select>
<?php ?>

<p>
	<strong><?php echo esc_html__('Sidebar content', 'elbrus')?></strong>
</p>
<ul>
	<?php
	global $wp_registered_sidebars;
	// var_dump($wp_registered_sidebars);
	for($i = 0; $i < 1; $i ++) {
		?>
			<li><select name="sidebar_generator[<?php echo esc_attr($i)?>]">
			<!--<option value=""<?php if($selected_sidebar[$i] == ''){ echo " selected";} ?>><?php echo esc_html__('WP Default Sidebar', 'elbrus')?></option>-->
			<?php
		$sidebars = $wp_registered_sidebars;
		if (is_array ( $sidebars ) && ! empty ( $sidebars )) {
			foreach ( $sidebars as $sidebar ) {
				if ($selected_sidebar [$i] == $sidebar ['id']) {
					echo "<option value='" . esc_attr ( $sidebar ['id'] ) . "' selected>{$sidebar['name']}</option>\n";
				} else {
					echo "<option value='" . esc_attr ( $sidebar ['id'] ) . "'>{$sidebar['name']}</option>\n";
				}
			}
		}
		?>
			</select></li>
		<?php } ?>
	</ul>

<?php

}

/**
 * END SIDEBAR OPTIONS
 */

/**
 * START LAYOUT PAGE OPTIONS
 */
function elbrus_page_layout_options() {
	global $post;
	$post_id = $post;
	if (is_object ( $post_id )) {
		$post_id = $post_id->ID;
	}
	
	$selected_header_icon = get_post_meta ( $post_id, 'pix_page_header_icon', true );
	
	// BOTTOM FOOTER BLOCK
	$selected_footer_block = (get_post_meta ( $post_id, 'pix_page_footer_staticblock', true ) == "") ? 'global' : get_post_meta ( $post_id, 'pix_page_footer_staticblock', true );
	
	// TOP FOOTER BLOCK
	$selected_top_footer_block = (get_post_meta ( $post_id, 'pix_page_top_footer_staticblock', true ) == "") ? 'global' : get_post_meta ( $post_id, 'pix_page_top_footer_staticblock', true );
	
	$args = array (
			'post_type' => 'staticblocks',
			'post_status' => 'publish' 
	);
	$staticBlocks = array ();
	$staticBlocks ['global'] = esc_html__ ( 'Use global settings', 'elbrus' );
	$staticBlocksData = get_posts ( $args );
	foreach ( $staticBlocksData as $_block ) {
		$staticBlocks [$_block->ID] = $_block->post_title;
	}
	
	?>

	<?php // header icon class ?>
<p>
	<strong><?php echo esc_html__('Header Icon Class', 'elbrus')?></strong>
</p>
<ul>

	<li><input type="text" name="pix_page_header_icon"
		value="<?php echo esc_attr($selected_header_icon)?>" /></li>
</ul>

<?php // top footer ?>
<p>
	<strong><?php echo esc_html__('Top Footer Static Block', 'elbrus')?></strong>
</p>
<ul>

	<li><select name="pix_page_top_footer_staticblock">
                <?php
	
foreach ( $staticBlocks as $id => $_staticBlock ) {
		if ($id == $selected_top_footer_block) {
			echo "<option value='" . esc_attr ( $id ) . "' selected>" . esc_attr ( $_staticBlock ) . "</option>\n";
		} else {
			echo "<option value='" . esc_attr ( $id ) . "'>" . esc_attr ( $_staticBlock ) . "</option>\n";
		}
	}
	?>
            </select></li>
</ul>

<?php // bottom footer ?>
<p>
	<strong><?php echo esc_html__('Bottom Footer Static Block', 'elbrus')?></strong>
</p>
<ul>

	<li><select name="pix_page_footer_staticblock">
			<?php
	
foreach ( $staticBlocks as $id => $_staticBlock ) {
		if ($id == $selected_footer_block) {
			echo "<option value='" . esc_attr ( $id ) . "' selected>" . esc_attr ( $_staticBlock ) . "</option>\n";
		} else {
			echo "<option value='" . esc_attr ( $id ) . "'>" . esc_attr ( $_staticBlock ) . "</option>\n";
		}
	}
	?>
			</select></li>
</ul>
<?php

}

/**
 * END LAYOUT PAGE OPTIONS
 */

/**
 * START WOO LAYOUT OPTIONS
 */
function elbrus_woo_layout() {
	global $post;
	$post_id = $post;
	if (is_object ( $post_id )) {
		$post_id = $post_id->ID;
	}
	
	$selected_woo_layout = (get_post_meta ( $post_id, 'pix_woo_layout', true ) == "") ? '' : get_post_meta ( $post_id, 'pix_woo_layout', true );
	$selected_product_display = (get_post_meta ( $post_id, 'pix_woo_product_display', true ) == "") ? '' : get_post_meta ( $post_id, 'pix_woo_product_display', true );
	
	?>

<p>
	<strong><?php echo esc_html__('Woocommerce Layout', 'elbrus')?></strong>
</p>

<select class="rwmb-select" name="pix_woo_layout" id="pix_woo_layout"
	size="0">
	<option value="" <?php if ($selected_woo_layout == ''):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Global', 'elbrus')?></option>
	<option value="default" <?php if ($selected_woo_layout == 'default'):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Default', 'elbrus')?></option>
	<option value="hover" <?php if ($selected_woo_layout == 'hover'):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Hover Info', 'elbrus')?></option>
</select>

<p>
	<strong><?php echo esc_html__('Product Display', 'elbrus')?></strong>
</p>

<select class="rwmb-select" name="pix_woo_product_display"
	id="pix_woo_product_display" size="0">
	<option value="" <?php if ($selected_product_display == ''):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Global', 'elbrus')?></option>
	<option value="default"
		<?php if ($selected_product_display == 'default'):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Default', 'elbrus')?></option>
	<option value="stretch"
		<?php if ($selected_product_display == 'stretch'):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Cell Stretch', 'elbrus')?></option>
</select>

<?php

}

/**
 * START PORTFOLIO LAYOUT OPTIONS
 */
function elbrus_portfolio_layout_options() {
	global $post;
	$post_id = $post;
	if (is_object ( $post_id )) {
		$post_id = $post_id->ID;
	}
	
	$selected_portfolio_type_layout = (get_post_meta ( $post_id, 'pix_portfolio_layout', true ) == "") ? 1 : get_post_meta ( $post_id, 'pix_portfolio_layout', true );
	
	?>

<p>
	<strong><?php echo esc_html__('Portfolio layout', 'elbrus')?></strong>
</p>

<select class="rwmb-select" name="pix_portfolio_layout"
	id="pix_portfolio_layout" size="0">
	<option value="1" <?php if ($selected_portfolio_type_layout == 1):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Default', 'elbrus')?></option>
	<option value="2" <?php if ($selected_portfolio_type_layout == 2):?>
		selected="selected" <?php endif?>><?php echo esc_html__('Full width', 'elbrus')?></option>
</select>

<?php

}

/**
 * END PORTFOLIO LAYOUT OPTIONS
 */
function elbrus_save_postdata($post_id) {
	if (wp_is_post_revision ( $post_id ))
		return;
	
	global $post, $new_meta_boxes;
	
	if (isset ( $new_meta_boxes ))
		foreach ( $new_meta_boxes as $meta_box ) {
			
			if ($meta_box ['type'] != 'title)') {
				
				if ('page' == $_POST ['post_type']) {
					if (! current_user_can ( 'edit_page', $post_id ))
						return $post_id;
				} else {
					if (! current_user_can ( 'edit_post', $post_id ))
						return $post_id;
				}
				
				if (isset ( $_POST [$meta_box ['name']] ) && is_array ( $_POST [$meta_box ['name']] )) {
					$cats = '';
					foreach ( $_POST [$meta_box ['name']] as $cat ) {
						$cats .= $cat . ",";
					}
					$data = substr ( $cats, 0, - 1 );
				} 

				else {
					$data = '';
					if (isset ( $_POST [$meta_box ['name']] ))
						$data = $_POST [$meta_box ['name']];
				}
				
				if (get_post_meta ( $post_id, $meta_box ['name'] ) == "")
					add_post_meta ( $post_id, $meta_box ['name'], $data, true );
				elseif ($data != get_post_meta ( $post_id, $meta_box ['name'], true ))
					update_post_meta ( $post_id, $meta_box ['name'], $data );
				elseif ($data == "")
					delete_post_meta ( $post_id, $meta_box ['name'], get_post_meta ( $post_id, $meta_box ['name'], true ) );
			}
		}
	
	elbrus_save_sidebar_data ( $post_id );
}
function elbrus_save_sidebar_data($post_id) {
	global $post;
	
	if (isset ( $_POST ['pix_page_layout'] )) {
		if (get_post_meta ( $post_id, 'pix_page_layout' ) == "")
			add_post_meta ( $post_id, 'pix_page_layout', $_POST ['pix_page_layout'], true );
		else
			update_post_meta ( $post_id, 'pix_page_layout', $_POST ['pix_page_layout'] );
	}
	
	if (isset ( $_POST ['sidebar_generator'] [0] )) {
		if (get_post_meta ( $post_id, 'pix_page_layout' ) == "")
			add_post_meta ( $post_id, 'pix_selected_sidebar', $_POST ['sidebar_generator'] [0], true );
		else
			update_post_meta ( $post_id, 'pix_selected_sidebar', $_POST ['sidebar_generator'] [0] );
	}
	
	if (isset ( $_POST ['pix_page_header_icon'] )) {
		if (get_post_meta ( $post_id, 'pix_page_header_icon' ) == "")
			add_post_meta ( $post_id, 'pix_page_header_icon', $_POST ['pix_page_header_icon'], true );
		else
			update_post_meta ( $post_id, 'pix_page_header_icon', $_POST ['pix_page_header_icon'] );
	}
	
	if (isset ( $_POST ['pix_page_top_footer_staticblock'] )) {
		if (get_post_meta ( $post_id, 'pix_page_top_footer_staticblock' ) == "")
			add_post_meta ( $post_id, 'pix_page_top_footer_staticblock', $_POST ['pix_page_top_footer_staticblock'], true );
		else
			update_post_meta ( $post_id, 'pix_page_top_footer_staticblock', $_POST ['pix_page_top_footer_staticblock'] );
	}
	
	if (isset ( $_POST ['pix_woo_layout'] )) {
		if (get_post_meta ( $post_id, 'pix_woo_layout' ) == "")
			add_post_meta ( $post_id, 'pix_woo_layout', $_POST ['pix_woo_layout'], true );
		else
			update_post_meta ( $post_id, 'pix_woo_layout', $_POST ['pix_woo_layout'] );
	}
	
	if (isset ( $_POST ['pix_woo_product_display'] )) {
		if (get_post_meta ( $post_id, 'pix_woo_product_display' ) == "")
			add_post_meta ( $post_id, 'pix_woo_product_display', $_POST ['pix_woo_product_display'], true );
		else
			update_post_meta ( $post_id, 'pix_woo_product_display', $_POST ['pix_woo_product_display'] );
	}
	
	if (isset ( $_POST ['pix_page_footer_staticblock'] )) {
		if (get_post_meta ( $post_id, 'pix_page_footer_staticblock' ) == "")
			add_post_meta ( $post_id, 'pix_page_footer_staticblock', $_POST ['pix_page_footer_staticblock'], true );
		else
			update_post_meta ( $post_id, 'pix_page_footer_staticblock', $_POST ['pix_page_footer_staticblock'] );
	}
	
	if (isset ( $_POST ['pix_portfolio_layout'] )) {
		if (get_post_meta ( $post_id, 'pix_portfolio_layout' ) == "")
			add_post_meta ( $post_id, 'pix_portfolio_layout', $_POST ['pix_portfolio_layout'], true );
		else
			update_post_meta ( $post_id, 'pix_portfolio_layout', $_POST ['pix_portfolio_layout'] );
	}
}

add_action ( 'save_post', 'elbrus_save_postdata' );