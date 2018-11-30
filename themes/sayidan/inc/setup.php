<?php

if ( ! function_exists( 'sayidan_setup' ) ) :
function sayidan_setup() {

  /* add title tag support */
  add_theme_support( 'title-tag' );

  /* Add excerpt to pages */
  add_post_type_support( 'page', 'excerpt' );

  // wp-content/themes/sayidan-child-theme/languages/nb_NO.mo
  load_theme_textdomain( 'sayidan', get_stylesheet_directory() . '/languages' );

  /* load theme languages */
  load_theme_textdomain( 'sayidan', get_template_directory() . '/languages' );
  
  /* Add default posts and comments RSS feed links to head */
  add_theme_support( 'automatic-feed-links' );

  /* Add support for post thumbnails */
  add_theme_support( 'post-thumbnails' );

  /* Add support for HTML5 */
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    //'gallery',
    'caption',
    'widgets',
  ) );
  
  /*  Enable support for Post Formats */
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif;
    
// sayidan_setup
add_action( 'after_setup_theme', 'sayidan_setup' );
add_image_size( 'sayidan-square', 583, 573, true );
add_image_size( 'sayidan-story', 569, 331, true );
add_image_size( 'sayidan-story-large', 1536, 637, true );
add_image_size( 'sayidan-gallery', 290, 290, true );
add_image_size( 'sayidan-minified', 262, 179, true );
add_image_size( 'sayidan-thumb', 93, 93, true );
add_image_size( 'sayidan-blog', 750, 405, true );
    
/*  Registrer menus. */
register_nav_menus( array(
      'primary' => esc_html__( 'Main Menu', 'sayidan' ),
      'primary_mobile' => esc_html__( 'Main Menu - Mobile', 'sayidan' ),
      'footer' => esc_html__( 'Footer Menu', 'sayidan' ),
      ) );
    
/* add action */    
function sayidan_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
        background-image: url(<?php echo esc_url( get_theme_mod( 'sayidan_logo_mobile' ) ); ?>);
        padding-bottom: 0px;
        width: 200px;
        background-size: 200px auto;
        }
    </style>
<?php }
    
add_action( 'login_enqueue_scripts', 'sayidan_login_logo' );
    
/**
 * Deactivate default widgets
 */
function sayidan_widgets_init() {

  remove_action( 'init', 'wp_widgets_init', 1 );
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar', 'sayidan' ),
    'id'            => 'sidebar-main',
    'description'   => esc_html__( 'Blog extension sidebar for core functionality', 'sayidan' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3><div class="tx-div small"></div>',
  ) );
}

add_action( 'widgets_init', 'sayidan_widgets_init' );

/* Setup sayidan Scripts and CSS */
function sayidan_scripts() {

  $theme = wp_get_theme('sayidan');
  $version = $theme['Version'];
  //$version = 1.5;
  /* Styles */
 
  if( 1 != get_theme_mod( 'sayidan_minified' ) ){
      
      wp_enqueue_style( 'animate', get_template_directory_uri() .'/css/animate.css', array(), $version, 'all' );
      wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.css', array(), $version, 'all' );
      wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css', array(), $version, 'all' );
      wp_enqueue_style( 'meanmenu', get_template_directory_uri() .'/css/meanmenu.css', array(), $version, 'all' );
      wp_enqueue_style( 'owl.carousel', get_template_directory_uri() .'/css/owl.carousel.css', array(), $version, 'all' );
      wp_enqueue_style( 'icon-font', get_template_directory_uri() .'/css/icon-font.min.css', array(), $version, 'all' );
      wp_enqueue_style( 'superfish', get_template_directory_uri() .'/css/superfish.css', array(), $version, 'all' );

  } else {
      
      wp_enqueue_style( 'sayidan-minified', get_template_directory_uri() .'/css/sayidan.min.css', array(), $version, 'all' );
  }

  /* Load Custom styles CSS */
  wp_enqueue_style( 'sayidan-style', get_stylesheet_uri(), array(), $version, 'all');
  sayidan_custom_css();

  /* JS libaries */
  if( 1 != get_theme_mod( 'sayidan_minified' ) ){  
      
      wp_enqueue_script( 'bootstrap', get_template_directory_uri() .'/js/libs/bootstrap.min.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'owl-carousel', get_template_directory_uri() .'/js/libs/owl.carousel.min.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() .'/js/libs/jquery.meanmenu.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'jquery-syotimer', get_template_directory_uri() .'/js/libs/jquery.syotimer.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'parallax', get_template_directory_uri() .'/js/libs/parallax.min.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'modernizr-custom', get_template_directory_uri() .'/js/libs/modernizr.custom.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() .'/js/libs/jquery.waypoints.min.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'sayidan-main', get_template_directory_uri() .'/js/custom/main.js', array( 'jquery' ), $version, true );

      // Localize the script with new data
      $translation_array = array(
        'day' => esc_html__( 'day', 'sayidan' ),
        'days' => esc_html__( 'days', 'sayidan' ),
        'hour' => esc_html__( 'hour', 'sayidan' ),
        'hours' => esc_html__( 'hours', 'sayidan' ),
        'second' => esc_html__( 'second', 'sayidan' ),
        'seconds' => esc_html__( 'seconds', 'sayidan' ),
        'minute' => esc_html__( 'minute', 'sayidan' ),
        'minutes' => esc_html__( 'minutes', 'sayidan' ),
      );
      wp_localize_script( 'jquery-syotimer', 'sayidan_obj', $translation_array );
  } else {
      
      wp_enqueue_script( 'sayidan-minified', get_template_directory_uri() .'/js/sayidan.min.js', array( 'jquery' ), $version, true );
      wp_enqueue_script( 'sayidan-main', get_template_directory_uri() .'/js/custom/main.js', array( 'jquery' ), $version, true );

      // Localize the script with new data
      $translation_array = array(
        'day' => esc_html__( 'day', 'sayidan' ),
        'days' => esc_html__( 'days', 'sayidan' ),
        'hour' => esc_html__( 'hour', 'sayidan' ),
        'hours' => esc_html__( 'hours', 'sayidan' ),
        'second' => esc_html__( 'second', 'sayidan' ),
        'seconds' => esc_html__( 'seconds', 'sayidan' ),
        'minute' => esc_html__( 'minute', 'sayidan' ),
        'minutes' => esc_html__( 'minutes', 'sayidan' ),
      );
      wp_localize_script( 'sayidan-minified', 'sayidan_obj', $translation_array );
  }

  /* add JS variables to scripts */
  wp_localize_script( 'sayidan-theme-js', 'ajaxURL',  array( 'ajaxurl'    => admin_url( 'admin-ajax.php' ) ) );
  wp_localize_script( 'sayidan-theme-js-minified', 'ajaxURL',  array( 'ajaxurl'    => admin_url( 'admin-ajax.php' ) ) );
  $googleapis = get_theme_mod( 'sayidan_maps_api', '' );
  if ( !empty($googleapis) && '' != $googleapis ){
    wp_enqueue_script( 'maps.googleapis', 'https://maps.googleapis.com/maps/api/js?callback=initMap&key='.esc_attr( $googleapis ), array('jquery'), $version, true );
  }
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'sayidan_scripts' );
   
function sayidan_image_dimensions() {
  global $pagenow;
 
  if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
    return;
  }
}
    
add_action( 'after_switch_theme', 'sayidan_image_dimensions', 1 );

//footer menu nav walker
class sayidan_footer_walker_nav_menu extends Walker_Nav_Menu {
    
    // add classes to ul sub-menus
    public $sayidan_depth_couter = 0;
    function __construct(){
        $this->sayidan_depth_couter = 0;
  
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
                         'sub-menu',
                         ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
                         ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
                         'menu-depth-' . $display_depth
                         );
        $class_names = implode( ' ', $classes );
        
        // build html
        if($this->sayidan_depth_couter<3){
        $output .= "\n" . $indent . '<ul class="list-unstyled no-margin ' . $class_names . '">' . "\n";
      }
    }
    
    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        
        // depth dependent classes
        $depth_classes = array(
                               ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
                               ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
                               ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                               'menu-item-depth-' . $depth
                               );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        
        
        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        if($this->sayidan_depth_couter<3){
          if( $depth == 0 ) {
              
             
              $output .= "\n".'<div class="col-sm-4 col-xs-12 ' . $class_names . '">';
              $item_output = sprintf( '%1$s<h6 class="heading-bold">%3$s%4$s%5$s</h6>%6$s',
                                     $args->before,
                                     $attributes,
                                     $args->link_before,
                                     apply_filters( 'the_title', $item->title, $item->ID ),
                                     $args->link_after,
                                     $args->after
                                     );
          }else{
              
              $output .= $indent . '<li class="' . $class_names . '">';
              $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                                     $args->before,
                                     $attributes,
                                     $args->link_before,
                                     apply_filters( 'the_title', $item->title, $item->ID ),
                                     $args->link_after,
                                     $args->after
                                     );
          }
        
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }
    }
    
    function end_el(&$output, $item, $depth=0, $args=array()) {
        if( $depth == 0 ) {
            
            if($this->sayidan_depth_couter<3){
            $output .= "</div>\n";
             $this->sayidan_depth_couter++;
          }
        }
    }
}