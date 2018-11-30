 <?php
/*
Widget Name: Sayidan Map Widget
Description: Create Static Map Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_map_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_map_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Static Map', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Static Map Section', 'sayidan'),
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
                'image' => array(
                    'type' => 'media',
                    'label' => esc_html__( 'Choose background image, preferably 1170 × 500', 'sayidan' ),
                    'choose' => esc_html__( 'Choose image', 'sayidan' ),
                    'update' => esc_html__( 'Set image', 'sayidan' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'subtitle' => array(
                    'type' => 'text',
                    'label' => esc_html__('Subtitle', 'sayidan'),
                    'description' => esc_html__('You can split map by different categories (only if "Manual" option selected).', 'sayidan'),
                    'default' => ''
                ),
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-map';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_map_widget', __FILE__, 'sayidan_map_widget');

endif;