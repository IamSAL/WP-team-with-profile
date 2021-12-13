<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/IamSAL
 * @since             1.0.0
 * @package           Wp_Team_Members_Profile
 *
 * @wordpress-plugin
 * Plugin Name:       Wp Team Members Profile
 * Plugin URI:        https://github.com/IamSAL
 * Description:       Display team members with profile popup, just using a shortcode.
 * Version:           1.0.0
 * Author:            Sk salman
 * Author URI:        https://github.com/IamSAL
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-team-members-profile
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Wp_Team_Members_Profile_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-team-members-profile-activator.php
 */
function activate_Wp_Team_Members_Profile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-team-members-profile-activator.php';
	Wp_Team_Members_Profile_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-team-members-profile-deactivator.php
 */
function deactivate_Wp_Team_Members_Profile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-team-members-profile-deactivator.php';
	Wp_Team_Members_Profile_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Wp_Team_Members_Profile' );
register_deactivation_hook( __FILE__, 'deactivate_Wp_Team_Members_Profile' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-team-members-profile.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Wp_Team_Members_Profile() {

	$plugin = new Wp_Team_Members_Profile();
	$plugin->run();


}
run_Wp_Team_Members_Profile();
