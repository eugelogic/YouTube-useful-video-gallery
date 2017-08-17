<?php
/**
 * Add Shortcodes.
 *
 * @author Eugene Molari
 * @link https://github.com/eugelogic
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @package YouTube Useful Video Gallery
 */

/**
 * List videos.
 *
 * @param array $atts
 * @param ???   $content
 */
function ytuvg_list_videos( $atts, $content = null ) {
	global $post;

	// Set default attributes.
	$atts = shortcode_atts(array(
		'title'     => 'Useful YouTube Video Gallery',
		'count'     => 10,
		'category'  => 'all',
	), $atts);

	// Check if someone has added a category with the shortcode.
	if ( 'all' === $atts['category'] ) {
		$terms = '';
	} else {
		$terms = array(
			array(
				'taxonomy'  => 'category',
				'field'     => 'slug',
				'terms'     => $atts['category'],
		),
		);
	}

	// Query args.
	$args = array(
		'post_type'     => 'video',
		'post_status'   => 'publish',
		'orderby'       => 'created',
		'order'         => 'DESC',
		'posts_per_page' => $atts['count'],
		'tax_query'			=> $terms,
	);

	// Fetch videos.
	$videos = new WP_Query( $args );

	// Check for videos.
	if ( $videos->have_posts() ) {
		$category = str_replace( '-', ' ', $atts['category'] );

		// Init output.
		$output = '';

		// Build output.
		$output .= '<div class="video-list">';

		while ( $videos->have_posts() ) {
			$videos->the_post();

			// Get field values.
			$video_id = get_post_meta( $post->ID, 'video_id', true );
			$details = get_post_meta( $post->ID, 'details', true );

			$output .= '<div class="ytuvg-video">';
			$output .= '<h4>' . get_the_title() . '</h4>';
			if ( get_option( 'ytuvg_setting_disable_fullscreen' ) ) {
				 $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0"></iframe>';
			} else {
				 $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
			}
			$output .= '<div>' . wpautop( $details ) . '</div>';
			$output .= '</div><br></hr>';
		}

		$output .= '</div>';

		// Reset post data.
		wp_reset_postdata();

		return $output;
	} else {
		return '<p>No Videos Found</p>';
	}// End if().
}
// Video list shortcode with actual text [videos].
add_shortcode( 'videos', 'ytuvg_list_videos' );

unset( $atts );
unset( $content );
unset( $post );
unset( $terms );
unset( $args );
unset( $videos );
unset( $video_id );
unset( $category );
unset( $output );

/**
 * CSS grid video gallery.
 *
 * @param array $atts
 * @param ???   $content
 */
function ytuvg_video_grid( $atts, $content = null ) {
	global $post;

	// Set default attributes.
	$atts = shortcode_atts(array(
		'title'     => 'Useful YouTube Video Grid',
		'count'     => 14,
		'category'  => 'all',
	), $atts);

	// Check if someone has added a category with the shortcode.
	if ( 'all' === $atts['category'] ) {
		$terms = '';
	} else {
		$terms = array(
			array(
				'taxonomy'  => 'category',
				'field'     => 'slug',
				'terms'     => $atts['category'],
		),
		);
	}

	// Query args.
	$args = array(
		'post_type'     => 'video',
		'post_status'   => 'publish',
		'orderby'       => 'created',
		'order'         => 'DESC',
		'posts_per_page' => $atts['count'],
		'tax_query'			=> $terms,
	);

	// Fetch videos.
	$videos = new WP_Query( $args );

	// Check for videos.
	if ( $videos->have_posts() ) {
		$category = str_replace( '-', ' ', $atts['category'] );

		// Init output.
		$output = '';

		// Build output.
		$output .= '<div class="ytuvg-video-gallery-wrapper">';

		while ( $videos->have_posts() ) {
			$videos->the_post();

			// Get field values.
			$video_id = get_post_meta( $post->ID, 'video_id', true );

			$output .= '<div class="ytuvg-video-grid-entry">';
			if ( get_option( 'ytuvg_setting_disable_fullscreen' ) ) {
				 $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0"></iframe>';
			} else {
				 $output .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe>';
			}
			$output .= '</div><!-- ytuvg-video-grid-entry -->';
			// $output .= '<h6>' . get_the_title() . '</h6>';
		}

		$output .= '</div><!-- ytuvg-video-gallery-wrapper -->';

		// Reset post data.
		wp_reset_postdata();

		return $output;
	} else {
		return '<p>No Videos Found</p>';
	}
}
// Video grid shortcode with title only.
add_shortcode( 'video-grid', 'ytuvg_video_grid' );
