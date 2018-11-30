<?php
// [button]
function sayidan_button_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => '',
    'style' => '',
    'size' => '',
    'link' => '',
    'target' => ''
  ), $atts ) );

if($target) $target = 'target="'.$target.'"';
return '<a href="'.$link.'" class="button '.$size.' '.$style.'" '.$target.'>'.$text.'</a>';
}

// [facebook_login_button]
function sayidan_facebook_login_shortcode( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => 'Login / Register with Facebook',
    'size' => 'medium'
  ), $atts ) );
  	ob_start();
  	global $post;
?><a href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo the_permalink(); ?>"  class="button <?php echo esc_attr( $size ); ?> facebook-button" onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect='+window.location.href; return false;"><i class="icon-facebook"></i><?php echo esc_html( $text ); ?></a><?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}