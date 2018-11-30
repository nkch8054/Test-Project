<?php
    function sayidan_shortcode_sliders_item( $atts, $content = null ) {
        extract(shortcode_atts(array(
             "type" => '',
             "image" => '',
             "title" => '',
             "subtitle" => '',
             "text" => '',
             "placeholder" => '',
             "button_text" => '',
             "button_url" => '',
             ), $atts));
             
             ob_start();
    ?>

<?php if ( $type == 'alumni_stories' ) : ?>

<?php elseif ( $type == 'alumni_home' ) : ?>

<div class="item">
    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
    <div class="owl-caption">
        <div class="container">
            <div class="content-block">
                <h2>
                    <span class="text-bold"><?php echo esc_attr( $title ); ?></span> <br />
                    <span class="text-light"><?php echo esc_attr( $subtitle ); ?></span>
                </h2>
                <a href="<?php echo esc_attr( $button_url ); ?>" class="bnt bnt-theme read-story"><?php echo esc_attr( $button_text ); ?></a>
            </div>
        </div>
    </div>
</div>

<?php
    endif;
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }