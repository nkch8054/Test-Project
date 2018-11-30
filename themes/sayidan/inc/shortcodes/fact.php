<?php
function sayidan_shortcode_fact( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"title" => '',
		"text1" => '',
		"text2" => '',
		"text3" => '',
        "class" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin newsletter-->
<div class="sayidan-fact <?php echo esc_attr( $class );?>">
    <h4 class="heading-bold"><?php echo esc_attr( $title ); ?></h4>
    <?php if ( $text1 ) { echo '<p>'.esc_attr( $text1 ).'</p>'; } ?>
    <?php if ( $text2 ) { echo '<p>'.esc_attr( $text2 ).'</p>'; } ?>
    <?php if ( $text3 ) { echo '<p>'.esc_attr( $text3 ).'</p>'; } ?>
</div>

<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
