<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Sayidan
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses sayidan_header_style()
 */
function sayidan_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'sayidan_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'sayidan_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'sayidan_custom_header_setup' );

if ( ! function_exists( 'sayidan_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see sayidan_custom_header_setup().
 */
function sayidan_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}
    // Has the text been hidden?
    if ( ! display_header_text() ) :
    ob_start(); ?>

    .site-title,
    .site-description {
        position: absolute;
        clip: rect(1px, 1px, 1px, 1px);
    }
	<?php $buffer = ob_get_clean();
    // If the user has set a custom color for the text use that.
    else :
        
    ob_start(); ?>

    .site-title a,
    .site-description {
        color: #<?php echo esc_attr( $header_text_color ); ?>;
    }
    $buffer = ob_get_clean();
	<?php endif; ?>

	<?php
    wp_enqueue_style( 'sayidan-custom-header', get_template_directory_uri() .'/css/styles.scss' );
    wp_add_inline_style( 'sayidan-custom-header', $buffer );
    
}
endif;
