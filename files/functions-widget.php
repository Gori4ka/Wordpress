<?php
/* ----------------------------------------------------------------------------------- */
// This starts the Taxonomy Block.
/* ----------------------------------------------------------------------------------- */

add_action('widgets_init', 'taxonomy_block_widgets');

function taxonomy_block_widgets() {
    register_widget('Taxonomy_Widget');
}

class Taxonomy_Widget extends WP_Widget {

    function Taxonomy_Widget() {
        $widget_ops = array('classname' => 'taxonomy_block', 'description' => __('Taxonomy_block', "listify"));
        $this->WP_Widget('taxonomy_widget', __('Taxonomy Widget', "listify"), $widget_ops, '');
    }

    function widget($args, $instance) {
        extract($args);
        $orderby = $instance['orderby'];
        $taxonomy = $instance['taxonomy'];
        if($taxonomy == 'job_listing_region'){
            $title = 'Location';
        }elseif($taxonomy == 'job_listing_category') {
            $title = 'Category';
        }
        if(!$_GET['search_keywords'] && !$_GET['search_region'] && !$_GET['search_categories']){
        ?>
        <aside class="home-widget">
	        <div class="new-search-container col-xs-12 new_<?php echo $instance['taxonomy']; ?>">
	            <?php 
	            	get_search_list($taxonomy, $orderby, $title); 
	            ?>

	            <div id="add_new_search_block" class="add-new-search-block">
	            <?php
	                $region_id = ''; 
	                if($_GET['location_id']){
	            		$location = get_term_by('slug', $_GET['location_id'], $taxonomy); 
						$region_id = $location->term_id;
	                    get_category_list_by_region($region_id);
	                }
	            ?>   
	            </div>

	            <?php
		            if($_GET['location_id'] && $_GET['category_id']){
		            	$category = get_term_by('slug', $_GET['category_id'], 'job_listing_category'); 
						$category_id = $category->term_id;
		            	echo '<div id="your_category" data-category-id="'.$category_id.'"></div>';
		            }
	            ?>
	        </div>
	    </aside>  
        <?php
    	}
    }

    function form($instance) {
        $defaults = array(
            'title' => __('Taxonomy', "listify"));
        $instance = wp_parse_args((array) $instance, $defaults);

        $order = array('id'=>'Id', 'name'=>'Name', 'count'=>'Posts count');
        $taxonomy = array('job_listing_category'=>'Category', 'job_listing_region'=>'Region');
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', "listify"); ?></label>
            <select name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
                <?php foreach ($order as $key => $value) { 
                        $selected = '';
                        if($instance['orderby'] == $key){
                            $selected = 'selected';
                        }
                    ?>
                    <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>
        </p>
        <p><label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Taxonomy ID:', "listify"); ?></label>
            <select name="<?php echo $this->get_field_name('taxonomy'); ?>" style="width:100%;">
                <?php foreach ($taxonomy as $key => $value) { 
                    $selected = '';
                    if($instance['taxonomy'] == $key){
                        $selected = 'selected';
                    }
                ?>
                    <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php } ?>    
            </select>
        </p>
        <?php
    }

}

function get_search_list($taxonomy, $orderby, $title) {

	$location = get_term_by('slug', $_GET['location_id'], $taxonomy); 
  	$location_id = $location->term_id;

    if(!$_GET['location_id']) {

        $args = array(
          'taxonomy'  => $taxonomy,
          'orderby'   => $orderby,
          'hide_empty'=> 1
        );

        $lists = get_terms( $args );
        ?>
        <h3 class="new-search-title">Choose Your <?php echo $title; ?></h3>
        <div class="row new-search-block">
        <?php
        foreach ($lists as $key => $list) {
          ?>            
          <div class="new-item-list col-xs-6 col-sm-4">
            <a id="item-list-id-<?php echo $list->term_taxonomy_id ?>" class="item_list"  data-list-id="<?php echo $list->term_taxonomy_id ?>" href="/location/<?php echo $list->slug ?>/"><?php echo $list->name ?></a>
          </div>
        <?php
        }
        ?>
        </div>
        <?php

    }elseif($_GET['location_id']){
        $location = get_term_by('slug', $_GET['location_id'], $taxonomy); 
        $location_slug = $location->slug;
    ?>
    
    <div class="row new-search-block">
        <div id="your_location" class="new-item-list exsist-location col-xs-6 col-sm-4">
            <h3 class="new-search-title">Your Location: 
                <a id="item-list-id-<?php echo $location_id; ?>" class="item_list"  data-list-id="<?php echo $location_id ?>" href="/location/<?php echo $location_slug; ?>/"><?php echo get_the_category_by_ID($location_id); ?>
                </a>
                <?php if($_GET['category_id']){
                    $cat = get_term_by('slug', $_GET['category_id'], 'job_listing_category'); 
                    $cat_name = $cat->name;
                    $cat_slug = $cat->slug;
                ?>
                <a id="item-list-id-<?php echo $location_id; ?>" class="item_list"  data-list-id="<?php echo $location_id ?>" href="/location/<?php echo $location_slug; ?>/<?php $cat_slug; ?>"><?php echo $cat_name; ?>
                </a>
                <?php } ?>
            </h3>
        </div>
    </div>
    <?php            
    }
}

function get_terms_id($region_id) {
    global $wpdb;

        $terms_id = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT tt.term_taxonomy_id FROM wp_term_relationships tr
        LEFT JOIN wp_term_relationships tr1
        ON tr1.object_id = tr.object_id
        LEFT JOIN wp_term_taxonomy tt
        ON tt.term_taxonomy_id = tr1.term_taxonomy_id
        where tr.term_taxonomy_id='.$region_id.' AND tt.taxonomy = "job_listing_category"'));
    
    return $terms_id;
}

function get_category_list_by_region($region_id) {

    $include_terms = array();
    if($region_id){
        $terms_id = get_terms_id($region_id);    
        foreach ($terms_id as $term_id) {
            array_push($include_terms, $term_id->term_taxonomy_id);
        }
    }

    $args = array(
        'taxonomy'  => 'job_listing_category',
        'include'    => $include_terms,
        'orderby'   => 'name'
    );

    $categorys = get_terms( $args );
    if($categorys){
        $location_slug = '';
        $curr_user_id = get_current_user_id();
        $cookie_name = 'curr_user_'.$curr_user_id;
        if($curr_user_id && $_COOKIE[$cookie_name] != -1 && !$_GET['location_id']){
            $location = get_term_by('id', $_COOKIE[$cookie_name], 'job_listing_region'); 
            $location_slug = $location->slug;
        }elseif ($_GET['location_id']) {
            $location_slug = $_GET['location_id'];
        }
    ?>
        <?php if(!$_GET['category_id']) { ?>
        <div class="col-xs-12 new_job_listing_category">
            <h3 class="new-search-title">Choose a Category</h3>
            <div class="row new-search-block">
        <?php
            foreach ($categorys as $key => $category) { ?>
                <div class="new-item-list col-xs-6 col-sm-4">
                    <a id="item-list-id-<?php echo $category->term_taxonomy_id ?>" class="item_list_category"  data-list-id="<?php echo $category->term_taxonomy_id ?>" href="/location/<?php echo $location_slug;?>/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
        <?php 
        }
    }
}



function get_posts_by_region_and_category($taxonomy1, $taxonomy2){
    global $wpdb;

    $location = get_term_by('slug', $_GET['location_id'], $taxonomy1);
    $location_id = $location->term_id;

    $category = get_term_by('slug', $_GET['category_id'], $taxonomy2); 
    $category_id = $category->term_id;

    $posts = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT tr1.object_id FROM wp_term_relationships tr
        LEFT JOIN wp_term_relationships tr1
        ON tr1.object_id = tr.object_id where tr.term_taxonomy_id='.$location_id.' AND tr1.term_taxonomy_id = '.$category_id));
    ?>
        <h3 class="new-search-title">Choose The Post</h3>
    <?php
    foreach ($posts as $post) {
       $post_id = $post->object_id;?>
       <div class="new-item-post new-item-list col-xs-6 col-sm-4">
            <a class="item_list" href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a>
       </div>
    <?php
    }
}


/* ----------------------------------------------------------------------------------- */
// This starts the Taxonomy Search Block.
/* ----------------------------------------------------------------------------------- */

add_action('widgets_init', 'taxanomy_search_widgets');

function taxanomy_search_widgets() {
    register_widget('Taxonomy_Search_Widget');
}

class Taxonomy_Search_Widget extends WP_Widget {

    function Taxonomy_Search_Widget() {
        $widget_ops = array('classname' => 'taxanomy_search_block', 'description' => __('Search posts by location and category', "listify"));
        $this->WP_Widget('taxanomy_search_widget', __('Taxonomy Search Widget', "listify"), $widget_ops, '');
    }

    function widget($args, $instance) {
        extract($args);
        $title = $instance['title'];
        if($_GET['search_region'] || $_GET['search_categories'][0] || $_GET['search_keywords']){
        ?>
        	<aside id="" class="home-widget ">
	            <div class="taxanomy_search-widget">
	                <?php search_post_block($_GET['search_region'], $_GET['search_categories'][0], $_GET['search_keywords'], $title); ?>
	            </div>
	        </aside>
        <?php            
        }elseif ($_GET['location_id'] && $_GET['category_id']) {
        	$location = get_term_by('slug', $_GET['location_id'], 'job_listing_region');
		    $location_id = $location->term_id;

		    $category = get_term_by('slug', $_GET['category_id'], 'job_listing_category'); 
		    $category_id = $category->term_id;
		    if($location_id && $category_id){
		    ?>
		    	<aside id="" class="home-widget ">
		            <div class="taxanomy_search-widget border-bottom-none">
		                <?php search_post_block($location_id, $category_id, '', ''); ?>
		            </div>
		        </aside>
	        <?php 
	    	}
        }
    }

    function form($instance) {
        $defaults = array(
            'title' => __('Search Result', "listify"));
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', "listify"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>
        <?php
    }

}

function search_post_block($location_id, $category_id, $keywords, $title) {
    global $wpdb;

    $sql = ' po.post_status = "publish"';
    if($location_id){
        $sql .= ' AND tr.term_taxonomy_id='.$location_id;
    }

    if($location_id && $category_id){
        $sql .= ' AND tr1.term_taxonomy_id = '.$category_id;
    }

    if($keywords){
        $sql .= ' AND (po.post_title LIKE "%'.$keywords.'%" OR po.post_content LIKE "%'.$keywords.'%")';
    }

    $sql .= ' ORDER BY po.post_date DESC';

    $posts = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT tr1.object_id FROM wp_term_relationships tr
        LEFT JOIN wp_term_relationships tr1
        ON tr1.object_id = tr.object_id
        LEFT JOIN wp_posts po
        ON po.ID = tr1.object_id
        where '.$sql));
    ?>
    
    	<?php echo $title ? '<h3 class="new-search-title">'.$title.'</h3>' : ''; ?>
        <ul class="job_listings listing-cards-anchor--active">
    <?php
    if($posts){
        foreach ($posts as $post) {
            $post_id = $post->object_id;
            ?>
            <li id="listing-<?php echo $post_id; ?>" class="job_listing type-job_listing card-style--default style-grid listing-card type-job_listing style-grid col-xs-12 col-md-6 col-lg-4">
                <div class="content-box">
                    <a href="<?php echo get_the_permalink($post_id); ?>" class="job_listing-clickbox"></a>
                    <header class="job_listing-entry-header listing-cover has-image" style="background-image:url(<?php echo get_the_post_thumbnail_url($post_id); ?>)">
                        <div class="job_listing-entry-header-wrapper cover-wrapper">
                            <div class="job_listing-entry-meta">
                                <?php if(get_post_meta($post_id, 'Featured', true) == 1) { ?>
                                <div class="featured-posts"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/featured-icon.png"></div>
                                <?php } ?>
                            </div>
                        </div>
                    </header>
                    <footer class="job_listing-entry-footer">
                        <h3 class="job_listing-title"><?php echo get_the_title($post_id); ?></h3>
                        <div class="sub-title"><?php echo get_post_meta($post_id, 'SubTitle', true); ?></div>
                        <div class="job_listing-location"><?php echo get_regions_link($post_id) ?></div>
                    </footer> 
                </div>
            </li>
    <?php
        } 
    }else{
        echo '<div class="no_result_widget col-xs-12">Sorry No Results Found</div>';
    }
    ?>
        </ul>
    <?php
}

function get_regions_link($object_id) {
    global $wpdb;
    $regions_id = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT tt.term_taxonomy_id FROM wp_term_relationships tr
    LEFT JOIN wp_term_taxonomy tt
    ON tt.term_taxonomy_id = tr.term_taxonomy_id
    where tr.object_id='.$object_id.' AND tt.taxonomy = "job_listing_region"'));

    foreach ($regions_id as $region_id) { 
            $region = get_term_by('id', $region_id->term_taxonomy_id, 'job_listing_region');
            $region_slug = $region->slug;
        ?>
        <a><?php echo get_cat_name($region_id->term_taxonomy_id); ?></a>
    <?php
    }
}



/* ----------------------------------------------------------------------------------- */
// This starts the Custom Listings Page.
/* ----------------------------------------------------------------------------------- */

add_action('widgets_init', 'custom_listings_page');

function custom_listings_page() {
    register_widget('Custom_Listings_Page');
}

class Custom_Listings_Page extends WP_Widget {

    function Custom_Listings_Page() {
        $widget_ops = array('classname' => 'custom_listings_page', 'description' => __('Custom Listings List', "listify"));
        $this->WP_Widget('custom_listings_page', __('Custom Listings Page', "listify"), $widget_ops, '');
    }

    function widget($args, $instance) {
        extract($args);
        //$title = $instance['title'];
        $count = $instance['count'];
        if($instance['title']){
        	$title = '<h2 class=custom-listings-title>'.$instance['title'].'</h2>';
        }else{
        	$title = '';
        }
    ?>	<aside id="listify_widget_recent_listings-1" class="home-widget listify_widget_recent_listings">
	    	<div id="listify_widget_recent_listings-1">
	    		<?php echo $title ?>
	    		<ul id="custom_listings_home_page" class="job_listings"></ul>
	    	</div>
	    </aside>
    <?php   
        get_custom_joblistings('#custom_listings_home_page', $count);
    }

    function form($instance) {
        $defaults = array(
            'title' => __('Listings', "listify"));
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', "listify"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number to show:', "boilerplate"); ?></label>
            <input id="" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" style="width:100%;"/></p>
        <?php
    }

}

function get_custom_joblistings($anchor, $count) {
	$response = array(
		'found_jobs' => false,
		'found_posts' => 0,
		'listings' => array(),
	);
	$response['found_jobs'] = true;
	$response['found_posts'] = $listings->found_posts;

	$args = array(
		'post_type'              => 'job_listing',
		'post_status'            => 'publish',
		'ignore_sticky_posts'    => 1,
		'offset'                 => 0,
		'posts_per_page'         => -1,
		'orderby' 				 => 'date',
		'order' 				 => 'DESC',
		'tax_query'              => array(),
		'meta_query'             => array(),
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'cache_results'          => false
	);

	$listings = get_job_listings( $args );

	if ( ! $listings->have_posts() ) {
		return false;
	}

	$posts = $listings->get_posts();

	if ( empty( $posts ) ) {
		return false;
	}

	$i = 0;
	foreach ( $listings->get_posts() as $post ) {
		if(get_post_meta($post->ID, 'ShowHome', true) == 'yes' && $i < $count){
			$response['listings'][] = listify_get_listing( $post->ID )->to_array();
			$i++;
		}
	}

	ob_start();
?>

(function () {
	wp.listifyResults.controllers.dataService.response = <?php echo wp_json_encode( $response ); ?>;
	wp.listifyResults.controllers.dataService.addResults( <?php echo wp_json_encode( $anchor ); ?> );
}) ();

<?php

	$script = ob_get_clean();

	wp_enqueue_script( 'listify-results' );
	wp_enqueue_script( 'listify-listings' );

	wp_add_inline_script( 'listify-listings', $script );

	return true;
}