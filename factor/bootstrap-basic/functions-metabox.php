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
    $bold = get_post_meta(get_the_ID(), 'bold', true);

    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>
    <?php if (get_post_meta(get_the_ID())) { ?>
        <p>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
                <span class="dashicons dashicons-facebook" style="font-size:50px; margin: 0px 0px 35px 15px;"></span>
            </a>
        </p>
    <?php } ?>

    <p><label for="YoutubeID">YouTube ID:</label>
        <input type="text"  name="YoutubeID" value="<?php echo $youtube_video_id; ?>" id="youtube_id" />
    </p>

    <p>
        <label style="width: 88px;display: block;float: left;" for="embede_code_1">Embed Code 1</label>
        <textarea style="width: 250px;" type="text"  name="embede_code_1" id="embede_code_1" ><?php echo $embede_code_1; ?></textarea>
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

    <p> 
        <label>Bold:</label><input type="checkbox" name="bold" value="checked" <?php echo $bold; ?>>
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
    if (isset($_POST['YoutubeID']) && $_POST['YoutubeID'] != '')
        update_post_meta($post_id, 'YoutubeID', $_POST['YoutubeID']);

    if (isset($_POST['YoutubeID']) && $_POST['YoutubeID'] == '')
        delete_post_meta($post_id, 'YoutubeID');

    if (isset($_POST['embede_code_1']) && $_POST['embede_code_1'] != '') {
        update_post_meta($post_id, 'embede_code_1', $_POST['embede_code_1']);
    }

    if (isset($_POST['embede_code_1']) && $_POST['embede_code_1'] == '')
        delete_post_meta($post_id, 'embede_code_1');

    if (isset($_POST['GalleryId']) && $_POST['GalleryId'] != '') {
        update_post_meta($post_id, 'GalleryId', esc_attr($_POST['GalleryId']));
    }
    if (isset($_POST['GalleryId']) && $_POST['GalleryId'] == '-1') {
        delete_post_meta($post_id, 'GalleryId');
    }


    if (isset($_POST['bold']) && $_POST['bold'] != '') {
        update_post_meta($post_id, 'bold', $_POST['bold']);
    }

    if ($_POST['bold'] == '') {
        delete_post_meta($post_id, 'bold');
    }
}

// Add Metabox Post Type panarama_pic
//add_action('add_meta_boxes', 'marquee_meta_box_add');important
