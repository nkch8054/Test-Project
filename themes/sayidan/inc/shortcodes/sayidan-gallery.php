<?php
/*
Widget Name: Sayidan Gallery Widget
Description: Create Gallery Section
Author: Kenzap
Author URI: http://kenzap.com
Widget URI: http://kenzap.com/,
Video URI: http://kenzap.com/
*/

if( class_exists( 'SiteOrigin_Widget' ) ) : 

class sayidan_gallery_widget extends SiteOrigin_Widget {

    function __construct() {
        //Here you can do any preparation required before calling the parent constructor, such as including additional files or initializing variables.

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'sayidan_gallery_widget',

            // The name of the widget for display purposes.
            esc_html__('Sayidan Gallery', 'sayidan'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => esc_html__('Create Gallery Section', 'sayidan'),
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
                    'label' => esc_html__('Gallery title', 'sayidan'),
                    'default' => ''
                ),
                'images_per_page' => array(
                   'type' => 'number',
                   'label' => esc_html__('Images per page', 'sayidan'),
                   'default' => ''
                ),
                'pagination' => array(
                    'type' => 'checkbox',
                    'label' => esc_html__( 'Pagination', 'sayidan' ),
                    'description' => esc_html__('Show/hide paginaton below gallery images', 'sayidan'),
                ),
                'category' => array(
                    'type' => 'text',
                    'label' => esc_html__('Category', 'sayidan'),
                    'description' => esc_html__('You can categorize images by categories', 'sayidan'),
                    'default' => ''
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
                'text' => array(
                    'type' => 'text',
                    'label' => esc_html__('Gallery text', 'sayidan'),
                    'default' => ''
                ),
                'icon' => array(
                    'type' => 'text',
                    'label' => esc_html__('Gallery icon', 'sayidan'),
                    'default' => ''
                ),
                'link' => array(
                   'type' => 'link',
                   'label' => esc_html__('Link', 'sayidan'),
                   'description' => esc_html__('For minified preview type provide link', 'sayidan'),
                   'default' => '#'
                ),
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function get_template_name($instance) {
        return 'sayidan-gallery';
    }

    function get_template_dir($instance) {
        return 'widgets';
    }
}

siteorigin_widget_register('sayidan_gallery_widget', __FILE__, 'sayidan_gallery_widget');

endif;

function sayidan_shortcode_gallery($atts, $content = null) {
    extract(shortcode_atts(array(
        "title"             => '',
        "pagination"        => 'true',
        "images_per_page"   => '16',
        "type"              => 'normal',
        "link"              => '',
        "text"              => '',
        "icon"              => '',
        "category"          => ''
    ), $atts));

    ob_start();
    
    if( $type == 'normal' ) :
    ?>

    <div class="galery-wrapper">
        <div class="container">
            <?php if( $title ) : ?>
            <div class="galery-title text-center">
                <h4 class="heading-regular"><?php echo esc_html( $title ); ?></h4>
            </div>
            <?php endif; ?>
            <div class="galery-content">
                <ul>
                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                                  'post_status'     => 'publish',
                                  'post_type'       => 'gallery',
                                  'category_name'   => $category,
                                  'posts_per_page'  => $images_per_page,
                                  'paged'           => $paged,
                                  );
                                  $postCount = 0;
                                  $recentPosts = new WP_Query( $args );
                                  
                    if ( $recentPosts->have_posts() ) :
                        while ( $recentPosts->have_posts() ) : $recentPosts->the_post();
                    ?>
                    
                    <li class="col-sm-3 col-xs-6">
                        <div class="galery-item">
                            <?php the_post_thumbnail( 'sayidan-gallery', array( 'class' => 'img-responsive' ) ); ?>
                            <div class="galery-content">
                                <h4><?php echo the_title();?></h4>
                                <a href="#" class="popup-click"><span class="lnr lnr-magnifier"></span></a>
                            </div>
                            <div class="box-content-item">
                                <div class="box-img">
                                    <?php the_post_thumbnail( 'sayidan-story-large', array( 'class' => 'img-responsive' ) ); ?>
                                </div>
                                <div class="desc">
                                    <?php the_excerpt(); ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <?php   endwhile;
                            endif;
                            wp_reset_postdata();
                    ?>
                </ul>
            </div>
            <?php if( $pagination == 'true'){ sayidan_pagination( $recentPosts ); } ?>

        </div>
        
        <div class="bg-popup"></div>
        <div class="wrapper-popup">
            <a href="javascript:void(0)" class="close-popup"><span class="lnr lnr-cross-circle"></span></a>
            <div class="popup-content">
                <!--content-popup   -->
            </div>
        </div>
    </div>

    <?php elseif( $type == 'minified' ) : ?>

    <!--begin instagream-->
    <div class="instagream">
        <div class="instagram-feed clearfix">
            <ul class="list-item no-margin">
                <?php  $args = array(
                    'post_status'     => 'publish',
                    'post_type'       => 'gallery',
                    'category_name'   => $category,
                    'posts_per_page'  => $images_per_page,
                    );

                    $recentPosts = new WP_Query( $args );
                    
                    if ( $recentPosts->have_posts() ) :
                        while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
                        <li class="no-padding no-margin no-style" style="width:<?php echo 100/intVal( $images_per_page );?>%"><a href="<?php echo esc_attr( $link ); ?>"><?php the_post_thumbnail( 'sayidan-gallery', array( 'class' => 'img-responsive' ) ); ?></a></li>
                        <?php endwhile;
                    endif;
                    ?>
            </ul>
            <div class="instagram-feed-user text-center">
                <div class="user-wrapper">
                    <span class="icon-instagram"><i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i></span>
                    <span class="name-user"><?php echo esc_attr( $text ); ?></span>
                </div>
            </div>
        </div>
    </div>
    <!--end instagream-->

    <?php endif;
    
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
    }
    