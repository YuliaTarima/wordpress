<?php
//--------function to loop through cats and posts for each category ----//

/*
 *Get top categories and their posts
 *
 */

$args = array(
    'posts_per_page' => -1,
);

$query = new WP_Query($args); //create a custom query with WP_Query to retrieve all published posts
$q = array();

while ($query->have_posts()) {
    $query->the_post();
    $a = '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';//Assign variable to the post title

    $categories = get_the_category();//Using get_the_category, retrieve a list of all categories a post belongs to.
    foreach ($categories as $key => $category) {

        $b = '<a href="' . get_category_link($category) . '">' . $category->name . '</a> ';//Assign variable to the categories of the post
    }

    $q[$b][] = $a; // Create an array with the category names and post titles
}

wp_reset_postdata();//Restore original Post Data

//Using foreach loops, create your post list sorted by category
echo '<ul class="parent">';
foreach ($q as $key => $values) {

    echo '<li class="cat-item" id="cat-item-parent">' . $key . '</li>';

    echo '<ul class="children">';
    foreach ($values as $value) {
        echo '<li class="cat-item">' . $value . '</li>';
    }//close foreach children
    echo '</ul>';
}//close foreach parents
echo '</ul>';
?>