<?php

add_action( 'add_meta_boxes', 'text_meta_box_add' );

/* Do something with the data entered */
add_action( 'save_post', 'text_meta_box_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function text_meta_box_add() {
  add_meta_box( 'post-meta-box-id', 'Post Attributes', 'text_meta_box_cb', 'download-post', 'normal', 'high' );
}

/* Prints the box content */
function text_meta_box_cb( $post ) {

  // Use nonce for verification
  wp_nonce_field('my_text_meta_box_nonce', 'text_meta_box_nonce');

  $field_value = get_post_meta( $post->ID, '_post_description', false );
  echo '<p style="margin: 18px 0;font-size: 18px;">Description</p>';
  wp_editor( $field_value[0], '_post_description', array('textarea_rows' => 10) );

  $field_value = get_post_meta( $post->ID, '_post_can_expect', false );
  echo '<p style="margin: 18px 0;font-size: 18px;">What you can expect</p>';
  wp_editor( $field_value[0], '_post_can_expect', array('textarea_rows' => 10) );

  $field_value = get_post_meta( $post->ID, '_post_requirements', false );
  echo '<p style="margin: 18px 0;font-size: 18px;">Requirements</p>';
  wp_editor( $field_value[0], '_post_requirements', array('textarea_rows' => 10) );

  $field_value = get_post_meta( $post->ID, '_post_faqs', false );
  echo '<p style="margin: 18px 0;font-size: 18px;">FAQs</p>';
  wp_editor( $field_value[0], '_post_faqs', array('textarea_rows' => 10) );

}

/* When the post is saved, saves our custom data */
function text_meta_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  if ( ( isset ( $_POST['text_meta_box_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['text_meta_box_nonce'], 'my_text_meta_box_nonce' ) ) )
      return;

  if ( isset ( $_POST['_post_description'] ) ) {
    update_post_meta( $post_id, '_post_description', $_POST['_post_description'] );
  }

  if ( isset ( $_POST['_post_can_expect'] ) ) {
    update_post_meta( $post_id, '_post_can_expect', $_POST['_post_can_expect'] );
  }

 if ( isset ( $_POST['_post_requirements'] ) ) {
    update_post_meta( $post_id, '_post_requirements', $_POST['_post_requirements'] );
  }

 if ( isset ( $_POST['_post_faqs'] ) ) {
    update_post_meta( $post_id, '_post_faqs', $_POST['_post_faqs'] );
  }

}






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

