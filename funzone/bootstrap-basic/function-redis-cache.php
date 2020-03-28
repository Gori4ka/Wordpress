<?php
/**
 *  Redis Cache invalidation
 */
function get_redis()
{
	require_once ABSPATH . 'predis/src/Autoloader.php';
	Predis\Autoloader::register();
	return new Predis\Client();
}
 
// Chances are you'll have a list of categories on every page.
// So delete all site cache if categories are messed with
add_action('add_category', 'redis_invalidate_all');
add_action('delete_category', 'redis_invalidate_all');
add_action('edit_category', 'redis_invalidate_all');

// Delete all site cache for the current domain
function redis_invalidate_all()
{
	$redis = get_redis();
 	$redis->flushdb();
}
 
// When adding/editing/deleting a post, invalidate post and home pages
add_action('trashed_post', 'redis_invalidate_post');
add_action('save_post', 'redis_invalidate_post');
function redis_invalidate_post( $post_id )
{
	// Don't delete cache on auto-save
	if ( isset($_POST['action']) && $_POST['action'] == 'autosave' )
		return;
 
	// Don't delete cache if we're saving as draft or pending
	if ( isset($_POST['save']) && in_array($_POST['save'], array('Save Draft', 'Save as Pending')) )
		return;
 
	$redis = get_redis();
 
	// Invalidate homepage
	$ukey = "http://".$_SERVER['HTTP_HOST'].'/';
	if ( $redis->exists($ukey) )
		$redis->del($ukey);
 
	// Invalidate post page
	$ukey = $permalink = get_permalink( $post_id );
	if ( $redis->exists($ukey) )
		$redis->del($ukey);
}
 
// When adding/editing/deleting a comment, invalidate post and home pages
add_action('comment_closed', 'redis_invalidate_comment');
add_action('comment_post', 'redis_invalidate_comment');
add_action('edit_comment', 'redis_invalidate_comment');
add_action('delete_comment', 'redis_invalidate_comment');
add_action('wp_set_comment_status', 'redis_invalidate_comment');
function redis_invalidate_comment( $comment_id )
{
	$comment = get_comment( $comment_id );
	redis_invalidate_post( $comment->comment_post_ID );
}