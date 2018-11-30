<?php
function sayidan_block_shortcode($atts, $content = null) {
	$atts = shortcode_atts(array(
        "id" => '',
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"placeholder" => '',
		"button_text" => ''
	), $atts);

	ob_start();

    // get Page ID by slug
    global $wpdb, $post;
    $post_id = $wpdb->get_var( $wpdb->prepare(
      "SELECT ID FROM {$wpdb->posts} WHERE post_name = '%s' ",
      $atts['id'] //function will do the sanitization for you
    ) );


    $permalink =  get_permalink($post_id); 
    if($post_id){
        
        $html = apply_filters( 'the_content', get_post_field( 'post_content', $post_id), $atts );
        
        // add edit link for admins
        if (current_user_can('edit_pages')) {
            $edit_link = get_edit_post_link( $post_id );
            $html = '<div id="block-'.esc_attr( $atts['id'] ).'" class="sayidan_block"><a class="edit-link" href="'.$edit_link.'&preview_url='.$post->ID.'">Edit Block</a>'.$html.'</div>';
        }
        
        $html = do_shortcode( $html );
        
    } else{
        
        $html = '<p><mark>Block <b>"'.esc_attr( $atts['id'] ).'"</b> not found!</mark></p>';
        
    }
    return $html;
    
    ?>

    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
    
function sayidan_shortcode_blocks_row($atts, $content = null) {
    $atts = shortcode_atts(array(
     "id" => '',
    ), $atts);
    
    ob_start();
    ?>
    <div class="block-links">
        <div class="container">
            <div class="row">
                <?php echo sayidan_fix_shortcode($content); ?>
            </div>
        </div>
    </div>
    <?php
    wp_reset_postdata();
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}   