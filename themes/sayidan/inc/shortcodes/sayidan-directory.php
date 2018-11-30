 <?php
/*
Widget Name: Sayidan Directory Widget
Description: Create Directory Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_directory_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_directory_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Directory', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Directory Section', 'sayidan'),
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
                'type' => array(
                    'type' => 'radio',
                    'label' => esc_html__( 'Choose data source', 'sayidan' ),
                    'description' => esc_html__('"Auto" list students automatically from registrtions. "Manual" register students manually under Directory section from WordPress admin menu.', 'sayidan'),
                    'default' => 'auto',
                    'options' => array(
                        'auto' => esc_html__( 'Auto', 'sayidan' ),
                        'manual' => esc_html__( 'Manual', 'sayidan' ),    
                    )
                ),
                'category' => array(
                    'type' => 'text',
                    'label' => esc_html__('Category', 'sayidan'),
                    'description' => esc_html__('You can split directory by different categories (only if "Manual" option selected).', 'sayidan'),
                    'default' => ''
                ),
                'records_per_page' => array(
                    'type' => 'text',
                    'label' => esc_html__( 'Records per page', 'sayidan' ),
                    'description' => esc_html__('Number of records/students to display per one page', 'sayidan'),
                ),
                'search_bar' => array(
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable search bar', 'sayidan' ),
                    'description' => esc_html__('Disable/enable search bar', 'sayidan'),
                ),
          
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-directory';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_directory_widget', __FILE__, 'sayidan_directory_widget');

endif;