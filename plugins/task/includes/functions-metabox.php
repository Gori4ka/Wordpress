<?php
//Add meta boxes 
add_action('add_meta_boxes', 'cd_meta_box_add');

function cd_meta_box_add() {
    add_meta_box('post-meta-box-id', 'Post Attributes', 'cd_meta_box_cb', 'task', 'normal', 'high');
}

function cd_meta_box_cb() {
    global $wpdb;
    $date_start = get_post_meta(get_the_ID(), '_date-start', true);
    $due_date = get_post_meta(get_the_ID(), '_due-date', true);
    $priority = get_post_meta(get_the_ID(), '_priority', true);
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
?>

<div class="container">
    <div class='col-md-4'>
        <div class="form-group">
        	<label for="sel1">Start date</label>
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" value="<?= $date_start ?>" name="_date-start" />
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-4'>
        <div class="form-group">
        	<label for="sel1">Due date</label>
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' class="form-control" name="_due-date" value="<?= $due_date ?>" />
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    	<div class="form-group">
		  <label for="sel1">Priority</label>
		  <select name="_priority" class="form-control" id="sel1">
		  	<option></option>
		    <option value="high" <?php if($priorit == 'high'){echo 'selected';} ?>>high</option>
		    <option value="low" <?php if($priority == 'low'){echo 'selected';} ?>>low</option>
		    <option value="normal" <?php if($priority == 'normal'){echo 'selected';} ?>>normal</option>
		  </select>
		</div>
    </div>
</div>


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

    if (isset($_POST['_date-start']) && $_POST['_date-start'] != '') {
        update_post_meta($post_id, '_date-start', $_POST['_date-start']);
    }
    if (isset($_POST['_date-start']) && $_POST['_date-start'] == '')
        delete_post_meta($post_id, '_date-start');

    if (isset($_POST['_due-date']) && $_POST['_due-date'] != '') {
        update_post_meta($post_id, '_due-date', $_POST['_due-date']);
    }
    if (isset($_POST['_due-date']) && $_POST['_due-date'] == '')
        delete_post_meta($post_id, '_due-date');

    if (isset($_POST['_priority']) && $_POST['_priority'] != '') {
        update_post_meta($post_id, '_priority', $_POST['_priority']);
    }
    if (isset($_POST['_priority']) && $_POST['_priority'] == '')
        delete_post_meta($post_id, '_priority');
    
}

?>