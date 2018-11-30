<?php 
//if( 1 == $instance['header'] ){ $instance['header'] = "true"; }else{ $instance['header'] = "false"; }
if( 1 == $instance['search_bar'] ){ $instance['search_bar'] = "true"; }else{ $instance['search_bar'] = "false"; }
echo do_shortcode( '[sayidan_directory title="'.$instance['title'].'" category="'.$instance['category'].'" records_per_page="'.$instance['records_per_page'].'" type="'.$instance['type'].'" search_bar="'.$instance['search_bar'].'" ]' ); ?>