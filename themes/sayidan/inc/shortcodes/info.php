<?php
function sayidan_shortcode_info($atts, $content = null) {
	extract(shortcode_atts(array(
		"title"         => '',
		"button_url"    => '',
		"button_text"   => ''
	), $atts));

	ob_start();
	?>

    <!--begin alumni dashboard-->
    <div class="alumni-dashboard">
        <div class="container">
            <div class="title title-dashboard type1">
                <h3 class="heading-light no-margin"><?php echo esc_attr( $title ); ?></h3>
            </div>
            <div class="area-content">
                <div class="row">
                    <?php echo sayidan_fix_shortcode( $content );
                    if( $button_text ) : ?>
                        <div class="login-dashboard text-center col-sm-12 col-xs-12">
                            <a href="<?php echo esc_attr( $button_url ); ?>" class="bnt bnt-theme login-links"><?php echo esc_attr( $button_text ); ?></a>
                        </div>
                    <?php endif;  ?>
                </div>
            </div>
        </div>
    </div>
    <!--end alumni dashboard-->

    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function sayidan_shortcode_info_item( $atts, $content = null ) {
    extract(shortcode_atts(array(
         "image"        => '',
         "title"        => '',
         "text"         => '',
         "icon"   => ''
    ), $atts));
         
    ob_start();
    ?>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="<?php echo esc_attr( $icon ); ?>"></div>
        <div class="box-content">
            <h4 class="heading-regular"><?php echo esc_attr( $title ); ?></h4>
            <p class="text-content text-margin text-light ">
                <?php echo esc_attr( $text ); ?>
            </p>
        </div>
    </div>

    <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
}
