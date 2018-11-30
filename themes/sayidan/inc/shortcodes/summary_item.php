<?php
function sayidan_shortcode_summary_item($atts, $content = null) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"tab" => 'tab1',
		"active" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--Tab panes-->
<div role="tabpanel" class="tab-pane <?php echo esc_attr( $active ); ?> animated zoomIn" id="<?php echo esc_attr( $tab ); ?>">
    <div class="tab-content-wrapper">
    <?php echo wp_kses( $content, array(
                                    'a' => array(
                                                 'href' => array(),
                                                 'title' => array()
                                                 ),
                                    'ul' => array(
                                                  'class' => array(),
                                                  'id' => array()
                                                  ),
                                    'li' => array(),
                                    'strong' => array(),
                                    'b' => array(),
                                    'p' => array(),
                                    ), "" ); ?>
    </div>
</div>
<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

