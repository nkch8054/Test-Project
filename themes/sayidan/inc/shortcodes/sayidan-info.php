<?php

/*
Widget Name: Sayidan Info Widget
Description: Create Info Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_info_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_info_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Info', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Info Section', 'sayidan'),
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
                'button_text' => array(
                   'type' => 'text',
                   'label' => esc_html__('Button text', 'sayidan'),
                   'default' => ''
                ),
                'button_url' => array(
                   'type' => 'link',
                   'label' => esc_html__('Button link', 'sayidan'),
                   'default' => '#'
                ),     
                'a_repeater' => array(
                    'type' => 'repeater',
                    'label' => esc_html__( 'Add record' , 'sayidan' ),
                    'item_name'  => esc_html__( 'Click here to setup this record', 'sayidan' ),
                    'item_label' => array(
                        'selector'     => "[id*='repeat_text']",
                        'update_event' => 'change',
                        'value_method' => 'val'
                    ),
                    'fields' => array(
                        'title' => array(
                            'type' => 'text',
                            'label' => esc_html__('Title', 'sayidan'),
                            'default' => ''
                        ),
                        'text' => array(
                            'type' => 'textarea',
                            'label' => esc_html__('Text', 'sayidan'),
                            'default' => ''
                        ),
                        'icon' => array(
                            'type' => 'text',
                            'label' => esc_html__('Icon', 'sayidan'),
                            'description' => esc_html__('Specify icon CSS class here', 'sayidan'),
                            'default' => ''
                        ),
                        'visibility' => array(
                            'type' => 'checkbox',
                            'label' => esc_html__( 'Temporary hide this record', 'sayidan' )
                        ),
                    )
                )
            ),
            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-info';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_info_widget', __FILE__, 'sayidan_info_widget');

endif;