<?php
function sayidan_shortcode_newsletter( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"image"         => '',
		"title"         => '',
		"subtitle"      => '',
		"placeholder"   => '',
		"button_text"   => '',
        "parallax"      => 'true',
        "form_id"       => ''
	), $atts));

	ob_start();
	?>

    <!--begin newsletter-->
<div class="newsletter <?php if ( 'true' == $parallax ) { echo 'newsletter-parallax'; }else{ echo 'newsletter-noparallax'; } ?> type2" <?php if ( 'true' == $parallax ) { echo 'data-parallax="scroll"'; } ?> data-image-src="<?php echo esc_url( $image ); ?>" <?php if ( 'false' == $parallax ) { echo 'style="background: url(\'' . ( $image ) . '\') no-repeat; background-size: cover;"'; } ?> >
        <div class="container">
            <div class="newsletter-wrapper text-center">
                <div class="newsletter-title">
                    <h2 class="heading-light"><?php echo esc_attr( $title ); ?></h2>
                    <p class="text-light"><?php echo esc_attr( $subtitle ); ?></p>
                </div>
                <?php echo do_shortcode('[mc4wp_form id="' . esc_attr( $form_id ) . '"]');?>
            </div>
        </div>
    </div>
    <!--end newsletter-->


    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}