<?php
function sayidan_shortcode_directory($atts, $content = null) {
	extract(shortcode_atts(array(
		"title"             => '',
		"records_per_page"  => '10',
    	"category"          => '',
		"search_bar"        => 'true',
		"type"       		=> 'manual',
		"button_text"       => ''
	), $atts));

	ob_start();
	if ( 'auto' == $type ) :

    $segments = explode( '/', trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' ) );
    $q = '';
    if( isset( $_GET['q'] ) ){ $q = sanitize_text_field( $_GET['q'] ); };
	?>

    <!--Begin content wrapper-->
    <div class="content-wrapper">
        <div class="container">
            <div class="alumni-directory">
                <?php if ( $search_bar == 'true' ) : ?>
                <div class="top-section">
                    <div class="row">
                        <div class="title-page text-left col-md-6 col-sm-12 col-xs-12">
                            <h4 class="text-regular"><?php echo esc_attr( $title ); ?></h4>
                        </div>
                        <div class="search-alumni-directory text-right col-md-6 col-sm-12 col-xs-12">
                            <form class="navbar-form no-margin no-padding" action="/<?php echo esc_url( $segments[0] ); ?>">
                                <input type="text" name="q" class="form-control input-search" value="<?php echo esc_html( $q ); ?>" placeholder="<?php esc_html_e( 'Keywords (e.g. name, city, school...)', 'sayidan' ); ?>" autocomplete="off">
                                <button type="submit" class=" bg-color-theme text-center text-regular"><?php esc_html_e( 'Search', 'sayidan' ); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="alumni-directory-content">
                    <ul class="list-item">
                        <li class="label-content">
                            <span class="user"><?php esc_html_e( 'Name', 'sayidan' ); ?></span>
                            <span class="year"><?php esc_html_e( 'Diploma', 'sayidan' ); ?></span>
                            <span class="city"><?php esc_html_e( 'Graduation Date', 'sayidan' ); ?></span>
                            <span class="scholl"><?php esc_html_e( 'Location', 'sayidan' ); ?></span>
                            <span class="department"><?php esc_html_e( 'Department', 'sayidan' ); ?></span>
                        </li>
                        <?php 
                            global $wpdb, $post, $wp_query;
                            if( $q == '' ){
						    	$q = "\"first_name\";s:0";
							    $query_count = $wpdb->prepare(
							      "SELECT COUNT(*) FROM wp_options WHERE option_name LIKE '%%%s%%' AND option_value NOT LIKE '%%%s%%' ",
							      "um_cache_userdata_" //function will do the sanitization for you
							      ,$q
							    );
							    $user_count = $wpdb->get_var( $query_count );
							    $query = $wpdb->prepare(
							      "SELECT * FROM wp_options WHERE option_name LIKE '%%%s%%' AND option_value NOT LIKE '%%%s%%'",
							      "um_cache_userdata_" //function will do the sanitization for you
							      ,$q
							    );
							}else{
	    
							    $query_count = $wpdb->prepare(
							      "SELECT COUNT(*) FROM wp_options WHERE option_name LIKE '%%%s%%' AND option_value LIKE '%%%s%%' ",
							      "um_cache_userdata_" //function will do the sanitization for you
							      ,$q
							    );	   
							    $user_count = $wpdb->get_var( $query_count );
							    $query = $wpdb->prepare(
							      "SELECT * FROM wp_options WHERE option_name LIKE '%%%s%%' AND option_value LIKE '%%%s%%'",
							      "um_cache_userdata_" //function will do the sanitization for you
							      ,$q
							    );
							}

							$total_record = $user_count; 
						    $paged      = get_query_var('paged') ? get_query_var('paged') : 1;
						    $post_per_page  = $records_per_page;
						    $offset         = ($paged - 1)*$post_per_page;
						    $max_num_pages  = ceil($total_record/ $post_per_page);
						    $wp_query->found_posts = $total_record;
						    // number of pages 
						    $wp_query->max_num_pages = $max_num_pages;
						    $limit_query    =   " LIMIT ".$post_per_page." OFFSET ".$offset;    
						    $recentPosts = $wpdb->get_results($query.$limit_query,OBJECT);// return OBJECT

                            if ( sizeof($recentPosts) > 0 ) :
                        
                                foreach( $recentPosts as $rec ) :

                                	$field1 = $field2 = $field3 = $field4 = 'n/a';
                 
									$array = unserialize( $rec->{'option_value'} );
									$name = "";
									//print_r($array);
									if ( array_key_exists("first_name", $array) ){
										$name .= $array["first_name"]." ";
									}
								    if ( array_key_exists("last_name", $array) ){
										$name .= $array["last_name"];
									}
									if ( array_key_exists("field1", $array) ){
										$field1 = $array['field1'];
									}
									if ( array_key_exists("field2", $array) ){
										$field2 = $array['field2'];
									}
									if ( array_key_exists("field3", $array) ){
										$field3 = $array['field3'];
									}
									if ( array_key_exists("field4", $array) ){
										$field4 = $array['field4'];
									}
									//if(strlen( $name ) > 2) :

										$upload_dir = wp_upload_dir(); 
										$img_url = '/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg';
										$img_dir1 = $upload_dir['basedir'] . '/ultimatemember/'.$array["ID"].'/profile_photo-190.jpg';
										$img_dir2 = $upload_dir['basedir'] . '/ultimatemember/'.$array["ID"].'/profile_photo-190.jpeg';
										$img_dir3 = $upload_dir['basedir'] . '/ultimatemember/'.$array["ID"].'/profile_photo-190.png';
										if ( file_exists($img_dir1) ) {
											$img_url = $upload_dir['baseurl'] . '/ultimatemember/'.$array["ID"].'/profile_photo-190.jpg';
										}else{

											if ( file_exists($img_dir2) ) {
												$img_url = $upload_dir['baseurl'] . '/ultimatemember/'.$array["ID"].'/profile_photo-190.jpeg';
											}else{
												if ( file_exists($img_dir3) ) {
													$img_url = $upload_dir['baseurl'] . '/ultimatemember/'.$array["ID"].'/profile_photo-190.png';
												}
											}
										}
										$user_profile = get_site_url().'/user/'.$array['user_login'];
                                	?>

                                    <li class="box-content">
                                        <span class="user">
										<a href="<?php echo esc_url( $user_profile ); ?>" ><img width="128" height="128" src="<?php echo esc_url( $img_url ); ?>" class="img-responsive wp-post-image" alt="<?php echo esc_attr( $name ); ?>" srcset="<?php echo esc_url( $img_url ); ?> 128w, <?php echo esc_url( $img_url ); ?> 93w" sizes="(max-width: 128px) 100vw, 128px"></a>
                                        <span class="label-name"><a href="<?php echo esc_url( $user_profile ); ?>" ><?php echo esc_attr( $name ); ?></a></span></span>
                                        <span class="year"><?php echo esc_attr( $field1 ); ?></span>
                                        <span class="city"><?php echo esc_attr( $field2 ); ?></span>
                                        <span class="scholl"><?php echo esc_attr( $field3 ); ?></span>
                                        <span class="department"><?php echo esc_attr( $field4 ); ?></span>
                                    </li>

                                    <?php //endif; ?>
                             
                                <?php endforeach;
                            endif; ?>
                    </ul>
                </div>
                
                <?php 
                sayidan_pagination_directory( $recentPosts, $max_num_pages ); ?>
            </div>
        </div>
    </div>
    <!--End content wrapper-->


    <?php

    elseif ( 'manual' == $type ) :

    $segments = explode( '/', trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' ) );
    $q = '';
    if( isset( $_GET['q'] ) ){ $q = sanitize_text_field( $_GET['q'] ); };
	?>

	
    <!--Begin content wrapper-->
    <div class="content-wrapper">
        <div class="container">
            <div class="alumni-directory">
                <?php if ( $search_bar == 'true' ) : ?>
                <div class="top-section">
                    <div class="row">
                        <div class="title-page text-left col-md-6 col-sm-12 col-xs-12">
                            <h4 class="text-regular"><?php echo esc_attr( $title ); ?></h4>
                        </div>
                        <div class="search-alumni-directory text-right col-md-6 col-sm-12 col-xs-12">
                            <form class="navbar-form no-margin no-padding" action="/<?php echo esc_url( $segments[0] ); ?>">
                                <input type="text" name="q" class="form-control input-search" value="<?php echo esc_html( $q ); ?>" placeholder="<?php esc_html_e( 'Keywords (e.g. name, city, school...)', 'sayidan' ); ?>" autocomplete="off">
                                <button type="submit" class=" bg-color-theme text-center text-regular"><?php esc_html_e( 'Search', 'sayidan' ); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="alumni-directory-content">
                    <ul class="list-item">
                        <li class="label-content">
                            <span class="user"><?php esc_html_e( 'Name', 'sayidan' ); ?></span>
                            <span class="year"><?php esc_html_e( 'Graduation Year', 'sayidan' ); ?></span>
                            <span class="city"><?php esc_html_e( 'Location', 'sayidan' ); ?></span>
                            <span class="scholl"><?php esc_html_e( 'School', 'sayidan' ); ?></span>
                            <span class="department"><?php esc_html_e( 'Department', 'sayidan' ); ?></span>
                        </li>
                        <?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                              'post_status'       => 'publish',
                              'post_type'         => 'directory',
                              'category_name'     => $category,
                              //'s'                 => $q,
                              'posts_per_page'    => $records_per_page,
                              'paged'             => $paged,
                              'meta_query'      => array(
                                     'relation'    => 'OR',
                                     array(
                                           'key'          => '_name',
                                           'value'        => $q,
                                           'compare'      => 'LIKE',
                                           ),
                                     array(
                                           'key'          => '_location',
                                           'value'        => $q,
                                           'compare'      => 'LIKE',
                                           ),
                                     array(
                                           'key'          => '_school',
                                           'value'        => $q,
                                           'compare'      => 'LIKE',
                                           ),
                                     array(
                                           'key'          => '_department',
                                           'value'        => $q,
                                           'compare'      => 'LIKE',
                                           ),
                                    )
                              );
                              
                            $recentPosts = new WP_Query( $args );
                            if ( $recentPosts->have_posts() ) :
                        
                                while( $recentPosts->have_posts() ) : $recentPosts->the_post();
                                    $meta = get_post_meta( get_the_ID() ); ?>

                                    <li class="box-content">
                                        <span class="user"><?php the_post_thumbnail('sayidan-gallery', array('class' => 'img-responsive')); ?><span class="label-name"><?php echo the_title(); ?></span></span>
                                        <span class="year"><?php echo date( 'd F Y', esc_attr( $meta['_year'][0] ) ); ?></span>
                                        <span class="city"><?php echo esc_attr( $meta['_location'][0] ); ?></span>
                                        <span class="scholl"><?php echo esc_attr( $meta['_school'][0] ); ?></span>
                                        <span class="department"><?php echo esc_attr( $meta['_department'][0] ); ?></span>
                                    </li>
                                
                                <?php endwhile;
                            endif; ?>
                    </ul>
                </div>
                
               <?php sayidan_pagination( $recentPosts ); ?>
            </div>
        </div>
    </div>
    <!--End content wrapper-->
    <?php

    endif; 
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
