<?php
/*
*show posts only related to the current category
*
*/

//Default arguments
$args = array(
    'posts_per_page' => -1, // How many items to display = all
    'depth'          => -1, //Number of levels in the hierarchy of pages to include in the generated list = any
 	'post__not_in'   => array( get_the_ID() ), // Exclude current post
	'no_found_rows'  => true, // We don't need pagination so this speeds up the query
);

// Check for current post category and add tax_query to the query arguments
$cats = wp_get_post_terms( get_the_ID(), 'category' );
$cats_ids = array();
foreach( $cats as $wpex_related_cat ) {
	$cats_ids[] = $wpex_related_cat->term_id;
}
if ( ! empty( $cats_ids ) ) {
	$args['category__in'] = $cats_ids;
}

// Query posts
$wpex_query = new wp_query( $args );
echo '<div id="recent-posts-2" class="widget widget_recent_entries"><h3 class="widget-title">Статьи</h3><ul>';
// Loop through posts
foreach( $wpex_query->posts as $post ) : setup_postdata( $post ); ?>

	<li>&#9728; <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?> >>></a></li>

<?php
// End loop
endforeach;
echo '</ul class="rightSidebar-categoryPosts"></div>';
// Reset post data
wp_reset_postdata();

?>