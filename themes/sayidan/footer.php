<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sayidan
 */

?>
</div><!-- #content -->

<!--Begin footer wrapper-->
<div class="footer-wrapper type2">
    <footer class="foooter-container">
        <div class="container">
            <div class="footer-middle">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 animated footer-col">
                        <div class="contact-footer">
                            <?php 

                                $imgurl = (get_theme_mod( 'sayidan_logo_footer', '' ));
                                if(empty($imgurl) || '' == $imgurl){

                                    $imgurl = get_template_directory_uri() . '/images/logo-footer.png';
                                }
                            ?>
                            <div class="logo-footer">
                                <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', '' ) ); ?>' rel='home'><img src='<?php echo esc_url( $imgurl ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', '' ) ); ?>'></a>
                            </div>
                            <div class="contact-desc">
                                <p class="text-light"><?php echo esc_attr( get_theme_mod( 'sayidan_desc', '' ) ); ?></p>
                            </div>
                            <div class="contact-phone-email">
                                <?php if ( get_theme_mod( 'sayidan_phone' ) ) : ?>
                                <span class="contact-phone"><a href="tel:<?php echo preg_replace("/[^+0-9]/","",esc_attr( get_theme_mod( 'sayidan_phone' ) ) ); ?>"><?php echo esc_attr( get_theme_mod( 'sayidan_phone' ) ); ?></a> | <a href="tel:<?php echo preg_replace("/[^+0-9]/","",esc_attr( get_theme_mod( 'sayidan_phone2' ) ) ); ?>"><?php echo esc_attr( get_theme_mod( 'sayidan_phone2' ) ); ?></a> </span>
                                <?php endif; ?>
                                <span class="contact-email"><a href="mailito:<?php echo esc_attr( get_theme_mod( 'sayidan_email' ) ); ?>"><?php echo esc_attr( get_theme_mod( 'sayidan_email' ) ); ?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12  col-xs-12 animated footer-col">
                        <div class="links-footer">
                            <div class="row">
                            <?php
                            if ( has_nav_menu( 'footer' ) ) {
                                wp_nav_menu(array(
                                                  'theme_location' => 'footer',
                                                  'container'       => false,
                                                  'items_wrap'      => '%3$s',
                                                  'depth' => 2,
                                                  'walker' => new sayidan_footer_walker_nav_menu
                                                  ));
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 animated footer-col">
                        <div class="links-social">
                            <?php $sayidan_dash_link = "/profile/";
                            if( is_user_logged_in() ) {

                                if ( get_theme_mod( 'sayidan_dash_link', '/login/' ) ) {
                                    $sayidan_dash_link = get_theme_mod( 'sayidan_dash_link' );
                                }
                            }else{

                                if ( get_theme_mod( 'sayidan_login_link', '/login/' ) ) {
                                    $sayidan_dash_link = get_theme_mod( 'sayidan_login_link' );
                                }else{
                                    $sayidan_dash_link = wp_login_url( get_permalink() );
                                }
                            } ?>
                            <div class="login-dashboard">
                                <!--<a href="<?php echo esc_url( $sayidan_dash_link ); ?>" class="bg-color-theme text-center text-regular"><?php esc_html_e( 'Alumni Account', 'sayidan' ); ?></a>-->
                            </div>
                            <ul class="list-inline text-center">
                                <?php if ( get_theme_mod( 'facebook' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'facebook' ) ). '"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'twitter' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'twitter' ) ). '"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'youtube' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'youtube' ) ). '"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'linkedin' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'linkedin' ) ). '"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'pinterest' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'pinterest' ) ). '"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'google' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'google' ) ). '"><i class="fa fa-google" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'tumblr' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'tumblr' ) ). '"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'instagram' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'instagram' ) ). '"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'vimeo' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'vimeo' ) ). '"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'vk' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'vk' ) ). '"><i class="fa fa-vk" aria-hidden="true"></i></a></li>'; } ?>
                                <?php if ( get_theme_mod( 'disqus' ) ){ echo '<li><a href="' .esc_url( get_theme_mod( 'disqus' ) ). '"><i class="fa fa-disqus" aria-hidden="true"></i></a></li>'; } ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p class="copyright text-light"><?php echo esc_attr( get_theme_mod( 'sayidan_footnote', '©2016 INDIAN INSTITUTE OF MANAGEMENT RANCHI' ) ); ?></p>
            </div>
        </div>
    </footer>
</div>
<!--End footer wrapper-->

<?php wp_footer(); ?>

</body>
</html>
