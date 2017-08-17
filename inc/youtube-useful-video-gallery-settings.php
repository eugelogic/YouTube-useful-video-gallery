<?php
/**
 * Add Settings.
 *
 * @author Eugene Molari
 * @link https://github.com/eugelogic
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @package YouTube Useful Video Gallery
 */

 /**
  * Initalise the setting API
  */
function ytuvg_settings_api_init() {
	add_settings_section(
		'ytuvg_setting_section',
		'YouTube Useful Video Gallery Settings',
		'ytuvg_setting_section_callback',
		'reading'
	);

	add_settings_field(
		'ytuvg_setting_disable_fullscreen',
		'Disable Fullscreen',
		'ytuvg_setting_disable_fullscreen_callback',
		'reading',
		'ytuvg_setting_section'
	);
	register_setting( 'reading', 'ytuvg_setting_disable_fullscreen' );
}
add_action( 'admin_init', 'ytuvg_settings_api_init' );

/**
 * Setting section callback.
 */
function ytuvg_setting_section_callback() {
	echo '<p>Settings for the YouTube Useful Video Gallery plugin.</p>';
}

/**
 * Disable fullscreen callback.
 */
function ytuvg_setting_disable_fullscreen_callback() {
	echo '<input name="ytuvg_setting_disable_fullscreen" id="ytuvg_setting_disable_fullscreen" type="checkbox" value="1" class="code"' . checked( 1, get_option( 'ytuvg_setting_disable_fullscreen' ), false );
}
