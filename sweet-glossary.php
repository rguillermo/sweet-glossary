<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://techpecialist.com/
 * @since             1.0.0
 * @package           Sweet_Glossary
 *
 * @wordpress-plugin
 * Plugin Name:       Sweet Glossary
 * Plugin URI:        https://techpecialist.com/sweet-glossary/
 * Description:       A simple, beautiful and SEO friendly glossary plugin.
 * Version:           1.0.0
 * Author:            Techpecialist
 * Author URI:        https://techpecialist.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sweet-glossary
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
define( 'SWEET_GLOSSARY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sweet-glossary-activator.php
 */
function activate_sweet_glossary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sweet-glossary-activator.php';
	Sweet_Glossary_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sweet-glossary-deactivator.php
 */
function deactivate_sweet_glossary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sweet-glossary-deactivator.php';
	Sweet_Glossary_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sweet_glossary' );
register_deactivation_hook( __FILE__, 'deactivate_sweet_glossary' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sweet-glossary.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sweet_glossary() {

	$plugin = new Sweet_Glossary();
	$plugin->run();

}
run_sweet_glossary();
