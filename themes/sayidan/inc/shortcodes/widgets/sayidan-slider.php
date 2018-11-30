<!--begin slider-->
<div class="slider-hero">
    <div class="sliders-wrap columns1" data-autoplay="<?php echo esc_attr( $instance['auto_play'] ); ?>" data-loop="<?php echo esc_attr( $instance['loop'] ); ?>" data-autoplaytimeout="<?php echo esc_attr( $instance['autoplay_timeout'] ); ?>" >
        
        <?php $i = 0;
        foreach( $instance['a_repeater'] as $item ){
            
            $i++;
            //visibility
            if ( $item['visibility'] == '' ){ 

                $image_url = "";
                if ( $item['image'] != '' ){
                    $image_url = wp_get_attachment_image_src( $item['image'], "full", false );
                }
                ?>

                <div class="item">
                    <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
                    <div class="owl-caption">
                        <div class="container">
                            <div class="content-block">
                                <h2>
                                    <span class="text-bold"><?php echo esc_attr( $item['title'] ); ?></span> <br />
                                    <span class="text-light"><?php echo esc_attr( $item['subtitle'] ); ?></span>
                                </h2>
                                <a href="<?php echo esc_attr( $item['button_url'] ); ?>" class="bnt bnt-theme read-story"><?php echo esc_attr( $item['button_text'] ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
        } ?>

    </div>
</div>
<!--end slider-->
