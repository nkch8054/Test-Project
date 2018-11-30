<?php
function sayidan_shortcode_our_story_item($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => null,
		"year" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin newsletter-->
<li>
    <span class="history-title text-light"><?php echo esc_attr( $title )."<br>"; if( $subtitle ){ echo esc_attr( $subtitle ); }else{ echo "<br>"; } ?></span>
    <span class="history-dot"> <span></span></span>
    <span class="history-year"><?php echo esc_attr( $year ); ?></span>
</li>
<!--end newsletter-->


<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
