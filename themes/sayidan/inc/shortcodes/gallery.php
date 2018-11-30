<?php
function sayidan_shortcode_gallery($atts, $content = null) {
	extract(shortcode_atts(array(
		"title"             => '',
		"pagination"        => 'true',
        "images_per_page"   => '16',
        "type"              => 'normal',
        "link"              => '',
        "text"              => '',
        "icon"              => '',
		"category"          => ''
	), $atts));

	ob_start();
    
    if( $type == 'normal' ) :
	?>

    <div class="galery-wrapper">
        <div class="container">
            <?php if( $title ) : ?>
            <div class="galery-title text-center">
                <h4 class="heading-regular"><?php echo esc_html( $title ); ?></h4>
            </div>
            <?php endif; ?>
            <div class="galery-content">
                <ul>
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                                  'post_status'     => 'publish',
                                  'post_type'       => 'gallery',
                                  'category_name'   => $category,
                                  'posts_per_page'  => $images_per_page,
                                  'paged'           => $paged,
                                  );
                                  $postCount = 0;
                                  $recentPosts = new WP_Query( $args );
                                  
                    if ( $recentPosts->have_posts() ) :
                        while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
                    ?>
                    
                    <li class="col-sm-3 col-xs-6">
                        <div class="galery-item">
                            <?php the_post_thumbnail( 'sayidan-gallery', array( 'class' => 'img-responsive' ) ); ?>
                            <div class="galery-content">
                                <h4><?php echo the_title();?></h4>
                                <a href="#" class="popup-click"><span class="lnr lnr-magnifier"></span></a>
                            </div>
                            <div class="box-content-item">
                                <div class="box-img">
                                    <?php the_post_thumbnail( 'sayidan-story-large', array( 'class' => 'img-responsive' ) ); ?>
                                </div>
                                <div class="desc">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <?php   endwhile;
                            endif;
                            wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <?php if( $pagination == 'true'){ sayidan_pagination( $recentPosts ); } ?>

        </div>
        
        <div class="bg-popup"></div>
        <div class="wrapper-popup">
            <a href="javascript:void(0)" class="close-popup"><span class="lnr lnr-cross-circle"></span></a>
            <div class="popup-content">
                <!--content-popup   -->
            </div>
        </div>
    </div>

    <?php elseif( $type == 'minified' ) : ?>

    <!--begin instagream-->
    <div class="instagream">
        <div class="instagram-feed clearfix">
            <ul class="list-item no-margin">
                <?php  $args = array(
                    'post_status'     => 'publish',
                    'post_type'       => 'gallery',
                    'category_name'   => $category,
                    'posts_per_page'  => $images_per_page,
                    );

                    $recentPosts = new WP_Query( $args );
                    
                    if ( $recentPosts->have_posts() ) :
                        while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
                        <li class="no-padding no-margin no-style" style="width:<?php echo 100/intVal( $images_per_page );?>%"><a href="<?php echo esc_attr( $link ); ?>"><?php the_post_thumbnail( 'sayidan-gallery', array( 'class' => 'img-responsive' ) ); ?></a></li>
                        <?php endwhile;
                    endif;
                    ?>
            </ul>
            <div class="instagram-feed-user text-center">
                <div class="user-wrapper">
                    <span class="icon-instagram"><i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i></span>
                    <span class="name-user"><?php echo esc_attr( $text ); ?></span>
                </div>
            </div>
        </div>
    </div>
    <!--end instagream-->

    <?php endif;
    
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
    
