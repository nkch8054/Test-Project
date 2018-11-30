<?php

// [sayidan_slider]
function sayidan_shortcode_slider( $atts, $content=null ) {

    extract( shortcode_atts( array(
        'timer' => '6000',
        'bullets' => 'true',
        'auto_slide' => 'true',
        'slide_align' => 'center',
        'arrows' => 'circle',
        'style' => 'normal',
        'nav_pos' => 'inside',
        'nav_color' => 'light',
        'infinitive' => 'true',
        'freescroll' => 'false',
        'margin' => '',
        'padding' => '',
        'columns' => '1',
        'friction' => '0.6',
        'selectedattraction' => '0.1',
        'height' => '',
        'rtl' => 'false',
        'draggable' => 'true',
        'mobile' => 'true'

    ), $atts ) );

    ob_start();

    $slider_classes = '';
    if($mobile  !==  'true') {$slider_classes = 'hide-for-small';}
    if(is_rtl()) $rtl = 'true';
    if($auto_slide == 'true') $auto_slide = $timer;

    // Slider Nav visebility
    $is_arrows = 'true';
    $is_bullets = 'true';

    if($arrows == 'false') $is_arrows = 'false';
    if($arrows == 'true') $arrows = 'circle';
    if($bullets == 'false') $is_bullets = 'false';

    $css = '';
    // Custom CSS
    if($margin){
        $css = 'margin-bottom:'.$margin.'!important';
    }

    ?> 
<div class="slider-wrapper relative">
    <div class="slider iosSlider <?php echo esc_attr( $slider_classes ); ?> slider-style-<?php echo esc_attr( $style );?>  slider-nav-<?php echo esc_attr( $nav_color );?> slider-nav-<?php echo esc_attr( $nav_pos ); ?> slider-nav-<?php echo esc_attr( $arrows );?> js-flickity"
        data-flickity-options='{ 
            "cellAlign": "<?php echo esc_attr( $slide_align ); ?>",
            "imagesLoaded": true,
            "lazyLoad": 1,
            "freeScroll": <?php echo esc_attr( $freescroll ); ?>,
            "wrapAround": <?php echo esc_attr( $infinitive ); ?>,
            "autoPlay": <?php echo esc_attr( $auto_slide );?>,
            "prevNextButtons": <?php echo esc_attr( $is_arrows ); ?>,
            "contain" : true,
            "percentPosition": true,
            "pageDots": <?php echo esc_attr( $is_bullets ); ?>,
            "selectedAttraction" : <?php echo esc_attr( $selectedattraction ); ?>,
            "friction": <?php echo esc_attr( $friction ); ?>,
            "rightToLeft": <?php echo esc_attr( $rtl ); ?>,
            "draggable": <?php echo esc_attr( $draggable ); ?>
        }'
        style="<?php echo esc_attr( $css );?>"
        >
        <?php echo sayidan_fix_shortcode($content); ?>
     </div>
    <div class="loading dark"></div>
</div>

<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}