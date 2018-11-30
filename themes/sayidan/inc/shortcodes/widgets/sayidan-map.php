<?php $image_url = "";
if ( $instance['image'] != '' ){
    $image_url = wp_get_attachment_image_src($instance['image'],"full",false);
} ?>

<!--begin map-->
<div id="contacts" class="map">
    <div class="container">
        <div class="title-page text-center">
            <h2 class="text-regular"><?php echo esc_attr( $instance['title'] ); ?></h2>
            <p class="text-light"><?php echo esc_attr( $instance['subtitle'] ); ?></p>
        </div>
        <div class="map-content">
            <img class="img-responsive" src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( $instance['title'] ); ?>">
        </div>
    </div>
</div>
<!--end map-->