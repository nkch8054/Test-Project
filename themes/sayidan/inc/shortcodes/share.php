<?php
function sayidan_shortcode_share($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts));

	ob_start();
    
    $permalink = get_permalink( the_ID() );
	?>

<!--begin share-->
<div class="share">
    <div class="container">
        <div class="box-share">
            <h4><?php echo esc_attr( $title ); ?></h4>
            <ul>
                <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php esc_html_e('Share on Facebook','sayidan'); ?>"><span class="hidden">facebook</span></a></li>
                <li class="twitter"><a href="https://twitter.com/share?url=<?php echo esc_url( $permalink ); ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" title="<?php esc_html_e('Share on Twitter','sayidan'); ?>"><span class="hidden">twitter</span></a></li>
                <li class="google"><a href="//plus.google.com/share?url=<?php echo esc_url( $permalink ); ?>" target="_blank" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" title="<?php esc_html_e('Share on Google+','sayidan'); ?>"><span class="hidden">google</span></a></li>
            </ul>
        </div>
    </div>
</div>
<!--end share-->


<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}