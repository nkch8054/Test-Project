<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sayidan
 */

?>

<?php
    $meta = get_post_meta( get_the_ID() );
    $posttags = get_the_tags( get_the_ID() );
    $role_arr = array(
                      '-1'       => esc_html__( 'Not specified', 'sayidan' ),
                      '0'       => esc_html__( 'Practice', 'sayidan' ),
                      '1'       => esc_html__( 'Full-Time', 'sayidan' ),
                      '2'       => esc_html__( 'Part-Time', 'sayidan' ),
                      '3'       => esc_html__( 'Freelance', 'sayidan' ),
                      '4'       => esc_html__( 'Contract', 'sayidan' ),
                      );
                      
    $rate_arr = array(
                    '-1'       => esc_html__( 'Not specified', 'sayidan' ),
                    '0'       => esc_html__( '< $20,000', 'sayidan' ),
                    '1'       => esc_html__( '$20,000 - $50,000', 'sayidan' ),
                    '2'       => esc_html__( '$50,000 - $100,000', 'sayidan' ),
                    '3'       => esc_html__( '$100,000 - $150,000', 'sayidan' ),
                    '4'       => esc_html__( '$150,000 - $200,000', 'sayidan' ),
                    '5'       => esc_html__( '> $200,000', 'sayidan' ),
                    );
    ?>
    <!--begin job detail-->
    <div class="job-detail">
        <div class="container">
            <div class="brand">
                <div class="brand-log">
                    <?php the_post_thumbnail( 'sayidan-story', array( 'class' => 'img-responsive' ) ); ?>
                </div>
                <div class="brand-content">
                    <h2 class="heading-regular"><?php echo the_title(); ?></h2>
                    <?php if ( isset( $meta['_link'] ) ){ echo '<a href="' .  esc_url( $meta['_link'][0] ) . '" class="website text-light">' . esc_attr( $meta['_link'][0] ); } ?></a>
                </div>
            </div>
            <div class="aplly">
                <a href="<?php if ( isset( $meta['_apply'] ) ){ echo esc_url( $meta['_apply'][0] ); } ?>" class="bnt-theme text-uppercase text-center text-regular"><?php esc_html_e( 'Apply', 'sayidan' ); ?></a>
            </div>
            <div class="about-company clearfix">
                <div class="job-detail-title">
                    <h5 class="heading-regular text-capitalize"><?php esc_html_e( 'About Company', 'sayidan' ); ?></h5>
                </div>
                <div class="about-company-content">
                    <div class="info">
                        <?php if ( isset( $meta['_location']) ) : ?>
                        <span class="budding">
                            <span class="icon budding-icon"></span>
                            <span class="text-content text-light"><?php echo esc_attr( $meta['_location'][0] ); ?></span>
                        </span>
                        <?php endif; ?>
                        <?php if ( isset( $meta['_applications']) ) : ?>
                            <span class="paper">
                                <span class="icon paper-icon"></span>
                                <span class="text-content text-light"><?php echo esc_attr( $meta['_applications'][0] ); ?></span>
                            </span>
                        <?php endif; ?>
                        <span class="clock">
                            <span class="icon clock-icon"></span>
                            <span class="text-content text-light"><?php echo esc_html__( 'online', 'sayidan') . ': ' . sayidan_human_timing( get_post_time( 'U', true ) ); ?></span>
                        </span>
                    </div>
                    <div class="desc">
                        <p><?php if ( isset( $meta['_desc'] ) ){ echo esc_attr( $meta['_desc'][0] ); } ?></p>
                    </div>
                </div>
            </div>
            <div class="jobs clearfix">
                <div class="job-detail-title">
                    <h5 class="heading-regular text-capitalize"><?php esc_html_e( 'Job Details', 'sayidan' ); ?></h5>
                </div>
                <div class="jobs-content">
                    <h5 class="heading-bold"><?php echo esc_attr( $meta['_position'][0] ); ?></h5>
                    <div class="price">
                        <span class="icon star-icon"></span>
                        <span class="text-price"><?php if ( isset( $meta['_rate'] ) ){ echo esc_html( $rate_arr[esc_attr( $meta['_rate'][0] )] ); }else{ echo esc_html_e( 'n/a', 'sayidan' ); } ?></span>
                    </div>
                    <div class="info">
                        <p class="text-light">
                        <?php if ( isset( $meta['_extras'] ) ) :
                            if ( strrpos( $meta['_extras'][0], "," ) != -1 ){
                                $extras = explode( ",", $meta['_extras'][0] );
                            }
                            $extra_output = '';
                            foreach ( $extras as $extra ) {
                                $extra_output .= trim( $extra ) . '&nbsp;&nbsp;&nbsp;&#183;&nbsp;&nbsp;&nbsp;';
                            }
                            echo trim( $extra_output, "&#183;&nbsp;");
                        endif; ?>
                        </p>
                    </div>
                    <div class="desc">
                        <p><?php if ( isset( $meta['_descj'] ) ){ echo esc_attr( $meta['_descj'][0] ); } ?></p>
                    </div>
                    <?php if ( isset( $meta['_featuresj'] ) ) : ?>
                    <ul class="list-item">
                        <?php if ( strrpos( $meta['_featuresj'][0], "\n" ) != -1 ){
                            $featuresj = explode( "\n", $meta['_featuresj'][0] );
                        }
                        
                        foreach ( $featuresj as $feature) {
                            echo '<li>' . $feature . '</li>';
                        }
                        ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ( isset( $meta['_descr'] ) || isset( $meta['_featuresr'] ) ) : ?>
                <div class="why-us clearfix">
                    <div class="job-detail-title">
                        <h5 class="heading-regular text-capitalize"><?php esc_html_e( 'Skills & Requirements', 'sayidan' ); ?></h5>
                    </div>
                    <div class="why-us-content">
                        <div class="desc">
                            <p><?php if ( isset( $meta['_descr'] ) ){ echo esc_attr( $meta['_descr'][0] ); } ?></p>
                        </div>
                        <?php if ( isset( $meta['_featuresr'] ) ) : ?>
                            <ul class="list-item">
                            <?php if ( strrpos( $meta['_featuresr'][0], "\n" ) != -1 ){
                                $featuresr = explode( "\n", $meta['_featuresr'][0] );
                            }
                            
                            foreach ( $featuresr as $feature) {
                                echo '<li>' . $feature . '</li>';
                            }
                            ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <div class="apply-to text-center">
                <a href="<?php if ( isset( $meta['_apply'] ) ){ echo esc_url( $meta['_apply'][0] ); } ?>" class="bnt-theme text-regular text-uppercase" ><?php echo esc_html__( 'Apply to', 'sayidan' )." ".get_the_title(); ?></a>
            </div>
        </div>
    </div>
    <!--end job detail-->
    <?php echo sayidan_fix_shortcode( get_the_content() ); ?>
    <!--End content wrapper-->
    <!-- start google map bootstrap container -->
    <div class="modal fade" id="sayidan_map">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3><?php esc_html_e( 'Event Location', 'sayidan' ); ?></h3>
                </div>
                <div class="modal-body">
                    <div id="map-canvas" class=""></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end google map bootstrap container -->
