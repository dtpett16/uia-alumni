<?php
/**
 *
 * Plugin Name:       Tockify Events Calendar
 * Plugin URI:        https://tockify.com/i/docs/install/wordpress
 * Description:       The official Tockify Calendar plugin for Wordpress. It adds a shortcode and sidebar widget that makes it easy to add a Tockify calendar to your site.
 * Version:           1.3.6
 * Author:            Tockify Ltd
 * Author URI:        https://tockify.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require(dirname(__FILE__).'/scripts.php');
require(dirname(__FILE__).'/settings.php');
require(dirname(__FILE__).'/shortcode.php');
require(dirname(__FILE__).'/widget.php');

?>
