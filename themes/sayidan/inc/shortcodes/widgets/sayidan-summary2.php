<?php
    $image_url = "";
    if ( $instance['image'] != '' ){
        $image_url = wp_get_attachment_image_src($instance['image'],"full",false);
    }
?>

<!--begin programs & services-->
<div class="programs-services">
    <div class="container">
        <div class="row">
            <div class="services-img col-md-6 col-sm-12 col-xs-12">
                <img class="img-responsive" src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( $instance['title'] ); ?>">
            </div>
            <div class="services-content col-md-6 col-sm-12 col-xs-12">
                <h2 class="heading-regular"><?php echo esc_attr( $instance['title'] ); ?></h2>
                <div id="tab_services">
                    <!--Nav tabs-->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php $i = 0;
                        foreach( $instance['a_repeater'] as $item ){
                            
                            $i++;
                            //visibility
                            if ( $item['visibility'] == '' ){ ?>
                                <li role="presentation" <?php if ( $i==1 ){ echo 'class="active"'; } ?> >
                                    <a class="text-light" href="#tab<?php echo esc_attr( $i );?>" aria-controls="tab<?php echo esc_attr( $i );?>" role="tab" data-toggle="tab"><?php echo esc_attr( $item['title'] ); ?></a>
                                </li>
                                <?php
                            }
                        } ?>
                    </ul>
                    <div class="tab-content">
                        <?php $i = 0;
                        foreach( $instance['a_repeater'] as $item ){
                                
                            $i++;
                            //visibility
                            if ( $item['visibility'] == '' ){ ?>
                            <!--Tab panes-->
                            <div role="tabpanel" class="tab-pane <?php if ( $i==1 ){ echo 'active'; } ?> animated zoomIn" id="tab<?php echo esc_attr( $i ); ?>">
                                <div class="tab-content-wrapper">
                                    <?php echo wp_kses( $item['content'], array(
                                        'a' => array(
                                                     'href' => array(),
                                                     'title' => array()
                                                     ),
                                        'ul' => array(
                                                      'class' => array(),
                                                      'id' => array()
                                                      ),
                                        'li' => array(),
                                        'strong' => array(),
                                        'b' => array(),
                                        'p' => array(),
                                        ), "" ); ?>
                                </div>
                            </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end programs & services-->
