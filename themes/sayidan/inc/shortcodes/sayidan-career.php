 <?php
/*
Widget Name: Sayidan Career Widget
Description: Create Career Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_career_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_career_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Career', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Career Section', 'sayidan'),
                'panels_groups' => array('sayidan'),
                'help'        => 'http://sayidan_docs.kenzap.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(

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
                'show_filter' => array(
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Show filter', 'sayidan' ),
                    'description' => esc_html__('Show/hide filter to refine search results', 'sayidan'),
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
        return 'sayidan-career';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_career_widget', __FILE__, 'sayidan_career_widget');

endif;
