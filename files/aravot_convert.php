<?php

define('WP_USE_THEMES', false);
include('./wp-blog-header.php');
global $wpdb;
$olddb = new wpdb('user_name', 'pass', 'db_name', 'localhost');

//$old_posts = $olddb->get_results('SELECT * from wp_3_posts order by ID DESC limit 42000, 2000');
//
//foreach ($old_posts as $old_post) {
//    $new_post = array(
//        'ID' => $old_post->ID,
//        'post_author' => $old_post->post_author,
//        'post_date' => $old_post->post_date,
//        'post_date_gmt' => $old_post->post_date_gmt,
//        'post_content' => $old_post->post_content,
//        'post_title' => $old_post->post_title,
//        'post_excerpt' => $old_post->post_excerpt,
//        'post_status' => $old_post->post_status,
//        'comment_status' => $old_post->comment_status,
//        'ping_status' => $old_post->ping_status,
//        'post_password' => $old_post->post_password,
//        'post_name' => $old_post->post_name,
//        'to_ping' => $old_post->to_ping,
//        'pinged' => $old_post->pinged,
//        'post_modified' => $old_post->post_modified,
//        'post_modified_gmt' => $old_post->post_modified_gmt,
//        'post_content_filtered' => $old_post->post_content_filtered,
//        'post_parent' => $old_post->post_parent,
//        'guid' => str_replace("en.aravot.am","www.aravot-en.am",$old_post->guid),
//        'menu_order' => $old_post->menu_order,
//        'post_type' => $old_post->post_type,
//        'post_mime_type' => $old_post->post_mime_type,
//        'comment_count' => $old_post->comment_count,
//    );
//
//    echo "<pre>";
//    var_dump('++++++', $old_post->ID);
//    echo "</pre>";
//
//$wpdb->insert($wpdb->prefix . 'posts', $new_post);
//}

//$old_posts = $olddb->get_results('SELECT * from wp_3_commentmeta order by meta_id DESC');
//
//foreach ($old_posts as $old_post) {
//    $new_post = array(
//        'meta_id' => $old_post->meta_id,
//        'comment_id' => $old_post->comment_id,
//        'meta_key' => $old_post->meta_key,
//        'meta_value' => $old_post->meta_value
//    );
//
//    echo "<pre>";
//    var_dump('++++++', $old_post->meta_id);
//    echo "</pre>";
//
//$wpdb->insert($wpdb->prefix . 'commentmeta', $new_post);
//}

//$old_posts = $olddb->get_results('SELECT * from wp_3_comments order by comment_ID DESC');
//
//
//foreach ($old_posts as $old_post) {
//    $new_post = array(
//        'comment_ID' => $old_post->comment_ID,
//        'comment_post_ID' => $old_post->comment_post_ID,
//        'comment_author' => $old_post->comment_author,
//        'comment_author_email' => $old_post->comment_author_email,
//        'comment_author_url' => $old_post->comment_author_url,
//        'comment_author_IP' => $old_post->comment_author_IP,
//        'comment_date' => $old_post->comment_date,
//        'comment_date_gmt' => $old_post->comment_date_gmt,
//        'comment_content' => $old_post->comment_content,
//        'comment_karma' => $old_post->comment_karma,
//        'comment_approved' => $old_post->comment_approved,
//        'comment_agent' => $old_post->comment_agent,
//        'comment_type' => $old_post->comment_type,
//        'comment_parent' => $old_post->comment_parent,
//        'user_id' => $old_post->user_id,
//    );
//
//    echo "<pre>";
//    var_dump('++++++', $old_post->comment_ID);
//    echo "</pre>";
//
//$wpdb->insert($wpdb->prefix . 'comments', $new_post);
//}
// chem ere 
//$old_posts = $olddb->get_results('SELECT * from wp_3_options order by option_id DESC LIMIT 1');
//
//foreach ($old_posts as $old_post) {
//    $new_post = array(
//        'option_id' => $old_post->option_id,
//        'option_name' => $old_post->option_name,
//        'option_value' => $old_post->option_value,
//        'autoload' => $old_post->autoload,
//    );
//
//    echo "<pre>";
//    var_dump('++++++', $old_post->option_id);
//    echo "</pre>";
//
//$wpdb->insert($wpdb->prefix . 'options', $new_post);
//}

//$old_posts = $olddb->get_results('SELECT * from wp_3_postmeta order by meta_id DESC LIMIT 300000, 20000');
//
//   foreach ($old_posts as $old_post) {
//       $new_post = array(
//           'meta_id' => $old_post->meta_id,
//           'post_id' => $old_post->post_id,
//           'meta_key' => $old_post->meta_key,
//           'meta_value' => $old_post->meta_value,
//       );
//
//       echo "<pre>";
//       var_dump('++++++', $old_post->meta_id);
//       echo "</pre>";
//
//   $wpdb->insert($wpdb->prefix . 'postmeta', $new_post);
//   }

//$old_posts = $olddb->get_results('SELECT * from wp_3_terms order by term_id DESC LIMIT 20000, 20000');
//
//   foreach ($old_posts as $old_post) {
//       $new_post = array(
//           'term_id' => $old_post->term_id,
//           'name' => $old_post->name,
//           'slug' => $old_post->slug,
//           'term_group' => $old_post->term_group,
//       );
//
//       echo "<pre>";
//       var_dump('++++++', $old_post->term_id);
//       echo "</pre>";
//
//   $wpdb->insert($wpdb->prefix . 'terms', $new_post);
//   }
   
//$old_posts = $olddb->get_results('SELECT * from wp_3_term_relationships order by object_id DESC LIMIT 200000, 40000');
//
//   foreach ($old_posts as $old_post) {
//       $new_post = array(
//           'object_id' => $old_post->object_id,
//           'term_taxonomy_id' => $old_post->term_taxonomy_id,
//           'term_order' => $old_post->term_order,
//       );
//
//       echo "<pre>";
//       var_dump('++++++', $old_post->object_id);
//       echo "</pre>";
//
//   $wpdb->insert($wpdb->prefix . 'term_relationships', $new_post);
//   }

//$old_posts = $olddb->get_results('SELECT * from wp_3_term_taxonomy order by term_taxonomy_id DESC LIMIT 30000, 30000');
//
//   foreach ($old_posts as $old_post) {
//       $new_post = array(
//           'term_taxonomy_id' => $old_post->term_taxonomy_id,
//           'term_id' => $old_post->term_id,
//           'taxonomy' => $old_post->taxonomy,
//           'description' => $old_post->description,
//           'parent' => $old_post->parent,
//           'count' => $old_post->count,
//       );
//
//       echo "<pre>";
//       var_dump('++++++', $old_post->term_taxonomy_id);
//       echo "</pre>";
//
//   $wpdb->insert($wpdb->prefix . 'term_taxonomy', $new_post);
//   }

//$old_posts = $olddb->get_results('SELECT * from wp_3_popularpostsdata order by postid DESC LIMIT 60000, 30000');
//
//   foreach ($old_posts as $old_post) {
//       $new_post = array(
//           'postid' => $old_post->postid,
//           'day' => $old_post->day,
//           'last_viewed' => $old_post->last_viewed,
//           'pageviews' => $old_post->pageviews,
//       );
//
//       echo "<pre>";
//       var_dump('++++++', $old_post->postid);
//       echo "</pre>";
//
//   $wpdb->insert($wpdb->prefix . 'popularpostsdata', $new_post);
//   }


//$old_images = $olddb->get_results('SELECT meta_value from wp_3_postmeta WHERE meta_key="_wp_attachment_metadata" order by post_id DESC LIMIT 57000, 1000');
//
//foreach ($old_images as $old_image) {
//
//    $data = unserialize($old_image->meta_value);
//
//    preg_match('/\d{4}\/\d{2}/', $data['file'], $matches);
//    preg_match('/\d{4}/', $matches[0], $year);
//    preg_match('/\/\d{2}/', $matches[0], $month);
//
//    $natural_image = $data['file'];
//    $natural_imgUrl = "http://en.aravot.am/wp-content/uploads/" . $natural_image;
//    if (!is_dir('./wp-content/uploads/' . $year[0])) {
//        if (mkdir('./wp-content/uploads/' . $year[0])) {
//            echo '<br>';
//                var_dump('create dir ./wp-content/uploads/' . $year[0]);
//            if (mkdir('./wp-content/uploads/' . $year[0] . $month[0])) {
//                echo '<br>';
//                var_dump('create dir ./wp-content/uploads/' . $year[0] . $month[0]);
//            }
//        }
//    } else {
//        if (mkdir('./wp-content/uploads/' . $year[0] . $month[0])) {
//            var_dump('create dir ./wp-content/uploads/' . $year[0] . $month[0]);
//        }
//    }
//    $natural_path = "wp-content/uploads/" . $natural_image;
//    if (file_get_contents($natural_imgUrl)) {
//        file_put_contents($natural_path, file_get_contents($natural_imgUrl));
//    }
//    $filename = "http://en.aravot.am/wp-content/uploads/" . $matches[0];
//    foreach ($data["sizes"] as $item_img) {
//        $imgUrl = $filename . '/' . $item_img["file"];
//        $path = "wp-content/uploads/" . $matches[0] . "/" . $item_img["file"];
//        if (file_get_contents($imgUrl)) {
//            file_put_contents($path, file_get_contents($imgUrl));
//            echo '<br>';
//            var_dump('image save', $matches[0]);
//        }
//    }
//}

//$old_posts = $wpdb->get_results('SELECT ID,guid from wp_posts order by ID DESC limit 45000, 5000');
//
//foreach ($old_posts as $old_post) {
//        $post_id = $old_post->ID;
//        $guid = str_replace("en.aravot.am","www.aravot-en.am",$old_post->guid);
//
//    echo "<pre>";
//    var_dump('++++++', $old_post->ID);
//    echo "</pre>";
//
//$wpdb->query($wpdb->prepare('UPDATE wp_posts SET guid = %s WHERE ID = %d', $guid, $post_id));
//}
