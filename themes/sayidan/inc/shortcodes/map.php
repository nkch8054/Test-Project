<?php
function sayidan_shortcode_map($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"image" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin map-->
<div id="contacts" class="map">
    <div class="container">
        <div class="title-page text-center">
            <h2 class="text-regular"><?php echo esc_attr( $title ); ?></h2>
            <p class="text-light"><?php echo esc_attr( $subtitle ); ?></p>
        </div>
        <div class="map-content">
            <img class="img-responsive" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
        </div>
    </div>
</div>
<!--end map-->

<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

