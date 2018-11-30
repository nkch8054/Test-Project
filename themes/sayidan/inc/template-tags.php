<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sayidan
 */

if ( ! function_exists( 'sayidan_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function sayidan_posted_on() {
    
	$time_string = '<time class="entry-date published updated text-light" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'sayidan' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'sayidan' ),
		'<span class="author vcard text-light"><a class="url fn n" class="text-regular text-light" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<div class="post-by"><p class="text-light">' . $posted_on . ' ' . $byline . '</p</div>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'sayidan_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function sayidan_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'sayidan' ) );
		if ( $categories_list && sayidan_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'sayidan' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'sayidan' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'sayidan' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'sayidan' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'sayidan' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


if ( ! function_exists( 'sayidan_pagination' ) ) :

function sayidan_pagination($recentPosts){
    
    echo '<div class="pagination-wrapper">';
    $big = 999999999; // need an unlikely integer
    $translated = esc_html__( 'Page', 'sayidan' );
    $pagination = paginate_links( array(
                                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                        'format' => '?paged=%#%',
                                        'current' => max( 1, get_query_var('paged') ),
                                        'total' => $recentPosts->max_num_pages,
                                        'type' => 'array',
                                        'prev_next'  => TRUE,
                                        'prev_text' 	=> '&nbsp;&nbsp;&nbsp;'.esc_html__( 'Previous', 'sayidan' ),
                                        'next_text' 	=> esc_html__( 'Next', 'sayidan' ).'&nbsp;&nbsp;&nbsp;'
                                        ) );
                                        if( is_array( $pagination ) ) {
                                            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                                            echo '<ul class="pagination">';
                                            foreach ( $pagination as $page ) {
                                                echo "<li>$page</li>";
                                            }
                                            echo '</ul>';
                                        }

    echo '</div>';
}

endif;
    
if ( ! function_exists( 'sayidan_pagination_directory' ) ) :

function sayidan_pagination_directory($recentPosts, $count){
    
    echo '<div class="pagination-wrapper">';
    $big = 999999999; // need an unlikely integer
    $translated = esc_html__( 'Page', 'sayidan' );
    $pagination = paginate_links( array(
                                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                        'format' => '?paged=%#%',
                                        'current' => max( 1, get_query_var('paged') ),
                                        'total' => $count,
                                        'type' => 'array',
                                        'prev_next'  => TRUE,
                                        'prev_text'     => '&nbsp;&nbsp;&nbsp;'.esc_html__( 'Previous', 'sayidan' ),
                                        'next_text'     => esc_html__( 'Next', 'sayidan' ).'&nbsp;&nbsp;&nbsp;'
                                        ) );
                                        if( is_array( $pagination ) ) {
                                            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                                            echo '<ul class="pagination">';
                                            foreach ( $pagination as $page ) {
                                                echo "<li>$page</li>";
                                            }
                                            echo '</ul>';
                                        }

    echo '</div>';
}

endif;

if ( ! function_exists( 'sayidan_pagination_blog' ) ) :

function sayidan_pagination_blog(){
    
    echo '<div class="pagination-wrapper">';
    $translated = esc_html__( 'Page', 'sayidan' );
    $pagination = paginate_links( array(
                                        'type' => 'array',
                                        'prev_next'  => TRUE,
                                        'prev_text' 	=> '&nbsp;&nbsp;&nbsp;'.esc_html__( 'Previous', 'sayidan' ),
                                        'next_text' 	=> esc_html__( 'Next', 'sayidan' ).'&nbsp;&nbsp;&nbsp;'
                                        ) );
    if( is_array( $pagination ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<ul class="pagination">';
        foreach ( $pagination as $page ) {
            echo "<li>$page</li>";
        }
        echo '</ul>';
    }
    echo '</div>';
}

endif;
/**
 * Display navigation to next/previous pages when applicable
 */
if ( ! function_exists( 'sayidan_content_nav' ) ) :

function sayidan_content_nav( $nav_id ) {
    global $wp_query, $post;

    // Don't print empty markup on single pages if there's nowhere to navigate.
    if ( is_single() ) {
        $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );
        
        if ( ! $next && ! $previous )
        return;
    }
    
    // Don't print empty markup in archives if there's only one page.
    if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
    return;
    
    $nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
    
    ?>
<div id="<?php echo esc_attr( $nav_id ); ?>" class="orther-story hidden-xs <?php echo esc_attr( $nav_class ); ?>" data-parallax="scroll" data-image-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'sayidan-story-large' )[0]; ?>">
    <div class='dark_overlay' >
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-6">
                    <div class="box-content box-left">
                        <?php previous_post_link( '<div class="nav-previous left">%link</div>', '<span class="story-text text-light ">' . esc_html__( 'Previous Story', 'sayidan' ) . '</span><span class="icon-angle-left">' . esc_html_x( '', 'Previous post link', 'sayidan' ) . '</span> %title' ); ?>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <div class="box-content box-right">
                        <?php next_post_link( '<div class="nav-next right">%link</div>', '<span class="story-text text-light ">' . esc_html__( 'Next Story', 'sayidan' ) . '</span><span class="icon-angle-right">' . esc_html_x( '', 'Next post link', 'sayidan' ) . '</span>%title' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
endif;


if ( ! function_exists( 'sayidan_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function sayidan_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    ?>
<li class="post pingback">
    <?php esc_html_e( 'Pingback:', 'sayidan' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'sayidan' ), '<span class="edit-link">', '<span>' ); ?>
    <?php break;
    default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment-inner">
            <div class="user-avatar">
                <?php echo get_avatar( $comment, 80 ); ?>
            </div>
            <div class="user-comments">
                <h3 class="user-heading heading-regular">
                    <?php echo get_comment_author_link(); ?>
                </h3>
                <div class="comment-content">
                <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'sayidan' ); ?></em>
                <br>
                <?php endif; ?>
                <?php comment_text(); ?>
                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                        <?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'sayidan' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a>
                    <?php edit_comment_link( esc_html__( 'Edit', 'sayidan' ), '<span class="edit-link">', '<span>' ); ?>
                    <div class="reply right">
                        <?php comment_reply_link( array_merge( $args,array(
                             'depth'     => $depth,
                             'max_depth' => $args['max_depth'],
                             ) ) );
                        ?>
                    </div><!-- .reply -->
                </div>
                </div>
            </div><!-- .comment-meta .commentmetadata -->
        </article>
        <!-- #comment -->
    <?php break;
    endswitch;
    }
    endif; // ends check for sayidan_comment()


if ( ! function_exists( 'sayidan_sharing' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function sayidan_sharing( $type ) {
    
    $permalink = get_permalink( get_the_ID() );
    ?>
    <!--begin share-->
    <div class="share">
            <?php if ( $type == 'story' ) { echo '<div class="container">'; } ?>
            <div class="box-share">
                <h4><?php esc_html_e( 'SHARE THIS STORY','sayidan'); ?></h4>
                <ul>
                    <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php esc_html_e('Share on Facebook','sayidan'); ?>"><span class="hidden">facebook</span></a></li>
                    <li class="twitter"><a href="https://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php esc_html_e('Share on Twitter','sayidan'); ?>"><span class="hidden">twitter</span></a></li>
                    <li class="google"><a href="//plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" title="<?php esc_html_e('Share on Google+','sayidan'); ?>"><span class="hidden">google</span></a></li>
                </ul>
            <?php if ( $type == 'story' ) { echo '</div>'; } ?>
        </div>
    </div>

    <!--end share-->
<?php
}
endif;

if ( ! function_exists( 'sayidan_convert_date' ) ) :
/**
 * Converts day of weeks, months to localized strings
 */
function sayidan_convert_date( $type, $num ) {
    
    if ( 'month' == $type ){

        $month_array = array(
            0 => esc_html__( 'Jan', 'sayidan' ),
            1 => esc_html__( 'Feb', 'sayidan' ),
            2 => esc_html__( 'Mar', 'sayidan' ),
            3 => esc_html__( 'Apr', 'sayidan' ),
            4 => esc_html__( 'May', 'sayidan' ),
            5 => esc_html__( 'Jun', 'sayidan' ),
            6 => esc_html__( 'Jul', 'sayidan' ),
            7 => esc_html__( 'Aug', 'sayidan' ),
            8 => esc_html__( 'Sep', 'sayidan' ),
            9 => esc_html__( 'Oct', 'sayidan' ),
            10 => esc_html__( 'Nov', 'sayidan' ),
            11 => esc_html__( 'Dec', 'sayidan' ),
        );

        return $month_array[$num];
    }

    if ( 'fmonth' == $type ){

        $month_array = array(
            0 => esc_html__( 'January', 'sayidan' ),
            1 => esc_html__( 'February', 'sayidan' ),
            2 => esc_html__( 'March', 'sayidan' ),
            3 => esc_html__( 'April', 'sayidan' ),
            4 => esc_html__( 'May', 'sayidan' ),
            5 => esc_html__( 'June', 'sayidan' ),
            6 => esc_html__( 'July', 'sayidan' ),
            7 => esc_html__( 'August', 'sayidan' ),
            8 => esc_html__( 'September', 'sayidan' ),
            9 => esc_html__( 'October', 'sayidan' ),
            10 => esc_html__( 'November', 'sayidan' ),
            11 => esc_html__( 'December', 'sayidan' ),
        );

        return $month_array[$num];
    }

    if ( 'week' == $type ){

        $month_array = array(
            0 => esc_html__( 'Sun', 'sayidan' ),
            1 => esc_html__( 'Mon', 'sayidan' ),
            2 => esc_html__( 'Tue', 'sayidan' ),
            3 => esc_html__( 'Wed', 'sayidan' ),
            4 => esc_html__( 'Thu', 'sayidan' ),
            5 => esc_html__( 'Fri', 'sayidan' ),
            6 => esc_html__( 'Sat', 'sayidan' ),
        );

        return $month_array[$num];
    }
}
endif;


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function sayidan_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'sayidan_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'sayidan_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so sayidan_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so sayidan_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in sayidan_categorized_blog.
 */
function sayidan_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'sayidan_categories' );
}
add_action( 'edit_category', 'sayidan_category_transient_flusher' );
add_action( 'save_post',     'sayidan_category_transient_flusher' );
