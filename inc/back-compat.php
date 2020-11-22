<?php

function customer_exp_switch_them() {
    switch_theme(WP_DEFAULT_THEME);
    unset( $_GET['activated'] );
    add_action( 'admin_notices', 'customer_exp_upgrade_notices' );
}

function customer_exp_upgrade_notices() {
	/* translators: %s: WordPress version. */
	$message = sprintf( __( 'Customer Experiences requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentynineteen' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

function customer_exp_customize() {
	wp_die(
		sprintf(
			/* translators: %s: WordPress version. */
			__( 'Customer Experiences requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentynineteen' ),
			$GLOBALS['wp_version']
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'customer_exp_customize' );

function customer_exp_preview() {
	if ( isset( $_GET['preview'] ) ) {
		/* translators: %s: WordPress version. */
		wp_die( sprintf( __( 'Customer Experiences requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'twentynineteen' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'customer_exp_preview' );