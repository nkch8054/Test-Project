<?php
function sayidan_shortcode_event_single($atts, $content = null) {
	$atts = extract(shortcode_atts(array(
		"id"            => '',
		"title"         => '',
		"button_text"   => '',
    "category"      => ''
	), $atts));

	ob_start();
	?>

    <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
                  'post_status'     => 'publish',
                  'post_type'       => 'event',
                  //'category_name'   => $atts['category'],
                  'posts_per_page'  => '1',
                  'paged'           => $paged,
                  );

    //grab event by ud
    if ( strlen( $id ) > 0 ) {
      $args['p'] = esc_attr( $id ) ;
    }

    $vostCount = 0;
    $recentPosts = new WP_Query( $args );
                  
    if ( $recentPosts->have_posts() ) : ?>

    <?php
    while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
        $meta = get_post_meta( get_the_ID() );
        $time_left = esc_attr( $meta['sayidan_time'][0] );
    ?>

<!--begin upcoming event-->
<div class="upcoming-event">
    <div class="container">
        <div class="row">
            <div class="area-img col-md-5 col-sm-12 col-xs-12">
                <?php the_post_thumbnail( 'sayidan-story', array( 'class' => 'img-responsive animate zoomIn' ) ); ?>
            </div>
            <div class="area-content col-md-7 col-sm-12 col-xs-12">
                <div class="area-top">
                    <div class="row">
                        <div class="col-sm-10 col-xs-9">
                            <h5 class="heading-light no-margin animated fadeInRight"><?php esc_html_e( 'UPCOMING EVENT', 'sayidan' ); ?></h5>
                            <h2 class="heading-bold animated fadeInLeft"><?php echo the_title(); ?></h2>
                            <span>
                                <span class="icon map-icon"></span>
                                <span class="text-place text-light animated fadeInRight"><?php echo esc_attr( $meta['sayidan_location'][0] ); ?></span>
                            </span>
                        </div>
                        <div class="col-sm-2 col-xs-3">
                            <div class="area-calendar calendar animated slideInRight">
                                <span class="day text-bold"><?php echo date('d', $time_left); ?></span>
                                <span class="month text-light"><?php echo sayidan_convert_date( 'month', (date('n', $time_left)-1) ); ?></span>
                                <span class="year text-light bg-year"><?php echo date('Y', $time_left); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="area-bottom">
                    <div id="time-event" class="pull-left animated slideInLeft"></div>
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
                    <a href="<?php echo the_permalink();?>" class="bnt bnt-theme join-now pull-right animated fadeIn"><?php esc_html_e( 'Join Now', 'sayidan' ); ?></a>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!--end upcoming event-->

<?php endwhile; // end of the loop. ?>
<?php endif;
    wp_reset_postdata();
    ?>

<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

