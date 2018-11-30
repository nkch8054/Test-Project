<!--begin alumni dashboard-->
<div class="alumni-dashboard">
    <div class="container">
        <div class="title title-dashboard type1">
            <h3 class="heading-light no-margin"><?php echo esc_attr( $instance['title'] ); ?></h3>
        </div>
        <div class="area-content">
            <div class="row">
                
                <?php $i = 0;
                foreach( $instance['a_repeater'] as $item ){
                    
                    $i++;
                    //visibility
                    if ( $item['visibility'] == '' ){  ?>

                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="<?php echo esc_attr( $item['icon'] ); ?>"></div>
                            <div class="box-content">
                                <h4 class="heading-regular"><?php echo esc_attr( $item['title'] ); ?></h4>
                                <p class="text-content text-margin text-light ">
                                    <?php echo esc_attr( $item['text'] ); ?>
                                </p>
                            </div>
                        </div>

                    <?php }
                } 

                if( $instance['button_text'] ) : ?>
                    <div class="login-dashboard text-center col-sm-12 col-xs-12">
                        <a href="<?php echo esc_attr( $instance['button_url'] ); ?>" class="bnt bnt-theme login-links"><?php echo esc_attr( $instance['button_text'] ); ?></a>
                    </div>
                <?php endif;  ?>
            </div>
        </div>
    </div>
</div>
<!--end alumni dashboard-->
