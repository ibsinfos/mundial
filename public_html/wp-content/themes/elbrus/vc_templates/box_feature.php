<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $icon_pixstrokegap
 * @var $icon_pixflaticon
 * @var $icon_pixfontawesome
 * @var $icon_pixelegant
 * @var $icon_pixicomoon
 * @var $icon_pixsimple
 * @var $icon_fontawesome
 * @var $icon_openiconic
 * @var $icon_typicons
 * @var $icon_entypo
 * @var $icon_linecons
 * @var $title
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_Box_Feature
 */
$type = $icon_pixstrokegap = $icon_pixflaticon = $icon_pixfontawesome =
$icon_pixelegant = $icon_pixicomoon = $icon_pixsimple = $icon_fontawesome =
$icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

$title = $link = $link_title = $link_icon = $css_animation = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$out = '';
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );
$icon = isset( ${"icon_" . $type} ) ? esc_attr( ${"icon_" . $type} ) : '';

$href = vc_build_link( $link );
if ( strlen( $href['url'] ) > 0 ) {
	$a_target = strlen( $href['target'] ) > 0 ? $href['target'] : '_self';
	$link_title = '<a href="'.esc_url($href['url']).'" title="'.esc_attr($href['title']).'" target="'.esc_attr($a_target).'">'.wp_kses_post($title).'</a>';
	$link_icon = '<a href="'.esc_url($href['url']).'" title="'.esc_attr($href['title']).'" target="'.esc_attr($a_target).'"><span class="'.esc_attr($icon).'"></span></a>';
} else {
	$link_title = $title;
	$link_icon = '<span class="'.esc_attr($icon).'"></span>';
}

$css_animation_class = $css_animation != '' ? ' wow ' . $css_animation : '';
$fullcontent = ($content == "") ? "" : '<div class="text">'.do_shortcode($content).'</div>';

$out .= '

	<div class="feature-item '. esc_attr($css_animation_class) . '">
		<div class="wrap-feature-icon">
			<div class="feature-icon">
				'.wp_kses_post($link_icon).'
			</div>
		</div>
		<div class="title">'.wp_kses_post($link_title).'</div>
		'.$fullcontent.'
	</div>
';

echo $out;