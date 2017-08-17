<?php
/**
 * Add Scripts.
 *
 * @author Eugene Molari
 * @link https://github.com/eugelogic
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @package YouTube Useful Video Gallery
 */

// Check if admin and add admin scripts.
if ( is_admin() ) {
	/**
	 * Add Admin Scripts.
	 */
	function ytuvg_add_admin_scripts() {
			wp_enqueue_style( 'ytuvg-main-admin-style', plugins_url() . '/youtube-useful-video-gallery/css/style-admin.css' );
	}
	add_action( 'admin_init','ytuvg_add_admin_scripts' );
}

/**
 * Add Scripts.
 */
function ytuvg_add_scripts() {
	wp_enqueue_style( 'ytuvg-main-style', plugins_url() . '/youtube-useful-video-gallery/css/style.css' );
}
add_action( 'wp_enqueue_scripts','ytuvg_add_scripts' );
