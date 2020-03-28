<?php

// Creating a Task Custom Post Type
function register_task_custom_post_type() {
	$labels = array(
		'name'                => __( 'Tasks' ),
		'singular_name'       => __( 'Task'),
		'menu_name'           => __( 'Tasks'),
		'parent_item_colon'   => __( 'Parent Task'),
		'all_items'           => __( 'All Tasks'),
		'view_item'           => __( 'View Task'),
		'add_new_item'        => __( 'Add New Task'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Task'),
		'update_item'         => __( 'Update Task'),
		'search_items'        => __( 'Search Task'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash')
	);
	$args = array(
		'label'               => __( 'task'),
		'description'         => __( 'Test Task'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
		'public'              => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-sticky',
		'hierarchical'        => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'has_archive'         => true,
		'can_export'          => true,
		'exclude_from_search' => false,
	    'yarpp_support'       => true,
		'taxonomies' 	      => array('post_tag'),
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
);
	register_post_type( 'task', $args );
}
add_action( 'init', 'register_task_custom_post_type', 0 );

// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'register_task_custom_taxonomy', 0 );
 
//create a custom taxonomy name it "task" for your posts
function register_task_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Tasks', 'taxonomy general name' ),
    'singular_name' => _x( 'Task', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Task' ),
    'all_items' => __( 'All Tasks' ),
    'parent_item' => __( 'Parent Task' ),
    'parent_item_colon' => __( 'Parent Task:' ),
    'edit_item' => __( 'Edit Task' ), 
    'update_item' => __( 'Update Task' ),
    'add_new_item' => __( 'Add New Task' ),
    'new_item_name' => __( 'New Task Name' ),
    'menu_name' => __( 'Tasks' ),
  ); 	
 
  register_taxonomy('tasks',array('task'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'category-task', 'with_front' => false ),
  ));
}

add_action('init', 'custom_taxonomy_flush_rewrite');
function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

?>