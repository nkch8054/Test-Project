<?php
/**
 * Sayidan Theme Customizer.
 *
 * @package Sayidan
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sayidan_customize_register( $wp_customize ) {
    
    //add description
    $wp_customize->add_setting( 'sayidan_desc',
                                array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                ) );
    
    $wp_customize->add_control( 'sayidan_desc', array(
            'label'     => esc_html__( 'Description', 'sayidan' ),
            'section'   => 'title_tagline',
            'priority'  => 10,
            'type'      => 'textarea'
    ) );
    
    //add footnote
    $wp_customize->add_setting( 'sayidan_footnote',
                                array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                ) );
    
    $wp_customize->add_control( 'sayidan_footnote', array(
            'label'     => esc_html__( 'Footer Note', 'sayidan' ),
            'section'   => 'title_tagline',
            'priority'  => 10,
            'type'      => 'textarea'
    ) );
    
    //add social network support
    $wp_customize->add_section( 'sayidan_social_section' , array(
            'title'       => esc_html__( 'Social Networks', 'sayidan' ),
            'priority'    => 21,
            'description' => 'Set up social network links and icons, enter Twitter API keys.',
    ) );

    $wp_customize->add_setting( 'social_header', array(
             'sanitize_callback' => 'sayidan_sanitize_text',
    ) );
    
    $wp_customize->add_control( 'social_header', array(
             'label'     => esc_html__( 'Enable/disable social icons in header', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'checkbox'
    ) );
       

    $wp_customize->add_setting( 'facebook', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'facebook', array(
             'label'     => esc_html__( 'Facebook', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'youtube', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'youtube', array(
             'label'     => esc_html__( 'Youtube', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'twitter', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'twitter', array(
             'label'     => esc_html__( 'Twitter', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'linkedin', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'linkedin', array(
             'label'     => esc_html__( 'LinkedIn', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'pinterest', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'pinterest', array(
             'label'     => esc_html__( 'Pinterest', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'google', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'google', array(
             'label'     => esc_html__( 'Google', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'tumblr', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'tumblr', array(
             'label'     => esc_html__( 'Tumblr', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'instagram', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'instagram', array(
             'label'     => esc_html__( 'Instagram', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'vimeo', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'vimeo', array(
             'label'     => esc_html__( 'Vimeo', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'vk', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'vk', array(
             'label'     => esc_html__( 'Vkontakte', 'sayidan' ),
             'section'   => 'sayidan_social_section',
             'priority'  => 10,
             'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'disqus', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'disqus', array(
           'label'     => esc_html__( 'Disqus', 'sayidan' ),
           'section'   => 'sayidan_social_section',
           'priority'  => 10,
           'type'      => 'text'
    ) );
    
    
    $wp_customize->add_setting( 'twitter_c_key', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'twitter_c_key', array(
            'label'     => esc_html__( 'Twitter Consumer Key:', 'sayidan' ),
            'section'   => 'sayidan_social_section',
            'priority'  => 80,
            'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'twitter_c_secret', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'twitter_c_secret', array(
           'label'     => esc_html__( 'Twitter Consumer Secret:', 'sayidan' ),
           'section'   => 'sayidan_social_section',
           'priority'  => 81,
           'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'twitter_a_token', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'twitter_a_token', array(
           'label'     => esc_html__( 'Twitter Access Token:', 'sayidan' ),
           'section'   => 'sayidan_social_section',
           'priority'  => 82,
           'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'twitter_a_secret', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'twitter_a_secret', array(
           'label'     => esc_html__( 'Twitter Access Token Secret:', 'sayidan' ),
           'section'   => 'sayidan_social_section',
           'priority'  => 83,
           'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'twitter_username',
                               array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'twitter_username', array(
           'label'     => esc_html__( 'Twitter Username:', 'sayidan' ),
           'section'   => 'sayidan_social_section',
           'priority'  => 10,
           'type'      => 'text'
    ) );
    
    $wp_customize->add_setting( 'twitter_cache', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( 'twitter_cache', array(
           'label'     => esc_html__( 'Tweets Cache Time (hours):', 'sayidan' ),
           'section'   => 'sayidan_social_section',
           'priority'  => 10,
           'type'      => 'number'
    ) );
    
    //add logo support
    $wp_customize->add_section( 'sayidan_logo_section' , array(
            'title'       => esc_html__( 'Logo', 'sayidan' ),
            'priority'    => 20,
            'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );
    
    $wp_customize->add_setting( 'sayidan_logo',
                               array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sayidan_logo', array(
            'label'    => esc_html__( 'Logo Desktop', 'sayidan' ),
            'section'  => 'sayidan_logo_section',
            'settings' => 'sayidan_logo',
    ) ) );
    
    //add mobile logo support
    $wp_customize->add_setting(
                               'sayidan_logo_mobile',
                               array(
                                     //'default'     => '#000000',
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     //'transport'   => 'postMessage',
                                     )
                               );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sayidan_logo_mobile', array(
            'label'    => esc_html__( 'Logo Mobile', 'sayidan' ),
            'section'  => 'sayidan_logo_section',
            'settings' => 'sayidan_logo_mobile',
    ) ) );
    
    //add footer logo support
    $wp_customize->add_setting( 'sayidan_logo_footer',
                               array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     )  );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sayidan_logo_footer', array(
            'label'    => esc_html__( 'Logo Footer', 'sayidan' ),
            'section'  => 'sayidan_logo_section',
            'settings' => 'sayidan_logo_footer',
    ) ) );
    
    //logo position
    $wp_customize->add_setting( 'sayidan_logo_position', array(
                               'sanitize_callback' => 'sayidan_sanitize_text',
    ) );
    
    $wp_customize->add_control( 'sayidan_logo_position', array(
                               'label'     => esc_html__( 'Logo Position', 'sayidan' ),
                               'section'   => 'sayidan_logo_section',
                               'priority'  => 10,
                               'type'      => 'radio',
                               'choices'   => array(
                                        'left'  => 'left',
                                        'center' => 'center',
                                ),
    ) );
    
    //add contacts support
    $wp_customize->add_section( 'sayidan_contacts_section' , array(
            'title'       => esc_html__( 'Contacts', 'sayidan' ),
            'priority'    => 30,
            'description' => 'Set up contact details.',
    ) );
    
    //phone number 1
    $wp_customize->add_setting( 'sayidan_phone',
                               array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'sayidan_phone', array(
            'label'     => esc_html__( 'Phone Number 1', 'sayidan' ),
            'section'   => 'sayidan_contacts_section',
            'priority'  => 20,
            'type'      => 'text'
    ) );
    
    //phone number 2
    $wp_customize->add_setting( 'sayidan_phone2',
                               array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'sayidan_phone2', array(
           'label'     => esc_html__( 'Phone Number 2', 'sayidan' ),
           'section'   => 'sayidan_contacts_section',
           'priority'  => 21,
           'type'      => 'text'
           ) );
    
    //email
    $wp_customize->add_setting( 'sayidan_email',
                               array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'sayidan_email', array(
           'label'     => esc_html__( 'Email', 'sayidan' ),
           'section'   => 'sayidan_contacts_section',
           'priority'  => 10,
           'type'      => 'text'
    ) );
    
    // add "Content Options" section
    $wp_customize->add_section( 'sayidan_navigation' , array(
            'title'      => esc_html__( 'Navigation', 'sayidan' ),
            'priority'   => 100,
    ) );
    
    // add setting for page comment toggle checkbox
    $wp_customize->add_setting( 'sayidan_page_comment_toggle', array(
            'default' => 1,
            'sanitize_callback' => 'sayidan_sanitize_text',
    ) );
    
    // add control for page comment toggle checkbox
    $wp_customize->add_control( 'sayidan_page_comment_toggle', array(
            'label'     => esc_html__( 'Show comments on pages?', 'sayidan' ),
            'section'   => 'sayidan_navigation',
            'priority'  => 10,
            'type'      => 'checkbox'
    ) );
    
    //dashboard link
    $wp_customize->add_setting( 'sayidan_dash_link', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'sayidan_dash_link', array(
           'label'     => esc_html__( 'Account Link', 'sayidan' ),
           'section'   => 'sayidan_navigation',
           'priority'  => 10,
           'type'      => 'text'
    ) );
    
    //login link
    $wp_customize->add_setting( 'sayidan_login_link', array(
                                     'sanitize_callback' => 'sayidan_sanitize_text',
                                     ) );
    
    $wp_customize->add_control( 'sayidan_login_link', array(
           'label'     => esc_html__( 'Login Link', 'sayidan' ),
           'section'   => 'sayidan_navigation',
           'priority'  => 20,
           'type'      => 'text'
    ) );

    //Theme Main Color
    $wp_customize->add_setting( 'sayidan_main_color', array(
                                                            'sanitize_callback' => 'sayidan_sanitize_text',
                                                            )  );
    
    $wp_customize->add_control(
       new WP_Customize_Color_Control(
            $wp_customize,
            'main_color',
            array(
                'label'      => esc_html__( 'Theme Main Color', 'sayidan' ),
                'section'    => 'colors',
                'settings'   => 'sayidan_main_color',
            ) )
    );
    
    $wp_customize->remove_control( 'header_textcolor' );
    $wp_customize->remove_control( 'background_color' );
    //Theme Sub Color
    $wp_customize->add_setting( 'sayidan_sub_color', array(
                                                           'sanitize_callback' => 'sayidan_sanitize_text',
                                                           )  );
    
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'sub_color',
            array(
                'label'      => esc_html__( 'Theme Sub Color', 'sayidan' ),
                'section'    => 'colors',
                'settings'   => 'sayidan_sub_color',
            ) )
    );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->add_section( 'custom_css', array(
                                                    'title' => esc_html__( 'Custom CSS', 'sayidan' ),
                                                    'description' => esc_html__( 'Add custom CSS here', 'sayidan' ),
                                                    'panel' => '', // Not typically needed.
                                                    'priority' => 160,
                                                    'capability' => 'edit_theme_options',
                                                    'theme_supports' => '', // Rarely needed.
                                                    ) );
    
    
    
    
    // add "Advanced" section
    $wp_customize->add_section( 'sayidan_advanced' , array(
                                                             'title'      => esc_html__( 'Advanced', 'sayidan' ),
                                                             'priority'   => 100,
                                                             ) );
    
    // add setting for page comment toggle checkbox
    $wp_customize->add_setting( 'sayidan_minified', array(
                                                             'default' => 1,
                                                             'sanitize_callback' => 'sayidan_sanitize_text',
                                                             ) );
    
    // add control for page comment toggle checkbox
    $wp_customize->add_control( 'sayidan_minified', array(
                                                             'label'     => esc_html__( 'Minify JS and CSS', 'sayidan' ),
                                                             'section'   => 'sayidan_advanced',
                                                             'priority'  => 10,
                                                             'description' => 'May significantly improve website performance and overall load times',
                                                             'type'      => 'checkbox'
                                                             ) );

    // add setting for page comment toggle checkbox
    $wp_customize->add_setting( 'sayidan_maps_api', array(
                                                             'default' => 1,
                                                             'sanitize_callback' => 'sayidan_sanitize_text',
                                                             ) );

    // add control for page comment toggle checkbox
    $wp_customize->add_control( 'sayidan_maps_api', array(
                                                             'label'     => esc_html__( 'Google Maps API Key', 'sayidan' ),
                                                             'section'   => 'sayidan_advanced',
                                                             'priority'  => 15,
                                                             'description' => 'Can be obtained here: https://developers.google.com/maps/documentation/javascript/get-api-key',
                                                             'type'      => 'text'
                                                             ) );


}
add_action( 'customize_register', 'sayidan_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sayidan_customize_preview_js() {
	wp_enqueue_script( 'sayidan_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sayidan_customize_preview_js' );

function sayidan_sanitize_text( $str ) {
    return sanitize_text_field( $str );
} 

