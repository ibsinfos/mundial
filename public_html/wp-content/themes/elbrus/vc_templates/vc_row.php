<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = '';
$disable_element = '';
$output = $after_output = $paralax_fix_before = $paralax_fix_after = $bg_image_src = $class_slider = $pix_bg_class = $pix_bg_color = $pix_decor_class = $pix_gradient = $pix_gradient_style = $pix_gradient_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
if ( function_exists('fil_init') ) {
	$picon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';
}

$class_preset_text = ($ptextcolor) ? $ptextcolor : '';
if ( $ptextcolor == 'text-default' ) {
	$class_preset_text = '';
}

$class_bg = $bgstyle == 'attachment' && !empty($bgimage) ? 'background-attachment-fixed' : '';
$jarstretch = $jarstretch == '' ? 'No' : $jarstretch;
if( !empty($bgimage) ){
	$bg_image_id = preg_replace( '/[^\d]/', '', $bgimage );
	$bg_image_src = wp_get_attachment_image_src( $bg_image_id, 'full' );
	if ( ! empty( $bg_image_src[0] ) ) {
		$bg_image_src = $bg_image_src[0];
	}
}

$class_bottom_effect = ($pix_bottom_effect) ? $pix_bottom_effect : '';

wp_enqueue_script( 'wpb_composer_front_js' );
$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$ppadding,
	$class_preset_text,
	$class_bottom_effect,
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) && empty($bgstyle) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
	$paralax_fix_before = '<div class="anchor-parallax-fix">';
	$paralax_fix_after = '</div> <!-- END anchor-parallax-fix -->';
}

if ( ! empty( $parallax_image ) && empty($bgimage) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div class="vc_row_anchor js_stretch_anchor '.esc_attr( $panchor ).'">';
if ( ( $panchor == "anchor-simple" || $panchor == "anchor-effect" ) && isset( $el_id ) && ! empty( $el_id ) ) {
	if ( function_exists('fil_init') && $picon != '' ) {
		$output .= '
		<div class="wrap-anchor">
			<a class="wrap-anchor-link" href="#'.esc_attr( $el_id ).'"><div class="section-icon"><span class="'.esc_attr( $picon ).'"></span></div></a>
		</div>';
	} else {
		$output .= '
		<div class="wrap-anchor">
			<a class="wrap-anchor-link" href="#'.esc_attr( $el_id ).'"><div class="section-icon"></div></a>
		</div>';
	}

} elseif ( function_exists('fil_init') && $picon != '' ) {
	$output .= '
	<div class="wrap-anchor">
		<div class="section-icon"><span class="'.esc_attr( $picon ).'"></span></div>
	</div>
	';
}
$output .= '</div>';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $pixoverlay && strlen($pixoverlay) ) {
	$ovOpacity = ( $pixoverlayopacity && is_numeric($pixoverlayopacity) && $pixoverlayopacity >= 0.1 && $pixoverlayopacity <= 0.9 ) ? $pixoverlayopacity : "0.1";
	$output .= '<span class="vc_row-overlay" style="background-color: rgba(0,0,0,'.$ovOpacity.') !important;"></span>';
}
if ( $pix_bottom_effect == 'with-bottom-effect transparent-effect' || $pix_bottom_effect == 'with-bottom-effect' ) {
	$output .= '<div class="bottom-effect"></div>';
}

if($bgstyle == 'jarallax' && !empty($bgimage) ){
	wp_enqueue_script( 'jarallax' );
	$class_jarallax = $class_jarallax_inner = '';
	if ( ! empty( $full_width ) ) {
		$class_jarallax = 'jarallax-full-width';
		if ( 'stretch_row_content' === $full_width ) {
			$class_jarallax = 'jarallax-full-width-content';
		} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
			$class_jarallax = 'jarallax-full-width-content-no-padding';
		}
	}
	$class_jarallax_inner = ! empty( $full_width ) && $jarstretch == "No" ? 'container' : 'jarallax-content-inner';
	$output .= '<div class="jarallax '.esc_attr($class_jarallax).'"';
	$arr_jarallax = array();
	if($jartype != 'Default' && $jartype != '')
		$arr_jarallax['type'] = $jartype;
	if($jarspeed != '')
		$arr_jarallax['speed'] = $jarspeed;
	if(empty($arr_jarallax))
		$arr_jarallax['speed'] = '0.2';
	$output .= ' data-jarallax=\''.json_encode($arr_jarallax).'\''; // parallax image
	$output .= ' style="background-image:url(' . esc_attr($bg_image_src) . ')"'; // parallax image
	$output .= '>
	<div class="jarallax-content">
		<div class="'.esc_attr($class_jarallax_inner).'">';
}elseif(!empty($bgimage)){
	$output .= '<div class="'.esc_attr($class_bg).'" style="background-image:url(' . esc_attr($bg_image_src) . ')">';
}

$gradient_colors = vc_param_group_parse_atts( $atts['gradient_colors'] );
if(isset($gradient_colors[0]['gradient_color']) && $gradient_colors[0]['gradient_color'] != ''){
	$pix_gradient_class = 'pix_gradient_colors_'.rand();
	$gradient_direction = $gradient_direction == '' ? 'to right' : $gradient_direction;
	$gradient_angle = $gradient_angle == '' ? '90' : $gradient_angle;
	$pix_directions_arr = array(
			'to right' => array('-webkit' => 'left', '-o-linear' => 'right', '-moz-linear' => 'right', 'linear' => 'to right',),
			'to left' => array('-webkit' => 'right', '-o-linear' => 'left', '-moz-linear' => 'left', 'linear' => 'to left',),
			'to bottom' => array('-webkit' => 'top', '-o-linear' => 'bottom', '-moz-linear' => 'bottom', 'linear' => 'to bottom',),
			'to top' => array('-webkit' => 'bottom', '-o-linear' => 'top', '-moz-linear' => 'top', 'linear' => 'to top',),
			'to bottom right' => array('-webkit' => 'left top', '-o-linear' => 'bottom right', '-moz-linear' => 'bottom right', 'linear' => 'to bottom right',),
			'to bottom left' => array('-webkit' => 'right top', '-o-linear' => 'bottom left', '-moz-linear' => 'bottom left', 'linear' => 'to bottom left',),
			'to top right' => array('-webkit' => 'left bottom', '-o-linear' => 'top right', '-moz-linear' => 'top right', 'linear' => 'to top right',),
			'to top left' => array('-webkit' => 'right bottom', '-o-linear' => 'top left', '-moz-linear' => 'top left', 'linear' => 'to top left',),
			'angle' => array('-webkit' => $gradient_angle.'deg', '-o-linear' => $gradient_angle.'deg', '-moz-linear' => $gradient_angle.'deg', 'linear' => $gradient_angle.'deg',),

	);
	$gradient_opacity = $gradient_opacity == '' ? 1 : $gradient_opacity;
	foreach($gradient_colors as $val){
		$pix_gradient .= ','.$val['gradient_color'];
	}
	$pix_gradient_style = $pix_gradient == '' && isset($pix_directions_arr[$gradient_direction]) ? '' : '
jQuery(function($){
    $("head").append("<style>.vc_row-overlay.'.$pix_gradient_class.'{background: '.esc_attr($gradient_colors[0]['gradient_color']).';background: -webkit-linear-gradient('.$pix_directions_arr[$gradient_direction]['-webkit'].esc_attr($pix_gradient).');background: -o-linear-gradient('.$pix_directions_arr[$gradient_direction]['-o-linear'].esc_attr($pix_gradient).');background: -moz-linear-gradient('.$pix_directions_arr[$gradient_direction]['-moz-linear'].esc_attr($pix_gradient).');background: linear-gradient('.$pix_directions_arr[$gradient_direction]['linear'].esc_attr($pix_gradient).');opacity:'.esc_attr($gradient_opacity).';}</style>");
});
';
}
wp_add_inline_script( 'elbrus-custom', $pix_gradient_style );
if( $pix_gradient_class != '') {
	$output .= '<span class="vc_row-overlay ' . esc_attr($pix_gradient_class) . '" ></span>';
}else{
	$decor_dg = preg_split('/\{/', $css);
	preg_match_all( '/{([^\}]+)/i', $css, $matches, PREG_OFFSET_CAPTURE );
	if(isset($matches[1][0][0])){
		foreach( explode( ';', $matches[1][0][0] ) as $val ){
			if( substr_count($val, 'background')>0 && substr_count($val, 'rgba')>0 ){
				foreach( explode( ' ', $val ) as $val_exp ){
					if( substr_count($val_exp, 'rgba')>0 ){
						$output .= '<span class="vc_row-overlay" style="background-color: '.$val_exp.' !important;"></span>';
					}
				}
			}
			if( substr_count($val, 'background')>0 && substr_count($val, '#')>0 ){
				foreach( explode( ' ', $val ) as $val_exp ){
					if( substr_count($val_exp, '#')>0 ){
						$pix_sep_element = isset($decor_dg[0]) ? '
jQuery(function($){
    $("head").append("<style> '.$decor_dg[0]. ' .section-heading.white-heading .sep-element:after{ background: '.$val_exp.';}</style>");
});' : '';
						wp_add_inline_script( 'elbrus-custom', $pix_sep_element );
					}
				}
			}
		}
	}
}

$output .= wpb_js_remove_wpautop( $content );

if( $bgstyle == 'jarallax' ){
	$output .= '</div></div>';
}
if( !empty($bgimage) ){
	$output .= '</div>';
}

$output .= '</div>';
$output .= $after_output;

echo $output;