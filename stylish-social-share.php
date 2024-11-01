<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.wpmaniax.com
 * @since             1.0.0
 * @package           Stylish_Social_Share
 *
 * @wordpress-plugin
 * Plugin Name:       Stylish Social Share
 * Plugin URI:        http://www.wpmaniax.com
 * Description:       Add nice looking skinnable social share bar to your Wordpress site. 12 designs to choose from.
 * Version:           1.0.1
 * Author:            WP Maniax
 * Author URI:        http://www.wpmaniax.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       stylish-social-share
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-stylish-social-share-activator.php
 */
function activate_stylish_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-stylish-social-share-activator.php';
	Stylish_Social_Share_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-stylish-social-share-deactivator.php
 */
function deactivate_stylish_social_share() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-stylish-social-share-deactivator.php';
	Stylish_Social_Share_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_stylish_social_share' );
register_deactivation_hook( __FILE__, 'deactivate_stylish_social_share' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-stylish-social-share.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_stylish_social_share() {

	$plugin = new Stylish_Social_Share();
	$plugin->run();

}
run_stylish_social_share();
