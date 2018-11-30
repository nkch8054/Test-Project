<?php
function sayidan_shortcode_blog($atts, $content = null) {

	extract( shortcode_atts( array(
		"records_per_page"  => '5',
		"columns"           => '2',
		"category"          => '',
		"style"             => 'text-normal',
		"title"             => '',
        "type"              => 'normal',
		"image_height"      => 'auto',
		"show_header"       => 'true',
		"excerpt"           => 'true',
        "button_text"       => '',
        "button_url"        => ''
	), $atts ) );

	ob_start();
    if( $type == 'normal' ) :
	?>

        <div class="content-wrapper">
        <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
            'post_status'       => 'publish',
            'post_type'         => 'post',
            'category_name'     => $category,
            'posts_per_page'    => $records_per_page,
            'paged'             => $paged
            );
        $postCount = 0;
        $recentPosts = new WP_Query( $args );
        $closeTags = false;
        $stickyReset = false;
        if ( $recentPosts->have_posts() ) :

            while( $recentPosts->have_posts() ) : $recentPosts->the_post();
            $meta = get_post_meta( get_the_ID() );
            if( 0 == $postCount ) :
                $closeTags = true;
                if ( 'true' == $show_header && has_post_thumbnail() ) : ?>
                    <div class="latst-article">
                        <div class="dark_overlay">
                            <div class="container">
                                <div class="area-img">
                                    <?php the_post_thumbnail( 'sayidan-story-large', array( 'class' => 'img-responsive' ) ); ?>
                                </div>
                                <div class="area-content">
                                    <div class="category animated fadeIn">
                                        <a href="<?php echo get_the_permalink(); ?>" class="bnt text-regular"><?php esc_html_e( 'Community', 'sayidan' ); ?></a>
                                    </div>
                                    <div class="article-title">
                                        <h2 class="text-regular text-capitalize animated rollIn"><?php echo get_the_title(); ?></h2>
                                    </div>
                                    <div class="stats">
                                        <span class="clock">
                                            <span class="icon clock-icon-while stats-item"></span>
                                            <span class="text-center text-light stats-item"><?php echo get_the_date(); ?></span>
                                        </span>
                                        <span class="comment">
                                            <span class="icon comment-icon-while stats-item"></span>
                                            <span class="text-center text-light stats-item"><?php echo comments_number( esc_html__( 'no comments', 'sayidan' ), esc_html__( 'one comment', 'sayidan' ), '% ' . esc_html__( 'comments', 'sayidan' ) ); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="blog-content" >
                    <div class="container">
                        <div class="row">
                            <div class="col-main col-lg-8 col-md-7 col-xs-12">
                                <div class="articles">
                                    <?php endif; ?>
                                        <div class="article-item <?php echo (( is_sticky( get_the_ID() ) && !$stickyReset ) ?  'sticky': "") ; ?>" >
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <div class="area-img">
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                        <?php the_post_thumbnail( 'sayidan-blog', array( 'class' => 'img-responsive' ) ); ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="area-content">
                                                <div class="article-left col-lg-2 col-md-3 col-sm-3 col-xs-12 pull-left">
                                                    <div class="catetory-title">
                                                        <h6 class="text-regular"><?php esc_html_e( 'News', 'sayidan' ); ?></h6>
                                                    </div>
                                                    <div class="stats">
                                                        <span class="icon user-icon stats-item"></span>
                                                        <span class="text-content text-light stats-item"><?php echo get_the_author(); ?></span>
                                                    </div>
                                                </div>
                                                <div class="article-right col-lg-10 col-md-9 col-sm-9 col-xs-12 pull-left">
                                                    <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                                                    <p><?php echo get_the_excerpt(); ?></p>
                                                    <div class="stats">
                                                        <span class="clock">
                                                            <span class="icon clock-icon stats-item"></span>
                                                            <span class="text-center text-light stats-item"><a href="<?php echo get_the_permalink(); ?>"><?php echo date( 'd M Y', get_post_time( 'U', true ) ); ?></a></span>
                                                        </span>
                                                        <span class="comment">
                                                            <span class="icon comment-icon stats-item"></span>
                                                            <span class="text-center text-light stats-item"><?php echo comments_number( esc_html__( 'no comments', 'sayidan' ), esc_html__( 'one comment', 'sayidan' ), '% ' . esc_html__( 'comments', 'sayidan' ) ); ?></span>
                                                        </span>
                                                        <?php if ( is_sticky() && !$stickyReset ) : ?>
                                                        <span class="clock">
                                                            <span class="icon paper-icon stats-item"></span>
                                                            <span class="text-center text-light stats-item"><?php esc_html_e( 'sticky', 'sayidan' ); ?></span>
                                                        </span>
                                                        <?php endif; if( !is_sticky() ) { $stickyReset = true; }   ?>
                                                         
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php $postCount++;
                            endwhile;
                            endif;
                            wp_reset_postdata(); ?>
                        </div>
                        <?php sayidan_pagination($recentPosts); ?>
                    </div>

                    <div class="sidebar blog-right col-lg-4 col-md-5 hidden-sm hidden-xs">
                        <?php get_sidebar(); ?>
                        <?php if ( true == $closeTags ) : ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;
    endif;
    
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}
