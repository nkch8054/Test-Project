<?php

function sayidan_shortcode_contact( $atts, $content=null ) {

    shortcode_atts( array(
        "type"  => '',
        "title" => '',
        "address_part1" => '',
        "address_part2" => '',
        "text" => '',
        "icon_row1" => '',
        "icon_row2" => '',
        "form_id" => '',
        "email" => '',
        "phone" => '',
        "phone_nice" => '',
        "latitude" => '',
        "longitude" => '',
        "balloon" => '',
        "type"  => 'balloon',
        "zoom"  => '15',
        "hue"  => '-80',
        "saturation"  => '#ccc',
    ), $atts );

    ob_start();

    $icon_row1 = '';
    if( '' != $atts['icon_row1'] ){
        $icon_row1 = get_template_directory_uri() .'/images/'.$atts['icon_row1'];
    }

    $icon_row2 = '';
    if( '' != $atts['icon_row2'] ){
        $icon_row2 = get_template_directory_uri() .'/images/'.$atts['icon_row2'];
    }
    $sayidan_enable_map = true;
    ?> 

    <div class="main-container">
        <div class="page-main contact-us">
            <div class="map-contact">
                <div id="map" data-latitude="<?php echo esc_attr( $atts['latitude'] ); ?>" data-longitude="<?php echo esc_attr( $atts['longitude'] ); ?>" data-balloon="<?php echo esc_attr( $atts['balloon'] ); ?>" data-pointer="<?php echo esc_attr( $atts['type'] ); ?>" data-saturation="<?php echo esc_attr( $atts['saturation'] ); ?>" data-hue="<?php echo esc_attr( $atts['hue'] ); ?>" data-zoom="<?php echo esc_attr( $atts['zoom'] ); ?>"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="map-info">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="title-visit">
                                        <h3 class="font-montserrat-light font25 text-capitalize"> <?php echo esc_attr( $atts['title1'] ); ?> </h3>
                                    </div>
                                    <div class="content-visit">
                                        <p class="font-montserrat-light font17"> <?php echo esc_attr( $atts['address'] ); ?>  </p>
                                        <a href="<?php echo esc_url( $atts['btn_link1'] ); ?>" class="link-contact link-visit font-montserrat-light font17 text-capitalize"> <?php echo esc_attr( $atts['btn_text1'] ); ?></a>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="title-touch">
                                        <h3 class="font-montserrat-light font25 text-capitalize"> <?php echo esc_attr( $atts['title2'] ); ?> </h3>
                                    </div>
                                    <div class="content-touch">
                                        <div class="content-telp">
                                            <span class="font-montserrat-light font17 text-uppercase"><?php esc_html_e( 'tel', 'sayidan' ); ?></span>
                                            <a href="tel:+6274668877" class="font-montserrat-light font17"><?php echo esc_attr( $atts['phone'] ); ?></a>
                                        </div>
                                        <div class="content-mail">
                                            <span class="font-montserrat-light font17 text-uppercase"><?php esc_html_e( 'email', 'sayidan' ); ?></span>
                                            <a href="mailto:hello@sayidan.store" class="font-montserrat-light font17"><?php echo esc_attr( $atts['email'] ); ?> </a>
                                        </div>
                                        <div class="content-address">
                                            <a href="<?php echo esc_url( $atts['btn_link2'] ); ?>" class="link-contact link-touch font-montserrat-light font17"> <?php echo esc_attr( $atts['btn_text2'] ); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <?php echo do_shortcode( '[contact-form-7 id="'. esc_attr( $atts['form_id'] ) .'" title="Contact us form"]' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="separates"></div>
    </div>

    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}