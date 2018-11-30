 <?php
/*
Widget Name: Sayidan Stories Widget
Description: Create Stories Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_stories_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_Stories_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Stories', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Stories Section', 'sayidan'),
                'panels_groups' => array('sayidan'),
                'help'        => 'http://sayidan_docs.kenzap.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(

                'columns' => array(
                    'type' => 'select',
                    'label' => esc_html__( 'Number of columns per row', 'sayidan'),
                    'default' => '2',
                    'options' => array(
                        '1' => esc_html__( '1 Column', 'sayidan'),
                        '2' => esc_html__( '2 Column', 'sayidan'),
                        '3' => esc_html__( '3 Column', 'sayidan'),
                    )
                ),
                'records_per_page' => array(
                    'type' => 'number',
                    'label' => esc_html__('Records per page', 'sayidan'),
                    'default' => ''
                ),
                'category' => array(
                    'type' => 'text',
                    'label' => esc_html__('Category', 'sayidan'),
                    'default' => ''
                ),
                'show_date' => array(
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Hide date', 'sayidan' ),
                    'description' => esc_html__('Show/hide date from story posts', 'sayidan'),
                ),
                'type' => array(
                    'type' => 'radio',
                    'label' => esc_html__( 'Choose preview type', 'sayidan' ),
                    'default' => 'normal',
                    'options' => array(
                        'normal' => esc_html__( 'Normal', 'sayidan' ),
                        'minified' => esc_html__( 'Minified', 'sayidan' ),    
                    )
                ),
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-stories';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_stories_widget', __FILE__, 'sayidan_stories_widget');

endif;
