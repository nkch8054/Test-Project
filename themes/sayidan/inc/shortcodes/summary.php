<?php
function sayidan_shortcode_summary( $atts, $content = null ) {
	extract(shortcode_atts(array(
		"image" => '',
		"title" => '',
		"subtitle" => '',
		"tab1_title" => '',
        "tab2_title" => '',
        "tab3_title" => '',
		"button_text" => ''
	), $atts));

	ob_start();
	?>

<!--begin programs & services-->
<div class="programs-services">
    <div class="container">
        <div class="row">
            <div class="services-img col-md-6 col-sm-12 col-xs-12">
                <img class="img-responsive" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
            </div>
            <div class="services-content col-md-6 col-sm-12 col-xs-12">
                <h2 class="heading-regular"><?php echo esc_attr( $title ); ?></h2>
                <div id="tab_services">
                    <!--Nav tabs-->
                    <ul class="nav nav-tabs" role="tablist">
                        <?php if( $tab1_title ) : ?>
                        <li role="presentation" class="active">
                            <a class="text-light" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><?php echo esc_attr( $tab1_title ); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if( $tab2_title ) : ?>
                        <li role="presentation">
                            <a class="text-light" href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?php echo esc_attr( $tab2_title ); ?></a>
                        </li>
                        <?php endif; ?>
                        <?php if( $tab3_title ) : ?>
                        <li role="presentation" >
                            <a class="text-light" href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><?php echo esc_attr( $tab3_title ); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content">
                        <?php echo sayidan_fix_shortcode($content); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end programs & services-->

<?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}