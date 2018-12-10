<?php
function sayidan_shortcode_events( $atts, $content = null ) {
	$atts = extract( shortcode_atts( array(
        "title"             => '',
		"header"            => 'false',
        "pagination"        => 'false',
		"title"             => '',
        "type"              => 'normal',
		"subtitle"          => '',
		"category"          => '',
		"records_per_page"  => '100',
        "button_text"       => '',
        "button_url"        => ''
                                 
	), $atts ) );

	ob_start();
	?>

<?php
    if( $type == 'normal' ) :
    
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'event',
        'meta_key' => 'sayidan_time',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'category_name' => $atts['category'],
        'posts_per_page' => $atts['records_per_page'],
        'paged' => $paged
    );
    $postCount = 0;
    $recentPosts = new WP_Query( $args );

    if ( $recentPosts->have_posts() ) :

        $event_id_prev = '';
        $first = True;
        $event_id_first;
        while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
            $meta = get_post_meta( get_the_ID() );
            $time_left = esc_attr( $meta['sayidan_time'][0] );
            $event_id = date('my', $time_left);
            if ( $first ){
                $event_id_first = $event_id;
                $first = False;
                
                // get image
                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'sayidan-story-large', true);
                $thumb_url = $thumb_url_array[0];
                $thumb_url_array_square = wp_get_attachment_image_src($thumb_id, 'sayidan-square', true);
                
            if( $header == 'true' ) : ?>
            <!--begin upcoming event-->
            <div class="program-upcoming-event" style="background: url('<?php echo esc_url( $thumb_url ); ?>') no-repeat; background-size: cover;">
                <div class="dark_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="area-img" >
                                <div class="area-img-cont img-responsive animate zoomIn" style="background: url('<?php echo esc_url( $thumb_url_array_square[0] ); ?>') no-repeat; background-size: contain;"></div>
                                <div id="time-event" class="animated fadeIn"></div>
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
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="area-content">
                                <div class="area-top">
                                    <div class="top-section animated lightSpeedIn">
                                        <h5 class="heading-light"><?php esc_html_e( 'UPCOMING EVENT', 'sayidan' ); ?></h5>
                                        <span class="dates text-light text-uppercase"><?php echo sayidan_convert_date( 'fmonth', (date('n', $time_left)-1) ); echo date(' d, ', $time_left); echo date('Y', $time_left); ?></span>
                                    </div>
                                    <h2 class="heading-bold upper animated rollIn"><?php echo the_title(); ?></h2>
                                    <span class="animated fadeIn">
                                        <span class="icon map-icon"></span>
                                        <span class="text-place text-light"><?php echo esc_attr( $meta['sayidan_location'][0] ); ?></span>
                                    </span>
                                </div>
                                <div class="area-bottom animated zoomInLeft">
                                    <a href="<?php echo the_permalink();?>" class="bnt bnt-theme join-now" ><?php esc_html_e( 'Join Now', 'sayidan' ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!--end upcoming event-->
            <?php endif; ?>

            <!--begin event calendar-->
            <div class="event-calendar">
                <div class="container">
                    <div class="top-section text-center">
                        <h4><?php echo esc_attr( $title ); ?></h4>
                    </div>
                    <div class="event-month">
                        <ul class="columns2 text-center event-filter">
            
            <?php
            }
            if ( $event_id != $event_id_prev ) : ?>
                    <li class="event-item" id="<?php echo esc_attr( $event_id ); ?>">
                        <span class="text-light year"><?php echo date('Y', $time_left); ?></span>
                        <span class="text-light month"><?php echo sayidan_convert_date( 'fmonth', (date('n', $time_left)-1) ); ?></span>
                    </li>
            <?php
            endif;
            $event_id_prev = $event_id;
        endwhile; ?>
                </ul>
            </div>
        <div id="event-list-id-<?php echo esc_attr( $event_id_first ); ?>" class="event-list-content">
        <?php
        while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
        $meta = get_post_meta( get_the_ID() );
        //print_r( $meta );
        $time_left = esc_attr( $meta['sayidan_time'][0] );
        ?>
        <div class="event-list-item event-id-<?php echo date('my', $time_left); ?>">
            <div class="date-item">
                <span class="day text-bold color-theme"><?php echo date('d', $time_left); ?></span>
                <span class="dates text-light text-uppercase"><?php echo sayidan_convert_date( 'month', (date('n', $time_left)-1) ); ?></span>
            </div>
            <div class="date-desc-wrapper">
                <div class="date-desc">
                    <div class="date-title"><h4 class="heading-regular"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h4></div>
                    <div class="date-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="place">
                        <span class="icon map-icon"></span>
                        <span class="text-place"><?php echo esc_attr( $meta['sayidan_location'][0] ); ?></span>
                        <a href="#sayidan_map" class="btn btn_view_map" data-toggle="modal" data-address="<?php if ( isset ( $meta['sayidan_latlon'] ) ) { echo esc_attr( $meta['sayidan_latlon'][0] ); } ?>"><?php esc_html_e( 'View map', 'sayidan' ); ?></a>
                    </div>
                </div>
            </div>
            <?php if ( !isset ( $meta['sayidan_available'] ) ) : ?>
            <div class="date-links sold-out text-center">
                <a href="<?php echo the_permalink();?>" class="text-regular"><?php esc_html_e( 'SOLD OUT', 'sayidan' ); ?></a>
                <?php if ( isset ( $meta['sayidan_warning'] ) ) { echo '<span class="limit">' . $meta['sayidan_warning'][0] . '</span>'; } ?>
            </div>
            <?php else : ?>
            <div class="date-links register text-center">
                <a href="<?php echo the_permalink();?>" class="text-regular"><?php esc_html_e( 'REGISTER', 'sayidan' ); ?></a>
                <?php if ( isset ( $meta['sayidan_warning'] ) ) { echo '<span class="limit">' . $meta['sayidan_warning'][0] . '</span>'; } ?>
            </div>
            <?php endif; ?>
        </div>
    <?php
    endwhile;
    endif;
    wp_reset_postdata();
    ?>

        </div>
        <?php if ( $pagination == 'true' ){ sayidan_pagination( $recentPosts ); } ?>
    </div>
</div>
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

<?php elseif( $type == 'minified' ) : ?>

<div class="block-event-calendar col-md-6 col-sm-12 col-xs-12">
    <div class="column-calendar">
        <div class="title-links">
            <h3 class="heading-regular">Event Calendar</h3>
        </div>
                
        <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
              'post_status' => 'publish',
              'post_type' => 'event',
              'meta_key' => 'sayidan_time',
              'orderby' => 'meta_value_num',
              'order' => 'ASC',
              'category_name' => $atts['category'],
              'posts_per_page' => $atts['records_per_page'],
              'paged' => $paged
              );
              $postCount = 0;
              $recentPosts = new WP_Query( $args );
              
              if ( $recentPosts->have_posts() ) :
              
              $event_id_prev = '';
              $first = True;
              $event_id_first;
              
              while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
                  $meta = get_post_meta( get_the_ID() );
                  $time_left = esc_attr( $meta['sayidan_time'][0] );
                  $event_id = date('my', $time_left);
                  
                     if ( $first ) :
                      $event_id_first = $event_id;
                      $first = False; ?>
        
                      <div class="content-calendar bg-calendar no-padding">
                        
                        <div class="list-view">
                
                      <?php
                      endif;
                    ?>
                    <div class="view-item">
                        <div class="date-item">
                            <span class="dates text-light"><?php echo sayidan_convert_date( 'week', (date('w', $time_left)) ); ?></span>
                            <span class="day text-bold color-theme"><?php echo date('d', $time_left); ?></span>
                            <span class="month text-light"><?php echo sayidan_convert_date( 'month', (date('n', $time_left)-1) ); ?></span>
                        </div>
                        <div class="date-desc-wrapper">
                            <div class="date-desc">
                                <div class="date-title"><h6 class="heading-regular"><a href="<?php the_permalink() ?>"><?php echo sayidan_string_limit_words( get_the_title(), 5 ); ?></a></h6></div>
                                <div class="date-excerpt">
                                    <p><?php echo sayidan_string_limit_words( get_the_excerpt(), 8 ) . '[...]';  ?></p>
                                </div>
                                <div class="place">
                                    <span class="icon map-icon"></span>
                                    <span class="text-place"><?php echo esc_attr( $meta['sayidan_location'][0] ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
            </div>
        </div>
        <div class="view-all"><a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_attr( $button_text ); ?></a></div>
    </div>
</div>

<?php endif; ?>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
    
