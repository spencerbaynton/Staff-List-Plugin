<?php

namespace SimpleStaffList;

use SimpleStaffList\Taxonomies\Group;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.brettshumaker.com
 * @since             1.17
 * @package           Simple_Staff_List
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Staff List
 * Plugin URI:        https://wordpress.org/plugins/simple-staff-list/
 * Description:       A simple plugin to build and display a staff listing for your website.
 * Version:           2.0.1
 * Author:            Brett Shumaker
 * Author URI:        http://www.brettshumaker.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-staff-list
 * Domain Path:       /languages
 */

require __DIR__ . '/src/Autoloader.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Define constants for the plugin
 */
define( 'STAFFLIST_URI', plugin_dir_url( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-simple-staff-list.php';

function init()
{
    $group = new Group();
    $group->registerFor('staff-member');

    add_filter('term_updated_messages', [$group, 'termUpdatedMessages'], 10, 1);
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.17
 */
function load()
{
    $autoloader = new Autoloader();
    spl_autoload_register([$autoloader, 'autoload']);

    $activator = new Activator();
    register_activation_hook(__FILE__, [$activator, 'activate']);

    $deactivator = new Deactivator();
    register_deactivation_hook(__FILE__, [$deactivator, 'deactivate']);

    $plugin = new \Simple_Staff_List();
    $plugin->run();

    add_action('init', __NAMESPACE__ . '\\init', 10, 0);
}

load();
