<?php
/**
 * @package Sayidan
 * @version 1.1.0
 */
/*
Plugin Name: Sayidan
Plugin URI: http://sayidan.kenzap.com
Description: This plugin extends default <cite>Sayidan theme</cite> functionality. To activate all custom elements  features use this plugin.
Author: Kenzap
Version: 1.6.2
Author URI: http://kenzap.com
*/

//make this plugin only Sayidan specific
$my_theme = wp_get_theme();

// Add Advanced Options
if ( !is_customize_preview()  && is_admin() ) {
    require plugin_dir_path(__FILE__) . 'inc/setup/envato_setup.php';
    
    $sayidan_first = get_option( 'sayidan_first', '' );
    if ( '' == $sayidan_first ){
        update_option( 'sayidan_first', time() );
    }else{
        
        $sayidan_first = intVal(get_option( 'sayidan_first', '' ));
        if ( (time()-$sayidan_first) > (3600 * 24 * 60) && ( '' == get_option( 'sayidan_wup_purchase_code', '' ) ) ){
            add_action( 'admin_notices', 'sayidan_theme_valid' );
            if ( (time()-$sayidan_first) > (3600 * 24 * 90)){
                $my_theme = '';
            }
        }
    }
}

//if ( $my_theme->get( 'Name' ) == 'Sayidan' ) :
if ( 'Sayidan' == $my_theme || 'Sayidan Child Theme' == $my_theme) :
    
    // Add Advanced Options
    if ( !is_customize_preview()  && is_admin() ) {
        require plugin_dir_path(__FILE__) . 'inc/setup/envato_setup.php';
    }
    
    function sayidan_theme_valid(){
        global $pagenow;
        //if ( $pagenow == 'index.php' ) {
        //$user = wp_get_current_user();
        //if ( in_array( 'author', (array) $user->roles ) ) { // is-dismissible
        echo '<div class="notice notice-error">
        <p>Your theme will soon stop working. Please verify theme purchase by clicking on the button below.</p>
        <form name="post" action="admin.php?page=sayidan-setup&step=updates" method="post" id="quick-press" class="initial-form hide-if-no-js">
        <p class="sayidan-verify">
        <input type="hidden" name="action" id="quickpost-action" value="post-quickdraft-save">
        <input type="hidden" name="post_ID" value="3">
        <input type="hidden" name="post_type" value="post">
        <input type="hidden" id="_wpnonce" name="_wpnonce" value="d9dab342c2"><input type="hidden" name="_wp_http_referer" value="/wp-admin/index.php">			<input type="submit" name="save" id="save-post" class="button button-primary" value="Verify Theme">			<br class="clear">
        </p>
        </form>
        </div>';
        // }
        //}
    }
    
	// register custom post types
	require plugin_dir_path(__FILE__) . 'inc/setup.php';
	require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-story.php';
	require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-event.php';
	require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-career.php';
	require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-blocks.php';
	require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-gallery.php';
	require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-directory.php';
	//require plugin_dir_path(__FILE__) . 'inc/post-types/sayidan-profile.php';
	// register custom widgets
	require plugin_dir_path(__FILE__) . 'inc/widgets/popular_posts.php';
	require plugin_dir_path(__FILE__) . 'inc/widgets/twitter.php';
	require plugin_dir_path(__FILE__) . 'inc/widgets/popular_tags.php';
	require plugin_dir_path(__FILE__) . 'inc/twitter.php';
	    
	// register shortcodes
	add_shortcode( 'sayidan_block', 'sayidan_block_shortcode' );
	add_shortcode( 'sayidan_events', 'sayidan_shortcode_events' );
	add_shortcode( 'sayidan_gallery', 'sayidan_shortcode_gallery' );
	add_shortcode( 'sayidan_twitter', 'sayidan_shortcode_twitter' );
	add_shortcode( 'sayidan_text', 'sayidan_shortcode_text' );
	add_shortcode( 'sayidan_summary', 'sayidan_shortcode_summary' );
	add_shortcode( 'sayidan_summary_item', 'sayidan_shortcode_summary_item' );
	add_shortcode( 'sayidan_stories', 'sayidan_shortcode_stories' );
	add_shortcode( 'sayidan_sliders_item', 'sayidan_shortcode_sliders_item' );
	add_shortcode( 'sayidan_share', 'sayidan_shortcode_share' );
	add_shortcode( 'sayidan_newsletter', 'sayidan_shortcode_newsletter' );
	add_shortcode( 'sayidan_our_story', 'sayidan_shortcode_our_story' );
	add_shortcode( 'sayidan_our_story_item', 'sayidan_shortcode_our_story_item' );
	add_shortcode( 'sayidan_newsletter', 'sayidan_shortcode_newsletter' );
	add_shortcode( 'sayidan_map', 'sayidan_shortcode_map' );
	add_shortcode( 'sayidan_info', 'sayidan_shortcode_info' );
	add_shortcode( 'sayidan_info_item', 'sayidan_shortcode_info_item' );
	add_shortcode( 'sayidan_header', 'sayidan_shortcode_header' );
	add_shortcode( 'sayidan_header_texts', 'sayidan_shortcode_header_texts' );
	add_shortcode( 'sayidan_fact', 'sayidan_shortcode_fact' );
	add_shortcode( 'sayidan_event_single', 'sayidan_shortcode_event_single' );
	add_shortcode( 'sayidan_directory', 'sayidan_shortcode_directory' );
	add_shortcode( 'sayidan_career_list', 'sayidan_shortcode_career_list' );
	add_shortcode( 'sayidan_facebook_login_button', 'sayidan_facebook_login_shortcode' );
	add_shortcode( 'sayidan_button', 'sayidan_button_shortcode' );
	add_shortcode( 'sayidan_blog', 'sayidan_shortcode_blog' );
	add_shortcode( 'sayidan_blog_posts', 'sayidan_shortcode_latest_from_blog' );
	add_shortcode( 'sayidan_blocks_row', 'sayidan_shortcode_blocks_row' );
	add_shortcode( 'sayidan_sliders', 'sayidan_shortcode_sliders' );
	add_shortcode( 'sayidan_contact', 'sayidan_shortcode_contact' );
	 
    
    add_shortcode( 'sayidan_aboutus', 'sayidan_shortcode_aboutus' );
	/* Add shortcode fix to content */
	add_filter( 'the_content', 'sayidan_fix_shortcode' );
	add_filter( 'widget_text', 'sayidan_fix_shortcode' );
	add_filter( 'the_excerpt', 'sayidan_fix_shortcode' );
	add_filter( 'logout_url', 'sayidan_new_logout_url', 10, 2 );
	add_filter( 'body_class', 'sayidan_body_classes' );
	   
	//load suggested plugins
	require plugin_dir_path(__FILE__) . 'inc/inc-plugins.php';
	 
endif;   
?>
