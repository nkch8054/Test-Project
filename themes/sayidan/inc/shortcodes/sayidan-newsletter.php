 <?php
/*
Widget Name: Sayidan Newsletter Widget
Description: Create Newsletter Signup Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_newsletter_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_newsletter_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Newsletter', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Newsletter Signup Section', 'sayidan'),
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
                    'label' => esc_html__('Newsletter title', 'sayidan'),
                    'default' => ''
                ),
                'subtitle' => array(
                    'type' => 'text',
                    'label' => esc_html__('Newsletter subtitle', 'sayidan'),
                    'default' => ''
                ),
                'image' => array(
                    'type' => 'media',
                    'label' => esc_html__( 'Choose background image, preferably 1539 × 466', 'sayidan' ),
                    'choose' => esc_html__( 'Choose image', 'sayidan' ),
                    'update' => esc_html__( 'Set image', 'sayidan' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'parallax' => array(
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Enable parallax', 'sayidan' ),
                    'description' => esc_html__('Disable/enable background image parallax effect', 'sayidan'),
                ),
                'placeholder' => array(
                    'type' => 'text',
                    'label' => esc_html__('Newsletter placeholder', 'sayidan'),
                    'default' => ''
                ),
                'button_text' => array(
                    'type' => 'text',
                    'label' => esc_html__('Button text', 'sayidan'),
                    //'description' => esc_html__('May not apply to all newsletter types', 'sayidan'),
                    'default' => ''
                ),
                'id' => array(
                    'type' => 'text',
                    'label' => esc_html__('Form ID', 'sayidan'),
                    'description' => esc_html__('Go to Mailchimp for WP > Forms to find your form id. Follow instructions to register mailchilp API key.', 'sayidan'),
                    'default' => ''
                ),
          
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-newsletter';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_newsletter_widget', __FILE__, 'sayidan_newsletter_widget');

endif;