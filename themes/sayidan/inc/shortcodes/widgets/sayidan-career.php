<?php 
if( 1 == $instance['show_filter'] ){ $instance['show_filter'] = "true"; }else{ $instance['show_filter'] = "false"; }
echo do_shortcode( '[sayidan_career_list records_per_page="'.$instance['records_per_page'].'" category="'.$instance['category'].'" show_filter="'.$instance['show_filter'].'" ]' ); ?>