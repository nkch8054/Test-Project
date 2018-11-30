<?php
function sayidan_shortcode_text( $atts, $content = null ) {
	$atts = shortcode_atts(array(
		"image" => '',
		"title" => '',
		"class" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts);

	ob_start();
	?>

<div class="<?php echo esc_attr( $atts['class'] );?>">
    <?php echo sayidan_fix_shortcode( $content ); ?>
</div>

<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}