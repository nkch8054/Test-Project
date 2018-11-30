<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sayidan
 */

$access_denied = get_template_directory_uri() . '/images/clock-access.png';

$sayidan_dash_link = "#";
if( is_user_logged_in() ) {

    if ( get_theme_mod( 'sayidan_dash_link' ) ) {
        $sayidan_dash_link = get_theme_mod( 'sayidan_dash_link' );
    }
}else{

    if ( get_theme_mod( 'sayidan_login_link' ) ) {
        $sayidan_dash_link = get_theme_mod( 'sayidan_login_link' );
    }else{
        $sayidan_dash_link = wp_login_url( get_permalink() );
    }
} 
?>

<!--Begin content wrapper-->
<div class="content-wrapper">
    <div class="container">
        <div class="access-denied text-center">
            <img src="<?php echo esc_url( $access_denied ); ?>" alt="<?php esc_html_e( 'Access Denied', 'sayidan' ); ?>">
            <h2 class="heading-light"><?php esc_html_e( 'Access Denied', 'sayidan' ); ?></h2>
            <div class="box-text">
                <h4 class="heading-light"><?php esc_html_e( 'You are not authorized to access this page', 'sayidan' ); ?></h4>
                <p class="text-light"><?php esc_html_e( 'Please Log In by clicking on the', 'sayidan' ); ?> <a class="color-theme" href="<?php echo esc_url( $sayidan_dash_link ); ?>"><?php esc_html_e( 'Log In', 'sayidan' ); ?></a> <?php esc_html_e( 'link to the right.', 'sayidan' ); ?></p>
                <p class="text-light"><?php esc_html_e( 'Thank You', 'sayidan' ); ?></p>
            </div>
        </div>
    </div>
</div>
<!--End content wrapper-->

