<?php
add_action('add_meta_boxes', 'cd_meta_box_add');

function cd_meta_box_add() {
    add_meta_box('post-meta-box-id', 'Post Attributes', 'cd_meta_box_cb', 'post', 'normal', 'high');
}

function cd_meta_box_cb() {
    global $wpdb;
    $gallereys = $wpdb->get_results('SELECT *
    FROM  `wp_ngg_gallery`
       ORDER BY  `wp_ngg_gallery`.`gid` DESC
    LIMIT 50');
    $gall_ID = get_post_meta(get_the_ID(), 'GalleryId', true);
    $youtube_video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
    $embede_code_1 = get_post_meta(get_the_ID(), 'embede_code_1', true);
    $arm_post_id = get_post_meta(get_the_ID(), 'arm_post_id', true);
    $featured_image = get_post_meta(get_the_ID(), 'featured_image', true);
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

    <p><label for="YoutubeID">YouTube ID:</label>
        <input type="text"  name="YoutubeID" value="<?php echo $youtube_video_id; ?>" id="youtube_id" />
    </p>

    <p>
        <label style="width: 88px;display: block;float: left;" for="GalleryId">Gallerey ID</label>
        <select name="GalleryId" id="gallerey_id_select">
            <option value="-1">Select Gallerey ID</option>
            <?php
            $check = 0;
            foreach ($gallereys as $gallerey) {
                $selected = '';
                if ($gall_ID == $gallerey->gid) {
                    $selected = 'selected';
                    $check = 1;
                }
                echo '<option ' . $selected . ' value="' . $gallerey->gid . '">' . $gallerey->gid . ' ' . $gallerey->name . '</option>';
            }
            if ($check == 0 && $gall_ID) {
                echo '<option selected value="' . $gall_ID . '">' . $gall_ID . '</option>';
            }
            ?>
        </select>
    </p>

    <?php
global $blog_id;
if ($blog_id != 1) {
    $posts = $wpdb->get_results('SELECT ID, post_title FROM wp_posts WHERE post_status = "publish" AND post_type = "post" ORDER BY ID DESC LIMIT 100');
    ?>
    <p>
        <label style="width: 88px;display: block;float: left;" for="arm_post_id">Translate ID</label>
        <select style="width: 250px;" name="arm_post_id" id="gallerey_id_select">
            <option value="-1">Select Translate ID</option>
            <?php
            $check = 0;
            foreach ($posts as $posts_item) {

                $selected = '';
                if ($arm_post_id == $posts_item->ID) {
                    $selected = 'selected';
                    $check = 1;
                }
                echo '<option ' . $selected . ' value="' . $posts_item->ID . '">' . $posts_item->ID . ' ' . $posts_item->post_title . '</option>';
            }
            if ($check == 0 && $arm_post_id) {
                echo '<option selected value="' . $arm_post_id . '">' . $arm_post_id . '</option>';
            }
            ?>
        </select>

        <input style="width: 88px;display: block;float: left;" type="text" name="arm_post_id_custom" value="" id="arm_post_id_custom" style="width:50px;" />
    </p>
<?php } ?>


    <p><label style="width: 88px;display: block;float: left;" for="embede_code_1">Embed Code 1</label>
        <textarea style="width: 250px;" type="text"  name="embede_code_1" id="embede_code_1" ><?php echo $embede_code_1; ?></textarea>  </p>
    
    <p><label for="featuredImage">Featured Image:</label>
        <input type="text"  name="featured_image" value="<?php echo $featured_image; ?>" id="featuredImage" /> 
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

    if (wp_is_post_revision($post_id))
        return;

    if (isset($_POST['GalleryId']) && $_POST['GalleryId'] != '') {
        update_post_meta($post_id, 'GalleryId', esc_attr($_POST['GalleryId']));
    }
    if (isset($_POST['GalleryId']) && $_POST['GalleryId'] == '-1') {
        delete_post_meta($post_id, 'GalleryId');
    }

    // Make sure your data is set before trying to save it
    if (isset($_POST['YoutubeID']) && $_POST['YoutubeID'] != '')
        update_post_meta($post_id, 'YoutubeID', $_POST['YoutubeID']);

    if (isset($_POST['YoutubeID']) && $_POST['YoutubeID'] == '')
        delete_post_meta($post_id, 'YoutubeID');

    if (isset($_POST['arm_post_id']) && $_POST['arm_post_id'] != '-1' && $_POST['arm_post_id'] != '') {
        update_post_meta($post_id, 'arm_post_id', esc_attr($_POST['arm_post_id']));
    }

    if (isset($_POST['arm_post_id']) && $_POST['arm_post_id'] == '-1' && !isset($_POST['arm_post_id_custom']))
        delete_post_meta($post_id, 'arm_post_id');

    if (isset($_POST['arm_post_id_custom']) && $_POST['arm_post_id_custom'] != '' && $_POST['arm_post_id'] != '' && $_POST['arm_post_id'] == '-1') {
        update_post_meta($post_id, 'arm_post_id', $_POST['arm_post_id_custom']);
    }

    if (isset($_POST['embede_code_1']) && $_POST['embede_code_1'] != '') {
        update_post_meta($post_id, 'embede_code_1', $_POST['embede_code_1']);
    }

    if (isset($_POST['embede_code_1']) && $_POST['embede_code_1'] == '')
        delete_post_meta($post_id, 'embede_code_1');
    
    if (isset($_POST['featured_image']) && $_POST['featured_image'] != '')
        update_post_meta($post_id, 'featured_image', $_POST['featured_image']);
    
    if (isset($_POST['featured_image']) && $_POST['featured_image'] == '')
        delete_post_meta($post_id, 'featured_image');
}

add_action('add_meta_boxes', 'cd_meta_box_add_personnel');

function cd_meta_box_add_personnel() {
    add_meta_box('post-meta-box-id', 'Post Attributes', 'cd_meta_box_cb_personnel', 'personnel', 'normal', 'high');
}

function cd_meta_box_cb_personnel() {
    global $wpdb;
    $position = get_post_meta(get_the_ID(), 'user_position', true);

    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>


    <hr>
    <p><label for="position">Position:</label>
        <input type="text"  name="position" value="<?php echo $position; ?>" id="position" />
    </p>
    <hr>
    <?php
}

add_action('save_post', 'cd_meta_box_save_personnel');

function cd_meta_box_save_personnel($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;


    if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'my_meta_box_nonce'))
        return;


    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );


    delete_post_meta($post_id, 'user_position');

    if (isset($_POST['position']) && $_POST['position'] != '')
        update_post_meta($post_id, 'user_position', $_POST['position']);
}
