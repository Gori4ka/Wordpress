<?php
add_action('add_meta_boxes', 'cd_meta_box_add');

function cd_meta_box_add() {
    add_meta_box('post-meta-box-id', 'Post Attributes', 'cd_meta_box_cb', 'competition_members', 'normal', 'high');
}

function cd_meta_box_cb() {
    global $wpdb;
    $post_item = get_post(get_the_ID());

    $link = get_user_meta($post_item->post_author, '_fb_user_id', true);

    if ($link == '') {
        $user = get_userdata($post_item->post_author);
        $link = $user->user_email;
    }
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>  


    <hr>
    <div class="clearfix" style="height: 30px;">
        <p>   
            <label style="width: 500px;display: block;float: left;" for="post_price">User: <?php echo $link ?></label>  

        </p>

        <?php
    }

    add_action('save_post', 'cd_meta_box_save');

    function cd_meta_box_save($post_id) {
        // Bail if we're doing an auto save  
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        // if our nonce isn't there, or we can't verify it, bail 
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce'))
            return;

        // now we can actually save the data  
        $allowed = array(
            'a' => array(// on allow a tags  
                'href' => array() // and those anchors can only have href attribute  
            )
        );
    }

// Add Metabox Post Type panarama_pic
//add_action('add_meta_boxes', 'marquee_meta_box_add');important

        