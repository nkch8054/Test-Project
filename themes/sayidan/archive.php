<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sayidan
 */

get_header(); ?>

<div id="primary" class="site-content content-wrapper">
<main id="main" class="container content_search" >

<header class="page-header">
<?php
    the_archive_title( '<h1 class="page-title text-light">', '</h1>' );
    the_archive_description( '<div class="taxonomy-description">', '</div>' );
?>
</header><!-- .page-header -->

<?php
    
    while ( have_posts() ) : the_post();
    
    get_template_part( 'template-parts/content', 'tag' );
    
    endwhile;
    
    wp_reset_postdata();
    sayidan_pagination_blog();
    ?>
<?php  ?>
</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();