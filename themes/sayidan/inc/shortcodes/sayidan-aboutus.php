<?php
/*
Widget Name: Sayidan Aboutus Widget
Description: Create About Us Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_aboutus_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_aboutus_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan About us', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create About Us Section', 'sayidan'),
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
                    'label' => esc_html__('About us title', 'sayidan'),
                    'default' => ''
                ),
                'text1' => array(
                    'type' => 'textarea',
                    'label' => esc_html__('Text 1', 'sayidan'),
                    'default' => ''
                ),
                'text2' => array(
                   'type' => 'textarea',
                   'label' => esc_html__('Text 2', 'sayidan'),
                   'default' => ''
                   ),
                'image' => array(
                    'type' => 'media',
                    'label' => esc_html__( 'Choose background image', 'sayidan' ),
                    'choose' => esc_html__( 'Choose image', 'sayidan' ),
                    'update' => esc_html__( 'Set image', 'sayidan' ),
                    'library' => 'image',
                    'fallback' => true
                ),
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-aboutus';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_aboutus_widget', __FILE__, 'sayidan_aboutus_widget');

endif;

    function sayidan_shortcode_aboutus( $atts, $content = null ) {
        extract(shortcode_atts(array(
                                     "image" => '',
                                     "title" => '',
                                     "subtitle" => '',
                                     "text1" => '',
                                     "text2" => ''
                                     ), $atts));
        
        ob_start();
        ?>

        <!--begin about us-->
        <div class="about-us" >
        <div class="about-us-title text-center" style="background-image: url('<?php echo esc_url( $image ); ?>');">
        <div class="container">
        <h1 class="heading-bold text-uppercase"><?php echo esc_attr( $title ); ?></h1>
        </div>
        </div>
        <div class="about-us-content">
        <div class="container">
        <div class="content-wrapper">
        <p class="text-light"><?php echo esc_attr( $text1 ); ?></p>
        <p class="text-light"><?php echo esc_attr( $text2 ); ?></p>
        </div>
        </div>
        </div>
        </div>
        <!--end about us-->


<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
