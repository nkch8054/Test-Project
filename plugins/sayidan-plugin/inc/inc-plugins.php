<?php

/************ Included Plugins **********/

require plugin_dir_path(__FILE__) . 'classes/class-tgm-plugin-activation.php';


add_action( 'tgmpa_register', 'flatsome_register_required_plugins' );

function flatsome_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
         // This is an example of how to include a plugin bundled with a theme.
         /*
         array(
               'name'               => 'Sayidan Plugin', // The plugin name.
               'slug'               => 'sayidan-plugin', // The plugin slug (typically the folder name).
               'source'             => get_stylesheet_directory() . '/lib/plugins/sayidan-plugin.zip', // The plugin source.
               'required'           => true, // If false, the plugin is only 'recommended' instead of required.
               'version'            => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
               'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
               'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
               'external_url'       => '', // If set, overrides default API URL and points to an external URL.
               'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
               ),
        */
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://wordpress.org/plugins/contact-form-7/', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Regenerate Thumbnails', // The plugin name
			'slug'     				=> 'regenerate-thumbnails', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'https://wordpress.org/plugins/regenerate-thumbnails/', // If set, overrides default API URL and points to an external URL
		),
        array(
            'name'         => 'MailChimp for WordPress',
            'slug'         => 'mailchimp-for-wp',
            'required'     => false,
            'external_url' => 'https://mc4wp.com/'
        ),
        array(
            'name'     				=> 'CMB2', // The plugin name
            'slug'     				=> 'cmb2', // The plugin slug (typically the folder name)
            'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' 			=> 'https://wordpress.org/plugins/cmb2/', // If set, overrides default API URL and points to an external URL
            ),
        array(
            'name'     				=> 'Ultimate Member', // The plugin name
            'slug'     				=> 'ultimate-member', // The plugin slug (typically the folder name)
            'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
            'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' 			=> 'https://wordpress.org/plugins/ultimate-member/', // If set, overrides default API URL and points to an external URL
            ),
         array(
               'name' => 'SiteOrigin Widgets Bundle',
               'slug' => 'so-widgets-bundle',
               'source' => 'https://wordpress.org/plugins/so-widgets-bundle/',
               'required' => true,
               'recommended' => true,
               'force_activation' => true,
               ),
         array(
               'name' => 'Page Builder by SiteOrigin',
               'slug' => 'siteorigin-panels',
               'source' => 'https://wordpress.org/plugins/siteorigin-panels/',
               'required' => true,
               'recommended' => true,
               'force_activation' => true,
               ),
         array(
               'name' => 'One Click Demo Import',
               'slug' => 'one-click-demo-import',
               'source' => 'https://wordpress.org/plugins/one-click-demo-import/',
               'required' => true,
               'recommended' => true,
               'force_activation' => true,
               ),
        array(
               'name' => 'Super Socializer',
               'slug' => 'super-socializer',
               'source' => 'https://wordpress.org/plugins/super-socializer/',
               'required' => false,
               'recommended' => false,
               'force_activation' => false,
               ),
         array(
               'name'     				=> 'WP Super Cache — WordPress Plugins', // The plugin name
               'slug'     				=> 'wp-super-cache', // The plugin slug (typically the folder name)
               'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
               'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
               'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
               'external_url' 			=> 'https://wordpress.org/plugins/wp-super-cache/', // If set, overrides default API URL and points to an external URL
               ),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	  $config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme-slug' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme-slug' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),
			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

    tgmpa( $plugins, $config );

}
