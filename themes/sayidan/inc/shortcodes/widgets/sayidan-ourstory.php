
<!--begin our history-->
<div class="our-history">
    <div class="container">
        <div class="title-page text-center">
            <h2 class="text-regular"><?php echo esc_attr( $instance['title'] ); ?></h2>
            <p class="text-light"><?php echo esc_attr( $instance['subtitle'] ); ?></p>
        </div>
        <div class="history-content">
            <ul class="list-history text-center">
               
                <?php $i = 0;
                foreach( $instance['a_repeater'] as $item ){
                    
                    $i++;
                    //visibility
                    if ( $item['visibility'] == '' ){ ?>

                        <!--begin newsletter-->
                        <li>
                            <span class="history-title text-light"><?php echo esc_attr( $item['title'] )."<br>"; if( $item['subtitle'] ){ echo esc_attr( $item['subtitle']); }else{ echo "<br>"; } ?></span>
                            <span class="history-dot"> <span></span></span>
                            <span class="history-year"><?php echo esc_attr( $item['year'] ); ?></span>
                        </li>
                        <!--end newsletter-->

                    <?php }
                } ?>

            </ul>
        </div>
    </div>
</div>
<!--end our history-->
