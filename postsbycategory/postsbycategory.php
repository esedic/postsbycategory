<?php
/*
Plugin Name: Posts by category
Plugin URI: https://www.yourdomain.com
Description: Show posts by category
Version: 1.0.0
Author: Spletodrom
Author URI: https://www.spletodrom.si
Text Domain: spletodrom
Domain Path: /languages
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function wpb_postsbycategory() {
	// the query
	$the_query = new WP_Query( array( 'category_name' => 'CATEGORY-SLUG-GOES-HERE', 'posts_per_page' => 3 ) );
	// The Loop
	if ( $the_query->have_posts() ) {
		$string .= '<div class="uk-grid-match uk-grid-small uk-light postsbycategory" uk-grid>';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			if ( has_post_thumbnail() ) {
				$string .= '<div class="uk-width-1-1 uk-width-1-3@m">';
				$string .= '<div>';
				$string .= '<div class="uk-height-large uk-background-cover uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url('.get_the_post_thumbnail_url($post_id, 'large').');">';
				$string .= '<div class="uk-overlay uk-overlay-medium uk-position-cover"></div>';
				$string .= '<div class="uk-overlay uk-position-center title uk-text-center">';
				$string .= '<h3 class="uk-text-bold">' . get_the_title().'</h3>';
				$string .= '<span class="uk-text-capitalize">' . get_the_date( 'F j, Y' ) . '</span>';
				$string .= '</div>';
				$string .= '<a href="' . get_the_permalink() .'" class="uk-position-cover"></a>';
				$string .= '</div>';
				$string .= '</div>';
				$string .= '</div>';
			} else { 
				// if no featured image is found
				$string .= '<div class="uk-width-1-1 uk-width-1-3@m"><a href="' . get_the_permalink() .'">' . get_the_title() .'</a></div>';
			}
		}
	} else {
	// no posts found
	}
	$string .= '</div>';

	return $string;
	 
	/* Restore original Post Data */
	wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts', 'wpb_postsbycategory');
 
// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');
