<?php
/**
 * Create Custom Post Type.
 *
 * @author Eugene Molari
 * @link https://github.com/eugelogic
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 */
function ytuvg_register_video() {

	$labels = array(
		'name'                  => _x( 'Videos', 'Post type general name', 'ytuvg-domain' ),
		'singular_name'         => _x( 'Video', 'Post type singular name', 'ytuvg-domain' ),
		'menu_name'             => _x( 'Videos', 'Admin Menu text', 'ytuvg-domain' ),
		'name_admin_bar'        => _x( 'Video', 'Add New on Toolbar', 'ytuvg-domain' ),
		'add_new'               => __( 'Add New', 'ytuvg-domain' ),
		'add_new_item'          => __( 'Add New Video', 'ytuvg-domain' ),
		'new_item'              => __( 'New Video', 'ytuvg-domain' ),
		'edit_item'             => __( 'Edit Video', 'ytuvg-domain' ),
		'view_item'             => __( 'View Video', 'ytuvg-domain' ),
		'all_items'             => __( 'All Videos', 'ytuvg-domain' ),
		'search_items'          => __( 'Search Videos', 'ytuvg-domain' ),
		'parent_item_colon'     => __( 'Parent Videos:', 'ytuvg-domain' ),
		'not_found'             => __( 'No videos found.', 'ytuvg-domain' ),
		'not_found_in_trash'    => __( 'No videos found in Trash.', 'ytuvg-domain' ),
		'archives'              => _x( 'Video archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'ytuvg-domain' ),
		'filter_items_list'     => _x( 'Filter videos list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'ytuvg-domain' ),
		'items_list_navigation' => _x( 'Videos list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'ytuvg-domain' ),
		'items_list'            => _x( 'Videos list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'ytuvg-domain' ),
	);

	$args = array(
	  'labels'             => $labels,
	  'description'        => __( 'Useful tech videos from YouTube.', 'ytuvg-domain' ),
	  'taxonomies'         => array( 'category', 'language', 'tool' ),
	  'public'             => true,
	  'publicly_queryable' => true,
	  'show_ui'            => true,
	  'show_in_menu'       => true,
	  'query_var'          => true,
	  'rewrite'            => array(
		  'slug' => 'video',
	  ),
	  'capability_type'    => 'post',
	  'has_archive'        => true,
	  'hierarchical'       => false,
	  'menu_position'      => null,
	  'menu_icon'          => 'dashicons-format-video',
	  'can_export'         => true,
	  'supports'           => array( 'title', 'custom-fields' ),
	);

	// Register Post Type.
	register_post_type( 'video', $args );
}
add_action( 'init', 'ytuvg_register_video' );

register_activation_hook(__FILE__, function () {
	ytuvg_register_video();
	flush_rewrite_rules();
});

register_deactivation_hook(__FILE__, function () {
	  flush_rewrite_rules();
});

if ( ! function_exists( 'add_custom_fields_to_video' ) ) :
	/**
	 * Add custom fields to the Video CPT output
	 *
	 * @param string $details
	 * @return string
	 */
	function add_custom_fields_to_video( $details ) {
		if ( 'video' !== get_post_type() ) {
					return $details;
		}

				$video_id = get_post_meta( get_the_ID(), 'video_id', true );
		$details = get_post_meta( get_the_ID(), 'details', true );

		if ( get_option( 'ytuvg_setting_disable_fullscreen' ) ) {
			 $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr( $video_id ) . '" frameborder="0"></iframe>';
		} else {
			$video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . esc_attr( $video_id ) . '" frameborder="0" allowfullscreen></iframe>';
		}
			return $video . wpautop( $details );
	}

	add_filter( 'the_content', 'add_custom_fields_to_video' );

endif; // add_custom_fields_to_video.
