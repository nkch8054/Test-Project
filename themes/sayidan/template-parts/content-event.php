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
    $time_left = esc_attr( $meta['sayidan_time'][0] );
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_arr = wp_get_attachment_image_src( $thumb_id, 'sayidan-story-large', true );
    ?>
    <!--begin event-->
    <div class="event">
        <div class="event-img" style="background: url('<?php echo esc_url( $thumb_url_arr[0] ); ?>') no-repeat; background-size: cover;">
            <div class="dark_overlay">
            <div class="container">
               
                <img class="img-responsive" src="<?php echo esc_url( $thumb_url_arr[0] ); ?>" alt="<?php echo the_title(); ?>">
                <div class="event-time animated fadeIn" style="display:<?php if ( time() - $time_left > 0 ){ echo "none"; }else{ echo "block"; } ?>" >
                    <div id="time-event"></div>
                    <script>
                        jQuery(document).ready(function () {
                            jQuery('#time-event').syotimer({
                              year: <?php echo date( 'Y', $time_left ); ?>,
                              month: <?php echo date( 'm', $time_left ); ?>,
                              day: <?php echo date( 'd', $time_left ); ?>,
                              hour: 0,
                              minute: 0,
                            });
                        });
                   </script>
                </div>
            </div>
            </div>
        </div>
        <div class="event-content">
            <div class="container">
                <div class="event-detail text-center">
                    <div class="dates"> <p class="text-light"><?php echo sayidan_convert_date( 'fmonth', (date('n', $time_left)-1) ); echo date(' d, ', $time_left); echo date('Y', $time_left); ?></p></div>
                    <div class="event-detail-title">
                        <h1 class="heading-bold"><?php echo the_title(); ?></h1>
                    </div>
                    <div class="place">
                        <div class="place-text text-light"><div class="icon icon-map"></div><?php echo esc_attr( $meta['sayidan_location'][0] ); ?></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="view-map text-center">
                        <a href="#sayidan_map" class="btn_view_map" data-toggle="modal" data-address="<?php if ( isset ( $meta['sayidan_latlon'] ) ) { echo esc_attr( $meta['sayidan_latlon'][0] ); } ?>"><?php esc_html_e( 'View map', 'sayidan' ); ?></a>
                    </div>
                </div>
                <div class="event-descriptiion">
                    <?php the_content(); ?>
                </div>
                <?php if ( time() - $time_left < 0 ) : ?> 
                <div class="join-now text-center">
                    <a href="<?php if ( isset ( $meta['sayidan_url'] ) ) { echo esc_attr( $meta['sayidan_url'][0] ); }else{ echo '#'; } ?>" class="text-bold bnt bnt-theme"><?php esc_html_e( 'Join Now', 'sayidan' ); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php echo sayidan_fix_shortcode( $meta['sayidan_text'][0] ); ?>
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