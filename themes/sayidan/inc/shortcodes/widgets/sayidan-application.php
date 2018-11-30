<div class="content-wrapper">
    <div class="account-page register text-center">
        <div class="container">
            <div class="account-title">
                <h4 class="heading-light"><?php echo esc_attr( $instance['title'] );?></h4>
            </div>
            <div class="account-content">
            <?php echo do_shortcode( '[contact-form-7 id="'.esc_attr( $instance['form_id'] ).'" title="'.esc_attr( $instance['title'] ).'"]' ); ?>
            </div>
        </div>
    </div>
</div>