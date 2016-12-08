<?php
/**
 * CONF Plugin Name.
 *
 * @package   ANCMS
 * @author    Helen England <haitch.england@gmail.com>
 * @copyright 2016 Helen England
 * @license   GPL-2.0+
 * @link      CONF_Author_Link
 *
 * @wordpress-plugin
 * Plugin Name: AutoNerd Basic.
 * Plugin URI: http://www.screechinghalt.com
 * Description: Autonerd Base setup configuration, including custome post types, custom taxonomies and global ACF settings
 * Version: 1.0.0
 * Author: Helen England
 * Author URI: http://www.screechinghalt.com
 * License: GPL-2.0+
 * License URI: http://www.gun.org/Licenses/gpl-2.0.txt
 * Copyright: 2016 Helen England
 */

if ( ! defined( 'WPINC' ) ) { die; }

include_once( 'class-autonerd-basic.php' );

// new AutoNerd(); // not singleton uses the constructor.
// AutoNerd::get_instance(); //.
add_action( 'plugins_loaded', array( 'AutoNerd', 'get_instance' ) );



/*
Patterns

Singleton

Factory


 */








