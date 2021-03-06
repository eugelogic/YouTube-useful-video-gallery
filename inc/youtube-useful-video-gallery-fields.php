<?php
/**
 * Add Meta Box.
 *
 * @author Eugene Molari
 * @link https://github.com/eugelogic
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @package YouTube Useful Video Gallery
 */

/**
 * Add Meta Box.
 */
function ytuvg_add_fields_metabox() {
	add_meta_box(
		'ytuvg_video_fields',
		__( 'Video Fields' ),
		'ytuvg_video_fields_callback',
		'video',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'ytuvg_add_fields_metabox' );

/**
 * Add Meta Box Content.
 *
 * @param (int|WP_Post|null) $post
 */
function ytuvg_video_fields_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'ytuvg_videos_nonce' );
	$ytuvg_video_stored_meta = get_post_meta( $post->ID );
	?>
		<div class="wrap video-form">
			<div class="form-group">
				<label for="video-id"><?php esc_html_e( 'Video ID', 'ytuvg-domain' ); ?></label>
				<input type="text" name="video_id" id="video-id" value="<?php if ( ! empty( $ytuvg_video_stored_meta['video_id'] ) ) { echo esc_attr( $ytuvg_video_stored_meta['video_id'][0] );} ?>">
			</div>
			<div class="form-group">
				<label for="details"><?php esc_html_e( 'Details', 'ytuvg-domain' ); ?></label>
				<?php
					$content = get_post_meta( $post->ID, 'details', true );
					$editor = 'details';
					$settings = array(
						'textarea_rows' => 15,
					);

					wp_editor( $content, $editor, $settings );
				?>
			</div>
			<?php if ( null !== ( esc_attr( $ytuvg_video_stored_meta['video_id'][0] ) ) ) : ?>
			<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( $ytuvg_video_stored_meta['video_id'][0] ); ?>" frameborder="0" allowfullscreen></iframe>
			<?php endif; ?>

		</div>
	<?php
}

/**
 * Enable Video Save.
 *
 * @param (int|WP_Post|null) $post_id
 */
function ytuvg_video_save( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = (isset( $_POST['ytuvg_videos_nonce'] ) && wp_verify_nonce( wp_unslash( $_POST['ytuvg_videos_nonce'] ), basename( __FILE__ ) )) ? 'true' : 'false';

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( isset( $_POST['video_id'] ) ) {
		update_post_meta( $post_id, 'video_id', sanitize_text_field( wp_unslash( $_POST['video_id'] ) ) );
	}

	if ( isset( $_POST['details'] ) ) {
		update_post_meta( $post_id, 'details', wp_unslash( $_POST['details'] ) );
	}
}
add_action( 'save_post', 'ytuvg_video_save' );
