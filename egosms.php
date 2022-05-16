<?php
/**
 * Plugin Name: Egosms
 * Description: The Egosms integrates the Ego Sms Bulk messaging platform in your wordpress website.
 * Plugin URI: https://github.com/dancan-edgar/egosms.git
 * Author: Ampeire Edgar
 * Version: 1.0.0
 * Author URI: https://github.com/dancan-edgar
 *
 * Text Domain: egosms
 *
 * @package Egosms
 * @author Ampeire Edgar
 * @license GPL-V2
 *
 * Egosms Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Egosms Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

// If accessed directly, abort !!
if(! defined('ABSPATH')){
    die("You dont have access!");
}

define('PLUGIN_PATH',plugin_dir_path(__FILE__));
define('PLUGIN_URL',plugin_dir_url(__FILE__));
define('PLUGIN',plugin_basename(__FILE__));

if (file_exists( PLUGIN_PATH . '/vendor/autoload.php')){
    require_once PLUGIN_PATH . '/vendor/autoload.php';
}

// Require one the Composer Autoload file
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {

    require_once dirname(__FILE__) . '/vendor/autoload.php';

}
// include database file
include_once('inc/Base/Egosmsdb_file.php');

// register hook
register_activation_hook(__FILE__, 'create_egosms_table');

// Function to be triggered on activate
function egosms_activate()
{
    Inc\Base\Activate::activate();
}
// Activation hook
register_activation_hook(__FILE__, 'egosms_activate');

// Function to be triggered on deactivate
function egosms_deactivate()
{
    Inc\Base\Deactivate::deactivate();
}
// Deactivation hook
register_deactivation_hook(__FILE__, 'egosms_deactivate');

if (class_exists('Inc\\Init')) {

    Inc\Init::register_services();
}
