<?php 
if( 1 == $instance['header'] ){ $instance['header'] = "true"; }else{ $instance['header'] = "false"; }
if( 1 == $instance['pagination'] ){ $instance['pagination'] = "true"; }else{ $instance['pagination'] = "false"; }
echo do_shortcode( '[sayidan_events title="'.$instance['title'].'" category="'.$instance['category'].'" header="'.$instance['header'].'" pagination="'.$instance['pagination'].'" ]' ); ?>