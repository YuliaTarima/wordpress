<?php
/**
*Remove comment author link to prevent spam
*/
add_filter( 'get_comment_author_link', 'rv_remove_comment_author_link', 10, 3 );
function rv_remove_comment_author_link( $return, $author, $comment_ID ) {
    return $author;
}
add_filter('get_comment_author_url', 'rv_remove_comment_author_url');
function rv_remove_comment_author_url() {
    return false;
}
?>