 <?php
/*
Widget Name: Sayidan Banner Widget
Description: Create Banner Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_banner_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_banner_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Banner', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Banner Section', 'sayidan'),
                'panels_groups' => array('sayidan'),
                'help'        => 'http://sayidan_docs.kenzap.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => esc_html__('Title', 'sayidan'),
                    'default' => ''
                ),
                'subtitle' => array(
                    'type' => 'text',
                    'label' => esc_html__('Subtitle', 'sayidan'),
                    'default' => ''
                ),
                'text' => array(
                   'type' => 'textarea',
                   'label' => esc_html__('Text', 'sayidan'),
                   'default' => ''
                ),
                'type' => array(
                    'type' => 'radio',
                    'label' => esc_html__( 'Choose banner type from selection below', 'sayidan' ),
                    'default' => 'alumni_stories',
                    'options' => array(
                        'alumni_stories' => esc_html__( 'Alumni Stories', 'sayidan' ),     
                    )
                ),
                'image' => array(
                    'type' => 'media',
                    'label' => esc_html__( 'Choose background image, preferably 1539 × 551', 'sayidan' ),
                    'choose' => esc_html__( 'Choose image', 'sayidan' ),
                    'update' => esc_html__( 'Set image', 'sayidan' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'button_url' => array(
                   'type' => 'link',
                   'label' => esc_html__('Button Link', 'sayidan'),
                   'description' => esc_html__('Button url', 'sayidan'),
                   'default' => '#'
                ),
                'button_text' => array(
                   'type' => 'text',
                   'label' => esc_html__('Button Text', 'sayidan'),
                   'description' => esc_html__('Button CTA text', 'sayidan'),
                   'default' => ''
                ),
   
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-banner';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_banner_widget', __FILE__, 'sayidan_banner_widget');

endif;
