<?php
/**
 * @package Sayidan
 * @basic setup
 */


    /**
     * Add custom metaboxes for post and default pages
     */
    function add_sayidan_metaboxes() {
        
        /**
         * Initiate the metabox
         */
        $cmb_page = new_cmb2_box( array(
                               'id'            => 'page_metabox',
                               'title'         => esc_attr( 'Settings', 'sayidan' ),
                               'object_types'  => array( 'page', ), // Post type
                               'context'       => 'normal',
                               'priority'      => 'high',
                               'show_names'    => true, // Show field names on the left
                               ) );
        // Enable Title
        $cmb_page->add_field( array(
                               'name' => esc_attr( 'Disable Title', 'sayidan' ),
                               'desc' => esc_attr( 'disable default page title in header', 'sayidan' ),
                               'id'   => '_title',
                               'type' => 'checkbox',
                               ) );
        // Wide Content
        $cmb_page->add_field( array(
                                'name' => esc_attr( 'Wide Content', 'sayidan' ),
                                'desc' => esc_attr( 'Expand page content to 100%', 'sayidan' ),
                                'id'   => '_narrow_content',
                                'type' => 'checkbox',
                                ) );
        // Enable Authorized Access
        $cmb_page->add_field( array(
                                'name' => esc_attr( 'Authorized Access', 'sayidan' ),
                                'desc' => esc_attr( 'Restric page, requires login', 'sayidan' ),
                                'id'   => '_restricted',
                                'type' => 'checkbox',
                                ) );
    }
    add_action( 'cmb2_init', 'add_sayidan_metaboxes' );


    //hide WP bar for non administrators
    add_action('after_setup_theme', 'remove_admin_bar');
    function remove_admin_bar() {

      if (!current_user_can('administrator') && !is_admin()) {

        show_admin_bar(false);
      }
    }

  
    
    
    
    
    
    
    
    function sayidan_widgets_collection($folders){
        $folders[] = get_template_directory() . 'inc/shortcodes';
        return $folders;
    }
    add_filter('siteorigin_widgets_widget_folders', 'sayidan_widgets_collection');
    
    
    function sayidan_add_widget_tabs($tabs) {
        $tabs[] = array(
                        'title' => esc_attr__('Sayidan Widgets', 'sayidan'),
                        'filter' => array(
                                          'groups' => array('sayidan')
                                          )
                        );
        
        return $tabs;
    }
    add_filter('siteorigin_panels_widget_dialog_tabs', 'sayidan_add_widget_tabs', 20);
    
    
    function ocdi_import_files() {
        return array(
                     array(
                           'import_file_name'           => 'Demo1',
                           'import_file_url'            => 'http://themesapi.kenzap.com/demo/sayidan.wordpress.xml',
                           // 'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
                           'import_customizer_file_url' => 'http://themesapi.kenzap.com/demo/sayidan.export.dat',
                           'import_notice'              => __( 'If you experience server error 500 during import process please read the following <a target="_blank" href="https://github.com/proteusthemes/one-click-demo-import/blob/master/docs/import-problems.md#user-content-server-error-500" >article</a>. You may also install theme on <a target="blank" href="http://cloud.kenzap.com/step1.php" >Kenzap cloud</a> for free or request paid installation/assistance with your hosting environment.', 'sayidan' ),
                           ),
                     );
    }
    add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );
    
    
    function ocdi_after_import_setup() {
        // Assign menus to their locations.
        
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        
        set_theme_mod( 'nav_menu_locations', array(
                                                   'primary' => $main_menu->term_id,
                                                   'primary_mobile' => $main_menu->term_id,
                                                   'footer' => $footer_menu->term_id,
                                                   )
                      );
        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title( 'Home' );
        $blog_page_id  = get_page_by_title( 'Blog' );
        
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
        update_option( 'page_for_posts', $blog_page_id->ID );
        update_option( 'siteorigin_panels_settings', 'a:19:{s:10:"post-types";a:2:{i:0;s:4:"page";i:1;s:4:"post";}s:22:"live-editor-quick-link";b:1;s:15:"parallax-motion";s:0:"";s:17:"sidebars-emulator";b:1;s:14:"display-teaser";b:1;s:13:"display-learn";b:1;s:10:"title-html";s:39:"<h3 class="widget-title">{{title}}</h3>";s:16:"add-widget-class";b:0;s:15:"bundled-widgets";b:0;s:19:"recommended-widgets";b:0;s:10:"responsive";b:1;s:13:"tablet-layout";b:0;s:12:"tablet-width";i:1024;s:12:"mobile-width";i:780;s:13:"margin-bottom";i:0;s:22:"margin-bottom-last-row";b:0;s:12:"margin-sides";i:30;s:20:"full-width-container";s:4:"body";s:12:"copy-content";b:1;}');
        
        update_option( 'facebook', '#' );
        update_option( 'twitter', '#' );
        update_option( 'google', '#' );
        update_option( 'instagram', '#' );
        update_option( 'linkedin', '#' );
  
        update_option( 'sayidan_footnote', '©2016 Alumni Association of the University of Sayidan' );
        update_option( 'sayidan_desc', 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare.' );
        update_option( 'the_champ_login', 'a:30:{s:6:"enable";s:1:"1";s:20:"disable_reg_redirect";s:0:"";s:9:"providers";a:6:{i:0;s:8:"facebook";i:1;s:7:"twitter";i:2;s:8:"linkedin";i:3;s:6:"google";i:4;s:9:"vkontakte";i:5;s:9:"instagram";}s:6:"fb_key";s:15:"749150165265343";s:11:"twitter_key";s:25:"swe3tV3IQq4ZdOf4xGI5QWeRU";s:14:"twitter_secret";s:50:"bSSW9bgcqlzyrrL1EDhrTbFNcrpBbhn9Y8dnnkUqzoO7YyUd19";s:6:"li_key";s:15:"749150165265343";s:10:"google_key";s:73:"1077924453734-oc4k21ku78l568a00jti9s6d5s3m920k.apps.googleusercontent.com";s:6:"vk_key";s:15:"749150165265343";s:8:"insta_id";s:15:"749150165265343";s:7:"xing_ck";s:0:"";s:7:"xing_cs";s:0:"";s:16:"twitch_client_id";s:0:"";s:5:"title";s:25:"Login with your Social ID";s:13:"enableAtLogin";s:1:"1";s:16:"enableAtRegister";s:1:"1";s:15:"enableAtComment";s:1:"1";s:12:"link_account";s:1:"1";s:6:"avatar";s:1:"1";s:14:"avatar_quality";s:7:"average";s:14:"email_required";s:1:"1";s:14:"password_email";s:1:"1";s:20:"new_user_admin_email";s:1:"1";s:17:"login_redirection";s:4:"same";s:21:"login_redirection_url";s:0:"";s:20:"register_redirection";s:4:"same";s:24:"register_redirection_url";s:0:"";s:16:"email_popup_text";s:70:"Please enter a valid email address. You might be required to verify it";s:19:"email_error_message";s:50:"Email you entered is already registered or invalid";s:12:"popup_height";s:0:"";}' );
        update_option( 'the_champ_general', 'a:5:{s:13:"footer_script";s:1:"1";s:14:"delete_options";s:1:"1";s:18:"browser_msg_enable";s:1:"1";s:11:"browser_msg";s:121:"Your browser is blocking some features of this website. Please follow the instructions at {support_url} to unblock these.";s:10:"custom_css";s:0:"";}' );
        update_option( 'the_champ_sharing', 'a:70:{s:24:"horizontal_sharing_shape";s:5:"round";s:23:"horizontal_sharing_size";s:2:"35";s:24:"horizontal_sharing_width";s:2:"70";s:25:"horizontal_sharing_height";s:2:"35";s:24:"horizontal_border_radius";s:0:"";s:29:"horizontal_font_color_default";s:0:"";s:32:"horizontal_sharing_replace_color";s:4:"#fff";s:27:"horizontal_font_color_hover";s:0:"";s:38:"horizontal_sharing_replace_color_hover";s:4:"#fff";s:27:"horizontal_bg_color_default";s:0:"";s:25:"horizontal_bg_color_hover";s:0:"";s:31:"horizontal_border_width_default";s:0:"";s:31:"horizontal_border_color_default";s:0:"";s:29:"horizontal_border_width_hover";s:0:"";s:29:"horizontal_border_color_hover";s:0:"";s:22:"vertical_sharing_shape";s:6:"square";s:21:"vertical_sharing_size";s:2:"40";s:22:"vertical_sharing_width";s:2:"80";s:23:"vertical_sharing_height";s:2:"40";s:22:"vertical_border_radius";s:0:"";s:27:"vertical_font_color_default";s:0:"";s:30:"vertical_sharing_replace_color";s:4:"#fff";s:25:"vertical_font_color_hover";s:0:"";s:36:"vertical_sharing_replace_color_hover";s:4:"#fff";s:25:"vertical_bg_color_default";s:0:"";s:23:"vertical_bg_color_hover";s:0:"";s:29:"vertical_border_width_default";s:0:"";s:29:"vertical_border_color_default";s:0:"";s:27:"vertical_border_width_hover";s:0:"";s:27:"vertical_border_color_hover";s:0:"";s:10:"hor_enable";s:1:"1";s:21:"horizontal_target_url";s:7:"default";s:28:"horizontal_target_url_custom";s:0:"";s:5:"title";s:15:"Spread the love";s:18:"instagram_username";s:0:"";s:23:"horizontal_re_providers";a:9:{i:0;s:8:"facebook";i:1;s:7:"twitter";i:2;s:11:"google_plus";i:3;s:8:"linkedin";i:4;s:9:"pinterest";i:5;s:6:"reddit";i:6;s:9:"delicious";i:7;s:11:"stumbleupon";i:8;s:8:"whatsapp";}s:21:"hor_sharing_alignment";s:4:"left";s:3:"top";s:1:"1";s:4:"post";s:1:"1";s:4:"page";s:1:"1";s:19:"tweet_count_service";s:14:"newsharecounts";s:15:"horizontal_more";s:1:"1";s:15:"vertical_enable";s:1:"1";s:19:"vertical_target_url";s:7:"default";s:26:"vertical_target_url_custom";s:0:"";s:27:"vertical_instagram_username";s:0:"";s:21:"vertical_re_providers";a:9:{i:0;s:8:"facebook";i:1;s:7:"twitter";i:2;s:11:"google_plus";i:3;s:8:"linkedin";i:4;s:9:"pinterest";i:5;s:6:"reddit";i:6;s:9:"delicious";i:7;s:11:"stumbleupon";i:8;s:8:"whatsapp";}s:11:"vertical_bg";s:0:"";s:9:"alignment";s:4:"left";s:11:"left_offset";s:3:"-10";s:12:"right_offset";s:3:"-10";s:10:"top_offset";s:3:"100";s:13:"vertical_home";s:1:"1";s:13:"vertical_post";s:1:"1";s:13:"vertical_page";s:1:"1";s:28:"vertical_tweet_count_service";s:14:"newsharecounts";s:13:"vertical_more";s:1:"1";s:19:"hide_mobile_sharing";s:1:"1";s:21:"vertical_screen_width";s:3:"783";s:21:"bottom_mobile_sharing";s:1:"1";s:23:"horizontal_screen_width";s:3:"783";s:23:"bottom_sharing_position";s:1:"0";s:24:"bottom_sharing_alignment";s:4:"left";s:14:"bitly_username";s:0:"";s:9:"bitly_key";s:0:"";s:31:"share_count_cache_refresh_count";s:2:"10";s:30:"share_count_cache_refresh_unit";s:7:"minutes";s:8:"language";s:5:"en_US";s:16:"twitter_username";s:0:"";s:15:"buffer_username";s:0:"";}' );
        update_option( 'the_champ_counter', 'a:4:{s:11:"left_offset";s:3:"-10";s:12:"right_offset";s:3:"-10";s:10:"top_offset";s:3:"100";s:9:"alignment";s:4:"left";}' );


        reset_permalinks();
    }
    add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );
    
    
    function reset_permalinks() {
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();
    }
    
?>
