<?php
function sayidan_shortcode_career_list($atts, $content = null) {
	$atts = shortcode_atts(array(
		"records_per_page"  => '8',
		"columns"           => '4',
		"category"          => '',
        "type"              => 'normal',
		"show_filter"       => 'text-normal',
		"title"             => '',
		"image_height"      => 'auto',
		"show_date"         => 'true',
		"excerpt"           => 'true',
        "button_url"        => '',
        "button_text"       => ''
	), $atts);

	ob_start();
    
    $q = ''; $l = ''; $r = '-1'; $r_q=''; $v = '-1'; $v_q = '';
    if( isset( $_GET['q'] ) ){ $q = sanitize_text_field( $_GET['q'] ); };
    if( isset( $_GET['l'] ) ){ $l = sanitize_text_field( $_GET['l'] ); };
    if( isset( $_GET['r'] ) ){ $r = sanitize_text_field( $_GET['r'] ); if( $r == '-1' ){ $r_q = ''; }else{ $r_q = $r; } };
    if( isset( $_GET['v'] ) ){ $v = sanitize_text_field( $_GET['v'] ); if( $v == '-1' ){ $v_q = ''; }else{ $v_q = $v; } };
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
           '0'       => esc_html__( '&lt; $20,000', 'sayidan' ),
           '1'       => esc_html__( '$20,000 - $50,000', 'sayidan' ),
           '2'       => esc_html__( '$50,000 - $100,000', 'sayidan' ),
           '3'       => esc_html__( '$100,000 - $150,000', 'sayidan' ),
           '4'       => esc_html__( '$150,000 - $200,000', 'sayidan' ),
           '5'       => esc_html__( '&gt; $200,000', 'sayidan' ),
           );
    
    $segments = explode( '/', trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' ) );
    
    if( 'normal' == $atts['type'] ) :
	?>
    <!--Begin content wrapper-->
    <div class="career-opportunity">
        <div class="container">
            <?php if ( 'true' == $atts['show_filter'] ) : ?>
            <div class="top-section">
                <div class="title-page">
                    <h4 class="text-regular"><?php esc_html_e( 'Career Opportunity', 'sayidan' ); ?></h4>
                </div>
                <div class="sellect-career-opportunity">
                    <form class="navbar-form no-margin" action="/<?php echo esc_url( $segments[0] ); ?>">
                        <label class="text-light"><?php esc_html_e( 'Filter', 'sayidan' ); ?></label>
                        <ul class="list-item">
                            <li class="input-box">
                                <input type="text" name="q" value="<?php echo esc_html( $q ); ?>" class="input-search-keywords" placeholder="<?php esc_html_e( 'Keywords (e.g. name, city, school...)', 'sayidan' ); ?>" autocomplete="off">
                            </li>
                            <li class="input-box">
                                <input type="text" name="l" value="<?php echo esc_html( $l ); ?>" class="input-search-keywords" placeholder="<?php esc_html_e( 'Location (e.g. Country, City...)', 'sayidan' ); ?>" autocomplete="off">
                            </li>
                            <li class="select-rate select">
                                <input type="hidden" name="v" value="<?php echo esc_html( $v ); ?>" id="dropdown-menu-rate-value" >
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <a href="#" class="option-button">
                                        <span class="dropdown-menu-rate-name name"><?php echo esc_attr( $rate_arr[$v] ); ?></span>
                                        <span class="select-icon"><span class="lnr lnr-chevron-down"></span></span>
                                    </a>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-rate select-box">
                                    <?php $index = -1;
                                    foreach( $rate_arr as $el ){
                                        echo '<li data-index="' . $index . '" data-value="' . $el . '"><span>' . $el . '</span></li>';
                                        $index++;
                                    } ?>
                                </ul>
                            </li>
                            <li class="select-role select">
                                <input type="hidden" name="r" value="<?php echo esc_html( $r ); ?>" id="dropdown-menu-role-value" >
                                <div class="dropdown-toggle" data-toggle="dropdown">
                                    <a href="#" class="option-button">
                                        <span class="dropdown-menu-role-name name"><?php echo esc_attr( $role_arr[$r] ); ?></span>
                                        <span class="select-icon"><span class="lnr lnr-chevron-down"></span></span>
                                    </a>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-role select-box">
                                    <?php $index = -1;
                                    foreach( $role_arr as $el ){
                                        echo '<li data-index="' . $index . '" data-value="' . $el . '"><span>' . $el . '</span></li>';
                                        $index++;
                                    } ?>
                                </ul>
                            </li>
                            <script>
                                jQuery(document).ready(function() {
                                    jQuery("ul.dropdown-menu-role li").click(function(ev) {
                                                             
                                        var index = jQuery(this).attr('data-index');
                                        jQuery(".dropdown-menu-role-name").html(jQuery(this).attr('data-value'));
                                        jQuery("#dropdown-menu-role-value").val(jQuery(this).attr('data-index'));
                                        return true;
                                        });
                                                       
                                    jQuery("ul.dropdown-menu-rate li").click(function(ev) {
                                                                            
                                        var index = jQuery(this).attr('data-index');
                                        jQuery(".dropdown-menu-rate-name").html(jQuery(this).attr('data-value'));
                                        jQuery("#dropdown-menu-rate-value").val(jQuery(this).attr('data-index'));
                                        return true;
                                        });
                                });
                            </script>
                            <li class="button-set">
                                <button type="submit" class="bnt text-regular"><?php esc_html_e( 'Search', 'sayidan' ); ?></button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <?php endif; ?>
            <div class="alumni-directory-content">
                <ul class="list-item">
                    <li class="label-content">
                        <span class="company"><?php esc_html_e( 'Company', 'sayidan' ); ?></span>
                        <span class="position"><?php esc_html_e( 'Position', 'sayidan' ); ?></span>
                        <span class="location"><?php esc_html_e( 'Location', 'sayidan' ); ?></span>
                        <span class="rate"><?php esc_html_e( 'Rate', 'sayidan' ); ?></span>
                        <span class="role"><?php esc_html_e( 'Role', 'sayidan' ); ?></span>
                        <span class="applicant"><?php esc_html_e( 'Applications', 'sayidan' ); ?></span>
                        <span class="apply"></span>
                    </li>
                    <?php
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                          'post_status'     => 'publish',
                          'post_type'       => 'career',
                          'category_name'   => $atts['category'],
                          'posts_per_page'  => $atts['records_per_page'],
                          'paged'           => $paged,
                          'meta_query'      => array(
                              'relation'    => 'AND',
                               array(
                                    'key'          => '_desc',
                                    'value'        => $q,
                                    'compare'      => 'LIKE',
                                    ),
                               array(
                                    'key'          => '_location',
                                    'value'        => $l,
                                    'compare'      => 'LIKE',
                                    ),
                               array(
                                    'key'          => '_role',
                                    'value'        => $r_q,
                                    'compare'      => 'LIKE',
                                    ),
                               array(
                                    'key'          => '_rate',
                                    'value'        => $v_q,
                                    'compare'      => 'LIKE',
                                    )
                               ),
                          );
                          $recentPosts = new WP_Query( $args );
                          
            if ( $recentPosts->have_posts() ) : ?>
        
            <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
                    $meta = get_post_meta( get_the_ID() );
            ?>
            <li class="box-content <?php echo (++$j % 2 == 0) ? 'even' : 'odd'; ?>">
                <span class="company"><?php the_post_thumbnail( 'sayidan-story', array( 'class' => 'img-responsive' ) ); ?></span>
                <span class="position"><?php echo esc_attr( $meta['_position'][0] ); ?></span>
                <span class="location"><?php echo esc_attr( $meta['_location'][0] ); ?></span>
                <span class="rate"><?php if( isset($meta['_rate']) ){ echo esc_attr( $rate_arr[esc_attr( $meta['_rate'][0] )] ); }else{ echo esc_html_e( 'n/a', 'sayidan' ); } ?></span>
                <span class="role"><?php if( isset($meta['_role']) ){ echo esc_attr( $role_arr[esc_attr( $meta['_role'][0] )] ); }else{ echo esc_html_e( 'n/a', 'sayidan' ); } ?></span>
                <span class="applicant">180 Applicants</span>
                <span class="apply"><a href="<?php echo the_permalink(); ?>" class="bnt bnt-theme"><?php esc_html_e( 'Apply', 'sayidan' ); ?></a></span>
            </li>

            <?php endwhile; // end of the loop. ?>
            <?php endif;
            wp_reset_postdata();
            ?>
                </ul>
            </div>
            <?php sayidan_pagination( $recentPosts ); ?>
        </div><!-- col -->
    </div><!-- row -->
	<?php
    elseif( 'minified' == $atts['type'] ) :
    ?>
        
    <div class="block-career col-md-4 col-sm-12 col-xs-12">
        <div class="column-career">
            <div class="title-links">
                <h3 class="heading-regular"><?php echo esc_attr( $atts['title'] );?></h3>
            </div>
            <div class="career-content">
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                'post_status'     => 'publish',
                'post_type'       => 'career',
                'category_name'   => $atts['category'],
                'posts_per_page'  => $atts['records_per_page'],
                'paged'           => $paged,
                );
                $recentPosts = new WP_Query( $args );
                
                if ( $recentPosts->have_posts() ) :
                
                    while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
                        $meta = get_post_meta( get_the_ID() ); ?>
                        <div class="company-item clearfix">
                            <div class="company-logo">
                                 <a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail( 'sayidan-story', array( 'class' => 'img-responsive' ) ); ?></a>
                            </div>
                            <div class="company-desc-wrapper">
                                <div class="company-desc">
                                    <div class="company-title"><h6 class="heading-regular"><a href="<?php echo the_permalink(); ?>"><?php echo sayidan_string_limit_words( esc_attr( $meta['_position'][0] ), 5 ); ?></a></h6></div>
                                    <div class="company-excerpt">
                                        <p><?php echo sayidan_string_limit_words( get_the_excerpt(), 8 ) . '[...]';  ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
            <?php if( $atts['button_text'] ) : ?>
            <div class="view-all"><a href="<?php echo esc_attr( $atts['button_url'] ); ?>"><?php echo esc_attr( $atts['button_text'] ); ?></a></div>
            <?php endif; ?>
        </div>
    </div>


    <?php
    endif;
    
    
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
