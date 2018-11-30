<?php
function sayidan_shortcode_header_texts( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"class" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin texts-->
<p class="<?php echo esc_attr( $class ); ?>">
<?php echo esc_html( $content ); ?>
</p>
<!--end texts-->

<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}