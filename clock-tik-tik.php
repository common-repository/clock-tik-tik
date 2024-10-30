<?php

/*
Plugin Name: Clock Tik Tik
Plugin URI:
Description: Add any timezone clock in analog and digital 
Version: 1.0
Author: Blitz Mobile Apps
License: GPLv2
Author URI: https://blitzmobileapps.com/
Requires at least: 5.5
Tested up to: 5.9
Text Domain: clock-tik-tik
 */


define('CLOCK_TIK_PATH', dirname(__FILE__));
$plugin = plugin_basename(__FILE__);
define('CLOCK_TIK_URL', plugin_dir_url($plugin));

require CLOCK_TIK_PATH.'/inc/clock_setting.php';
require CLOCK_TIK_PATH.'/inc/clockFunctions.php';


