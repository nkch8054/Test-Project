<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="primary" class="site-content content-wrapper">
    <main id="main" class="container content_search" >

        <header class="page-header">
        <h1 class="page-title text-light"><?php $tag_slug = get_query_var('tag'); printf( esc_html__( 'Search Results for tag: %s', 'sayidan' ), '<span>' . $tag_slug . '</span>' ); ?></h1>
        </header><!-- .page-header -->

        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $args = array(
                      'post_status'     => 'publish',
                      'post_type'       => 'post',
                      'posts_per_page'  => '10',
                      'tag'             => $tag_slug,
                      'paged'           => $paged
                      );
        $tag_query = new WP_Query( $args );
        while ( $tag_query->have_posts() ) : $tag_query->the_post();

            get_template_part( 'template-parts/content', 'tag' );

        endwhile;
            
        wp_reset_postdata();
        ?>
        <?php sayidan_pagination_blog(); ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); 