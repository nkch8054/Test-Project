<?php 

if( 1 == $instance['pagination'] ){ $instance['pagination'] = "true"; }else{ $instance['pagination'] = "false"; }
echo do_shortcode( '[sayidan_gallery title="'.$instance['title'].'" subtitle="'.$instance['subtitle'].'" text="'.$instance['text'].'" category="'.$instance['category'].'" pagination="'.$instance['pagination'].'" images_per_page="'.$instance['images_per_page'].'" icon="'.$instance['icon'].'" link="'.$instance['link'].'" type="'.$instance['type'].'"]' ); ?>
