<?php
/*
 *Plugin Name: Recipe
 * Description: A simlpe WordPress plugin that allows users to create recipes and rate those recipes
 * Version: 1.0
 * Author: Kervin
 * Author URI: http://udemy.com
 * Text Domain: recipe
 */

if(!function_exists('add_action')) {
    die("You shouldn't be calling me directly, my friend.");
}

//Setup
define('RECIPE_PLUGIN_URL',__FILE__);

// Includes
include('includes/activate.php');
include('includes/init.php');
include('includes/admin/init.php');

// Hooks
register_activation_hook(__FILE__,'r_activate_plugin');
add_action('init','recipe_init');
add_action('admin_init','recipe_admin_init');

// Shortcodes