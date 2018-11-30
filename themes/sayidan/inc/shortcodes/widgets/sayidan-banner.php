<?php 

$image_url = "";
if ( $instance['image'] != '' ){
    $image_url = wp_get_attachment_image_src($instance['image'],"full",false);
}
$title = $instance['title'];
$subtitle = $instance['subtitle'];
$text = $instance['text'];
$button_text = $instance['button_text'];
$button_url = $instance['button_url'];
$image = $image_url[0];


?>



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