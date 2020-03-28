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
    $embede_code = get_post_meta(get_the_ID(), 'embede_code', true);
    $youtube_video_id = get_post_meta(get_the_ID(), 'YoutubeID', true);
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>

    <p><label for="YoutubeID">YouTube ID:</label>
        <input type="text"  name="YoutubeID" value="<?php echo $youtube_video_id; ?>" id="youtube_id" />
    </p>

    <p><label style="width: 88px;display: block;float: left;" for="embede_code">Embed Code</label>
        <textarea cols="50" type="text"  name="embede_code" id="embede_code" ><?php echo $embede_code; ?></textarea>  </p>

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


    // Make sure your data is set before trying to save it
    if (isset($_POST['YoutubeID']) && $_POST['YoutubeID'] != ''){
        update_post_meta($post_id, 'YoutubeID', $_POST['YoutubeID']);
    }
    if (isset($_POST['YoutubeID']) && $_POST['YoutubeID'] == ''){
        delete_post_meta($post_id, 'YoutubeID');
    }
    if (isset($_POST['embede_code']) && $_POST['embede_code'] != '') {
        update_post_meta($post_id, 'embede_code', $_POST['embede_code']);
    }
    if (isset($_POST['embede_code']) && $_POST['embede_code'] == '')
        delete_post_meta($post_id, 'embede_code');
    if (isset($_POST['GalleryId']) && $_POST['GalleryId'] == '-1') {
        delete_post_meta($post_id, 'GalleryId');
    }
    if (isset($_POST['GalleryId']) && $_POST['GalleryId'] != '') {
        update_post_meta($post_id, 'GalleryId', esc_attr($_POST['GalleryId']));
    }
}

// Add Metabox Post Type panarama_pic
//add_action('add_meta_boxes', 'marquee_meta_box_add');important
