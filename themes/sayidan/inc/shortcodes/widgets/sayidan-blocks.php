<?php 

$output = '';

$i = 0;
foreach( $instance['a_repeater'] as $item ){
    
    $i++;
    //visibility
    if ( $item['visibility'] == '' ){ 
    	
        $output .= '[sayidan_'.$item['type'].' title="'.$item['title'].'" records_per_page="'.$item['records_per_page'].'" category="'.$item['category'].'" button_text="'.$item['button_text'].'"  button_url="'.$item['button_url'].'" type="minified" ]';  

    }
} 

echo do_shortcode( '[sayidan_blocks_row]'.$output.'[/sayidan_blocks_row]' ); ?>