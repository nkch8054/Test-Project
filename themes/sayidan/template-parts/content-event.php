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
    
    <!-- end google map bootstrap container -->