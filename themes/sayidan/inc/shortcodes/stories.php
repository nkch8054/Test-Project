<?php
function sayidan_shortcode_stories($atts, $content = null) {
	extract(shortcode_atts(array(
		"records_per_page"  => '8',
		"columns"           => '2',
		"category"          => '',
		"style"             => 'text-normal',
		"title"             => '',
        "type"              => 'normal',
		"image_height"      => 'auto',
		"show_date"         => 'true',
		"excerpt"           => 'true',
        "button_text"       => '',
        "button_url"        => ''
	), $atts));

	ob_start();
    
    if( $type == 'normal' ) :
	?>

    <div class="alumni-story">
        <div class="container">
                <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_status'       => 'publish',
                            'post_type'         => 'story',
                            'category_name'     => $category,
                            'posts_per_page'    => $records_per_page,
                            'paged'             => $paged
                        );
                        $postCount = 0;
                        $recentPosts = new WP_Query( $args );
                        
                        if ( $recentPosts->have_posts() ) : ?>

                            <?php while( $recentPosts->have_posts() ) : $recentPosts->the_post();
                            $meta = get_post_meta( get_the_ID() ); ?>
                            <?php if( $postCount == 0 ) { ?>
                            <div class="row">
                            <?php } ?>
                            <div class="col-sm-<?php echo (12 / intVal( $columns ) );?> col-xs-12">
                                <div class="alumni-story-wrapper">
                                    <div class="alumni-story-img" >
                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('sayidan-story', array('class' => 'img-responsive')); ?></a>
                                    </div>
                                    <div class="alumni-story-content">
                                        <h3 class="heading-regular"><a href="<?php the_permalink() ?>"><?php if ( isset( $meta['_name'] ) ) { echo esc_attr( $meta['_name'][0] ).': '; } the_title(); ?></a></h3>
                                        <?php if($excerpt != 'false') { ?>
                                        <p class="text-light"><?php
                                            $excerpt = get_the_excerpt();
                                            echo sayidan_string_limit_words($excerpt, 18) . '[...]';
                                            ?>
                                        </p>
                                        <?php } ?>
                                        <?php if($show_date != 'false') { ?>
                                        <span class="dates text-light"><?php echo get_the_date(); ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php if( $postCount == ( intVal( $columns ) - 1 ) ) { ?>
                            </div>
                            <?php } ?>
                            <?php if( $postCount == ( intVal( $columns ) - 1 ) ) {
                                $postCount = 0;
                            }else{
                                $postCount ++;
                            }
                            ?>
                            <?php endwhile; // end of the loop. ?>
                        <?php
                        endif;
                        wp_reset_postdata();
                        ?>
                        <?php sayidan_pagination( $recentPosts ); ?>

        </div><!-- col -->
    </div><!-- row -->

	<?php
    elseif( $type == 'minified' ) :
    ?>
        
    <div class="block-news col-md-6 col-sm-12 col-xs-12">
        <div class="column-news">
            <div class="title-links">
                <h3 class="heading-regular"><?php echo esc_attr( $title);?></h3>
            </div>
			<div class="content-news">
			
            <div class="post-wrapper">
                <?php
                    $args = array(
                      'post_status' => 'publish',
                      'post_type' => 'post',
                      'category_name' => $category,
                      'posts_per_page' => $records_per_page,
                      'post__not_in'=>get_option("sticky_posts"),
                      'meta_query' => array(
                        array(
                         'key' => '_thumbnail_id',
                         'compare' => 'EXISTS'
                        ),
                       )
                      );
                      $postCount = 0;
                      $recentPosts = new WP_Query( $args );
                      if ( $recentPosts->have_posts() ) :
                
                        while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
                        <div class="post-item clearfix">
						
					<!--<div class="date-item">
                            <span class="dates text-light"><?php echo get_the_date('D'); ?></span>
                            <span class="day text-bold color-theme"><?php echo get_the_date('d'); ?></span>
                            <span class="month text-light"><?php echo get_the_date('M'); ?></span>
                        </div>-->
						
                            <div class="image-frame post-photo-wrapper">
                                <?php if  ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('sayidan-minified', array('class' => 'img-responsive')); ?> </a>
                                <?php endif; ?>
                            </div>
                            <div class="post-desc-wrapper <?php if  ( !has_post_thumbnail() ){ echo 'post-desc-wrapper-wide'; } ?>">
                                <div class="post-desc">
                                    <div class="post-title"><h6 class="heading-regular"><a href="<?php the_permalink() ?>"><?php echo sayidan_string_limit_words( get_the_title(), 10 ); ?></a></h6></div>
                                    <div class="post-excerpt">
                                        <p><?php echo sayidan_string_limit_words( get_the_excerpt(), 20 ) . '[...]';  ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        endwhile;
                      endif;
                      ?>
            </div>
			</div>
            <?php if( $button_text ) : ?>
            <div class="view-all"><a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_attr( $button_text ); ?></a></div>
            <?php endif; ?>
        </div>
    </div>


<?php
    endif;
    
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
