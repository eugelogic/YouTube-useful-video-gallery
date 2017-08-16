<?php

if ( ! function_exists('single_video_tml') ) :
	/**
   *
	 * Use the single video template
	 *
	 */
  function single_video_tml ( $original_template ) {
    if ( 'video' === get_post_type( get_queried_object() ) && is_single() ) {
      return YTUVG_DIR_PATH . '/templates/single-video.php';
    } else {
      return $original_template;
    }
  }
  add_filter( 'template_include', 'single_video_tml' );
endif; // single_video_tml
