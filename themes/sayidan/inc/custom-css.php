<?php
function sayidan_custom_css() {
    
    $sayidan_main_color = '#1a265c';
    $sayidan_sub_color = '#f7ca18';
    if ( get_theme_mod( 'sayidan_main_color' ) ) :
        $sayidan_main_color = get_theme_mod( 'sayidan_main_color' );
    endif;

    if ( get_theme_mod( 'sayidan_sub_color' ) ) :
        $sayidan_sub_color = get_theme_mod( 'sayidan_sub_color' );
    endif;
    
    ob_start();
?>


.top-nav, .footer-wrapper, .instagream .instagram-feed-user, .our-history .history-content .list-history li .history-dot span, .event .dark_overlay, .program-upcoming-event .dark_overlay, .page-links a { background-color: <?php echo esc_html( $sayidan_main_color ); ?> }
.um-profile-nav { background-color: <?php echo esc_html( $sayidan_main_color ); ?>!important; }
.menu .nav > li > a, .alumni-dashboard .area-content .icon, .newsletter.type2 .form-inline button, h1.page-title { color: <?php echo esc_html( $sayidan_main_color ); ?> }
.footer-wrapper.type2{border-color:<?php echo esc_html( $sayidan_main_color ); ?> }

.bg-popup{ background-color:<?php echo sayidan_hex2rgba( esc_html( $sayidan_main_color), 0.9 ); ?>; }
.program-upcoming-event .area-img-cont:after{ background: linear-gradient(<?php echo sayidan_hex2rgba( esc_html( $sayidan_main_color ), 0.7 ); ?>, <?php echo sayidan_hex2rgba( esc_html( $sayidan_main_color ), 0.7 ); ?>); }
blockquote {border-left: 4px solid <?php echo sayidan_hex2rgba( esc_html( $sayidan_main_color ), 0.7 ); ?>; }
.top-nav ul .login a{background-color:<?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 50); ?> }
.top-nav ul .login a, .top-nav ul li a, .top-nav ul li a .icon{color: <?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 120); ?>}
.input-search::-moz-placeholder{color: <?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 120); ?>}
.input-search:-ms-input-placeholder{color: <?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 120); ?>}
.input-search::-webkit-input-placeholder{color: <?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 120); ?>}
.input-search:-moz-placeholder{color: <?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 120); ?>}

.color-theme,.post__meta-item .fa, .mean-container .mean-nav ul li a:hover,.footer-wrapper .foooter-container .footer-middle .contact-footer .contact-phone-email .contact-email a:hover,.footer-wrapper .foooter-container .footer-middle .links-footer ul li a:hover,.footer-wrapper .foooter-container .footer-middle .links-social ul li a:hover,.twitter-stream .twitter-content .twitter-desc a,.job-detail .brand .brand-content a:hover, .event-calendar .event-list-content .event-list-item .date-desc-wrapper .place a:hover,.event-calendar .event-list-content .event-list-item .sold-out a:hover,.career-opportunity .top-section .sellect-career-opportunity .list-item .select .select-box li:hover,.blog-content .articles .article-item .area-content .article-right h3 a:hover, a:hover { color: <?php echo esc_html($sayidan_sub_color); ?>!important }
.bg-color-theme, .bnt-theme,.slider-hero .content-block .read-story,.alumni-interview .interview-wrapper .interview-see-story a:hover,.programs-services .services-content #tab_services .tab-content .list-item li:before,.our-history .history-content .list-history:before,.event-calendar .event-list-content .event-list-item .register a:hover,.career-opportunity .top-section .sellect-career-opportunity .list-item .button-set .bnt:hover,.latst-article .area-content .category a:hover,.blog-right .tag .list-inline li a:hover, .blog-content .articles .sticky .area-content .article-left .catetory-title{ background-color: <?php echo esc_html($sayidan_sub_color); ?>}
.programs-services .services-content #tab_services .nav-tabs > li.active > a, .programs-services .services-content #tab_services .nav-tabs > li.active > a:hover, .programs-services .services-content #tab_services .nav-tabs > li.active > a:focus,.menu .nav > li.current-menu-item  a { border-bottom: 2px solid <?php  //, .menu .nav > li > a:hover 
echo esc_html($sayidan_sub_color); ?> !important; }
.slider-hero .content-block .read-story,.alumni-interview .interview-wrapper .interview-see-story a,textarea:focus, input:focus,.alumni-story .alumni-story-wrapper .alumni-story-content h3 a:hover,.event-calendar .event-list-content .event-list-item .register a,.desc-border,.career-opportunity .top-section .sellect-career-opportunity .list-item .button-set .bnt,.pagination > li > a:hover, .pagination > li > span.current, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus{border-color:<?php echo esc_html($sayidan_sub_color); ?>!important;}
.galery-wrapper .galery-content ul li .galery-item .galery-content{ background-color:<?php echo sayidan_hex2rgba( esc_html($sayidan_sub_color), 0.9 ); ?>;}
.list-item li:before, .um-2012.um input[type=submit].um-button, .um-2012.um input[type=submit].um-button:focus, .um-2012.um a.um-button, .um-2012.um a.um-button.um-disabled:hover, .um-2012.um a.um-button.um-disabled:focus, .um-2012.um a.um-button.um-disabled:active{background-color:<?php echo esc_html($sayidan_sub_color); ?>!important;}
.bg-color-theme:hover,.date-links a:hover,.bnt-theme:hover,.list-inline a:hover,a.see-story:hover{color:#ffffff!important;}
.alumni-interview .interview-wrapper .interview-see-story a { border: 3px solid <?php echo esc_html($sayidan_sub_color); ?>;}
.sticky .area-content .article-left {border-right: 1px solid <?php echo esc_html($sayidan_sub_color); ?> !important; }
.sayidan-fact { border: 2px dashed <?php echo esc_html($sayidan_sub_color); ?>; }
.top-section .sellect-career-opportunity .list-item .button-set .bnt{border: 2px solid <?php echo esc_html($sayidan_sub_color); ?>;}
.alumni-directory .list-item li:before { background-color: #e5e5e5!important; }
.sticky .blog-post .area-content h2{border-left:4px solid <?php echo esc_html($sayidan_sub_color); ?>;}


.um-2012.um .um-field-group-head, .picker__box, .picker__nav--prev:hover, .picker__nav--next:hover, .um-2012.um .um-members-pagi span.current, .um-2012.um .um-members-pagi span.current:hover, .um-2012.um .um-profile-nav-item.active a, .um-2012.um .um-profile-nav-item.active a:hover, .upload, .um-modal-header, .um-modal-btn, .um-modal-btn.disabled, .um-modal-btn.disabled:hover, div.uimob800 .um-account-side li a.current, div.uimob800 .um-account-side li a.current:hover{background-color:<?php echo sayidan_adjust_brightness( esc_html( $sayidan_main_color ), 60); ?>!important;}
.um-left input[type=submit].um-button, .um-left input[type=submit].um-button:focus, .um-left a.um-button, .um-left  a.um-button.um-disabled:hover, .um-left  a.um-button.um-disabled:focus, .um-left a.um-button.um-disabled:active, .um-password .um-button,.um-2013.um .um-members-pagi span.current{background: <?php echo esc_html($sayidan_sub_color); ?>!important;}
.um-2011.um .um-tip:hover, .um-2011.um .um-field-radio.active i, .um-2011.um .um-field-checkbox.active i, .um-2011.um .um-member-name a:hover, .um-2011.um .um-member-more a:hover, .um-2011.um .um-member-less a:hover, .um-2011.um .um-members-pagi a:hover, .um-2011.um .um-cover-add:hover, .um-2011.um .um-profile-subnav a.active, .um-2011.um .um-item-meta a, .um-account-name a:hover, .um-account-nav a.current, .um-account-side li a.current span.um-account-icon, .um-account-side li a.current:hover span.um-account-icon, .um-dropdown li a:hover, i.um-active-color, span.um-active-color{color: <?php echo esc_html($sayidan_sub_color); ?>!important;}

<?php
$buffer = ob_get_clean();
wp_enqueue_style( 'sayidan-custom', get_template_directory_uri() .'/css/styles.scss' );
// Minify CSS
$buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );
$buffer = str_replace( ': ', ':', $buffer );
$buffer = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer );
wp_add_inline_style( 'sayidan-custom', $buffer );
    
}