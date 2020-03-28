<?php

// define('WP_USE_THEMES', false);
// require('./wp-blog-header.php');
// include( ABSPATH . 'wp-admin/includes/image.php' );
// global $wpdb;



// switch_to_blog(3);

// 							global $old_wpdb;
// 							$old_wpdb = new wpdb('user_name', 'pass', 'db_name', 'localhost');

// 							$old_posts = $old_wpdb->get_results( "SELECT * FROM  article_en ORDER BY id ASC LIMIT 8000, 2000");

// 							if(!$old_posts){
// 								return ;
// 							}



// 							foreach ($old_posts as $old_post) {



// 							// 	if(strlen($old_post->body) > 10){

// 							// 		$post_id = $old_post->id;

// 							// 		$new_post = array(
// 							// 			'ID' => $post_id,
// 							// 			//'post_author' => $old_post->author ? $old_post->author : "",
// 							// 			'post_date' => $old_post->created,
// 							// 			'post_date_gmt' => $old_post->created,
// 							// 			'post_content' => $old_post->body ? $old_post->body : "",
// 							// 			'post_title' => $old_post->title ? $old_post->title : "",
// 							// 			'post_status' => $old_post->publish == 1 ? "publish" : "draft",
// 							// 			'post_name' => $old_post->title ? $old_post->title : "",
// 							// 			'guid' => 'http://archiv.168.vs.am/ru/?p='.$post_id,
// 							// 			'post_type' => 'post'
// 							// 			);


// 	// $json = file_get_contents('http://168.vs.am/am/economy');
// 	// $obj = json_decode($json);


// 	// foreach ($obj as $old_post) {
// 	// 	echo "<pre>";
// 	// 	var_dump($old_post->id);
// 	// 	echo "</pre>";

// 		if(strlen($old_post->body) > 10){

// 			// $new_post = array(
// 			// 	'ID' => $old_post->id,
// 			// 	'post_date' => $old_post->created,
// 			// 	'post_date_gmt' => $old_post->created,
// 			// 	'post_content' => $old_post->body ? $old_post->body : "",
// 			// 	'post_title' => $old_post->title ? $old_post->title : "",
// 			// 	'post_status' => $old_post->publish == 1 ? "publish" : "draft",
// 			// 	'post_name' => $old_post->title ? $old_post->title : "",
// 			// 	'guid' => 'http://archiv.168.vs.am/en/?p='.$old_post->id,
// 			// 	'post_type' => 'post'
// 			// 	);

// 			// echo "<pre>";
// 			// var_dump('++++++', $old_post->id);
// 			// echo "</pre>";

// 			// $wpdb->insert($wpdb->prefix . 'posts', $new_post);

// 			// //$term_taxonomy_id = $wpdb->get_var($wpdb->prepare('SELECT term_taxonomy_id FROM ' . $wpdb->prefix . 'term_taxonomy WHERE term_id =  '.$old_post->section_id));
			
// 			// $new_term_rel = array(
// 			// 	'object_id' => $old_post->id,
// 			// 	'term_taxonomy_id' => $old_post->section_id,
// 			// 	);

// 			// $wpdb->insert($wpdb->prefix . 'term_relationships', $new_term_rel);




// 			$media_url = "";

// 			if($old_post->image){

// 				$media_url = 'http://168.vs.am/images/'.$old_post->image;

// 				preg_match('/\d{4}\/\d{2}/', $old_post->image, $matches);

// 				$date = '2016/01';

// 				if($matches[0]){
// 					$date = $matches[0];
// 				}


// 				$attach_id = generate_wp_media_and_return_media_id_by_cases_id($media_url, $old_post->id, $date);
// 				if($attach_id){

// 					var_dump('+++++++++', $old_post->id);
// 					echo "<br>";
				
// 					$new_postmeta = array(
// 						'post_id' => $old_post->id,
// 						'meta_key' => '_thumbnail_id',
// 						'meta_value' => $attach_id
// 						);

// 					$wpdb->insert($wpdb->prefix . 'postmeta', $new_postmeta);
// 				}
// 			}



// 		}

// 	}

// function generate_wp_media_and_return_media_id_by_cases_id($media_url, $new_id, $date) {
//     global $wpdb;

//     if (!$media_url) {
//         return null;
//     }

// // Add Featured Image to Post
//     $upload_dir = array(
//         "path" => "/var/www/168/data/www/archiv.168.vs.am/wp-content/uploads/sites/3/".$date,
//         "url" => "http://archiv.168.vs.am/wp-content/uploads/sites/3/".$date,
//         "subdir" => $date,
//         "basedir" => "/var/www/168/data/www/archiv.168.vs.am/wp-content/uploads/sites/3",
//         "baseurl" => "http://archiv.168.vs.am/wp-content/uploads/sites/3",
//         "error" => false
//     );

//     $image_data = file_get_contents($media_url); // Get image data

//     $filename = basename($media_url); // Create image file name

//     if (wp_mkdir_p($upload_dir['path'])) {
//         $file = $upload_dir['path'] . '/' . $filename;
//     } else {
//         $file = $upload_dir['basedir'] . '/' . $filename;
//     }

// // Create the image  file on the server
//     file_put_contents($file, $image_data);

// // Check image file type
//     $wp_filetype = wp_check_filetype($filename, null);

// // Set attachment data
//     $attachment = array(
//         'post_mime_type' => $wp_filetype['type'],
//         'post_title' => sanitize_file_name($filename),
//         'post_content' => '',
//         'post_status' => 'inherit'
//     );

// // Create the attachment
//     $attach_id = wp_insert_attachment($attachment, $file, $new_id);

// // Include image.php
//     require_once(ABSPATH . 'wp-admin/includes/image.php');

// // Define attachment metadata
//     $attach_data = wp_generate_attachment_metadata($attach_id, $file);

// // Assign metadata to attachment
//     wp_update_attachment_metadata($attach_id, $attach_data);

// // And finally assign featured image to post
//     if ($attach_id) {
//         return $attach_id;
//     } else {
//         return 0;
//     }
// }



// // /*  category   */

// // $old_category = $old_wpdb->get_results( "SELECT * FROM sections" );

// // if(!$old_category){
// //  echo "no result";
// // }


// // foreach ($old_category as $old_cat) {
// //     $new_terms = array(
// //         'term_id' => $old_cat->id,
// //         'name' => $old_cat->section_name_ru,
// //         'slug' => $old_cat->section_dir,
// //         'term_group' => 0
// //         );

// //     $new_terms_tax = array(
// //         'term_id' => $old_cat->id,
// //         'taxonomy' => 'category'
// //         );
// //     $wpdb->insert($wpdb->prefix . 'terms', $new_terms);
// //     $wpdb->insert($wpdb->prefix . 'term_taxonomy', $new_terms_tax);

// // }

