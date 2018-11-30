<?php
function sayidan_shortcode_newsletter($atts, $content = null) {

	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

    <!--begin newsletter-->
    <div class="newsletter newsletter-parallax type2" data-parallax="scroll" data-image-src="<?php echo esc_url( $image ); ?>">
        <div class="container">
            <div class="newsletter-wrapper text-center">
                <div class="newsletter-title">
                    <h2 class="heading-light"><?php echo esc_attr( $title ); ?></h2>
                    <p class="text-light"><?php echo esc_attr( $subtitle ); ?></p>
                </div>
                <form name="subscribe-form" target="_blank" class="form-inline">
                    <input type="text" class="form-control text-center form-text-light" name="EMAIL" value="" placeholder="<?php echo esc_attr( $placeholder ); ?>" >
                    <button type="submit" class="button bnt-theme"><?php echo esc_attr( $button_text ); ?></button>
                </form>
            </div>
        </div>
    </div>
    <!--end newsletter-->


    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
