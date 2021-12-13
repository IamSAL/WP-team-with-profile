<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/IamSAL
 * @since      1.0.0
 *
 * @package    Wp_Team_Members_Profile
 * @subpackage Wp_Team_Members_Profile/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Team_Members_Profile
 * @subpackage Wp_Team_Members_Profile/includes
 * @author     Sk salman <benshadle@gmail.com>
 */
class Wp_Team_Members_Profile_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-team-members-profile',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
