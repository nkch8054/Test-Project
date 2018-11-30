<?php
function sayidan_shortcode_our_story( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin our history-->
<div class="our-history">
    <div class="container">
        <div class="title-page text-center">
            <h2 class="text-regular"><?php echo esc_attr( $title ); ?></h2>
            <p class="text-light"><?php echo esc_attr( $subtitle ); ?></p>
        </div>
        <div class="history-content">
            <ul class="list-history text-center">
                <?php echo sayidan_fix_shortcode($content); ?>
            </ul>
        </div>
    </div>
</div>
<!--end our history-->


<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
