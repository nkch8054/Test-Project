<?php
function sayidan_shortcode_sliders($atts, $content = null) {
	extract(shortcode_atts(array(
        "type" => '',
		"image" => '',
		"title" => '',
		"subtitle" => '',
        "text" => '',
        "auto_play" => '',
        "loop" => '',
        "autoplay_timeout" => '',
		"placeholder" => '',
		"button_text" => '',
        "button_url" => '',
	), $atts));

	ob_start();
	?>

    <?php if ( $type == 'alumni_stories' ) : ?>

    <!--begin alumni stories-->
    <div class="alumni-interview" style="background: url('<?php echo esc_url( $image ); ?>') no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12 pull-right">
                    <div class="interview-wrapper">
                        <div class="interview-title animated lightSpeedIn">
                            <h4 class="heading-light text-capitalize"><?php echo esc_attr( $title ); ?></h4>
                            <h1 class="heading-light text-capitalize"><?php echo esc_attr( $subtitle ); ?></h1>
                        </div>
                        <div class="interview-desc text-left animated rollIn">
                            <p class="text-light"><?php echo esc_attr( $text ); ?></p>
                        </div>
                        <div class="interview-see-story animated zoomInLeft">
                            <a class="see-story bnt text-uppercase" href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_attr( $button_text ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <!--end alumni stories-->

    <?php elseif ( $type == 'alumni_home' ) : ?>

    <!--begin slider-->
    <div class="slider-hero">
        <div class="sliders-wrap columns1" data-autoplay="<?php echo esc_attr( $auto_play ); ?>" data-loop="<?php echo esc_attr( $loop ); ?>" data-autoplaytimeout="<?php echo esc_attr( $autoplay_timeout ); ?>" >
            
            <?php echo sayidan_fix_shortcode( $content ); ?>
            
        </div>
    </div>
    <!--end slider-->

    <?php
    endif;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
