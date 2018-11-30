<?php
function sayidan_shortcode_header( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin about us-->
<div class="about-us" >
    <div class="about-us-title text-center" style="background-image: url('<?php echo esc_url( $image ); ?>');">
        <div class="container">
            <h1 class="heading-bold text-uppercase"><?php echo esc_attr( $title ); ?></h1>
        </div>
    </div>
    <div class="about-us-content">
        <div class="container">
            <div class="content-wrapper">
                <?php echo sayidan_fix_shortcode( $content ); ?>
            </div>
        </div>
    </div>
</div>
<!--end about us-->


<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}