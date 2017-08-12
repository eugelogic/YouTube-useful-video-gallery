<?php
/**
 * Plugin Name: YouTube Useful Video Gallery
 * Plugin URI: https://github.com/eugelogic/YouTube-useful-video-gallery
 * Description: A WordPress custom post type plugin to collect and display useful YouTube videos.
 * Author: Eugene Molari
 * Author URI:  https://github.com/eugelogic
 * Version: 0.1.20170812
 * Text Domain: ytuvg-domain
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

/*
The "YouTube Useful Video Gallery" plugin is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the Free Software Foundation,
version 3 of the License, or any later version.
The "YouTube Useful Video Gallery" plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with the "YouTube Useful Video Gallery" plugin.
If not, see https://www.gnu.org/licenses/gpl-3.0.html.
*/

/* exit if directly accessed */
if( ! defined( 'ABSPATH' ) ) exit;

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/inc/youtube-useful-video-gallery-scripts.php');

// Load Custom Post Type
require_once(plugin_dir_path(__FILE__) . '/inc/youtube-useful-video-gallery-cpt.php');

// Check if admin and include admin Scripts
if (is_admin()){
  // Load Post Fields
  require_once(plugin_dir_path(__FILE__) . '/inc/youtube-useful-video-gallery-fields.php');
}
