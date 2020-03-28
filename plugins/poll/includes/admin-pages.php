<?php
include 'frontend-blocks.php';

function poll_admin_page() {
  global $site_url;
    if (!current_user_can('manage_categories')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap poll poll_main_page">
        <h1>Polls
            <span class="add_new"><a href="<?php echo $site_url;?>/wp-admin/admin.php?page=new_poll" class="page-title-action">Add New</a></span>
        </h1>
        <?php
        backend_form_handler();
        get_backend_polls();
        ?>
    </div>
    <?php
}

//function for showing the created forms in poll admin page

function get_backend_polls() {
    global $wpdb;
    global $site_url;

    $all_data = $wpdb->get_results("SELECT * FROM wp_poll ORDER BY status ASC, id DESC");
    if (!$all_data) {
        echo '<div class="alert alert-danger">' .
        '<strong>No</strong> result.' .
        '<span class="message_close_btn dashicons dashicons-no"></span>' .
        '</div>';
        return;
    }
    ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover poll_table">
        <thead>
          <tr>
            <th>#</th>
            <th>Polls</th>
            <th>Start date</th>
            <th>Expire date</th>
            <th>Author</th>
            <th>Type</th>
            <th>Status</th>
            <th>Udpate</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($all_data as $key => $data) { ?>
          <tr>
            <td> <?php echo $key + 1 . '.'; ?> </td>
            <td> <?php echo $data->question; ?> </td>
            <td> <?php echo $data->start_date; ?> </td>
            <td> <?php echo $data->end_date; ?> </td>
            <td> <?php echo get_user_by('id', $data->user_id)->display_name; ?> </td>
            <td>
              <?php
              if ($data->type == 1) {
                echo 'Single choose';
              } else {
                echo 'Multiple choose';
              }
              ?>
            </td>
            <td>
              <?php
              if ($data->status == 1) {
                  echo 'Active';
              } else {
                  echo 'Not active';
              }
              ?>
            </td>
            <td class="update">
              <a class="update_icon" href="<?php echo $site_url;?>/wp-admin/admin.php?page=update_poll&id=<?php echo $data->id ?>"><span class="dashicons dashicons-edit"></span></a>
            </td>
            <td class="delete">
              <span class="delete_icon interact_icon" href="#" data-poll-id="<?php echo $data->id ?>"><span class="dashicons dashicons-trash"></span></span>
            </td>
          </tr> <?php
        }
        ?>
      </tbody>
    </table>
    <?php echo the_date();?>
  </div> <?php
}

function poll_add_page() {
  global $site_url;
    if (!current_user_can('manage_categories')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap poll">
        <h1>Add New Poll</h1>
        <form action="<?php echo $site_url;?>/wp-admin/admin.php?page=poll" class="poll_form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="question" class="question_label">Question</label>
                <textarea name="question" rows="3" id="question" class="question form-control"></textarea>
            </div>
            <div class="form-group answers">
              <label for="answer">Add answers</label>
                <input type="text" name="answer[]" placeholder="Answer" id="answer" class="form-control answer_field" />
                <div id="plus" class="plus">
                    <span class="dashicons dashicons-plus"></span>
                </div>
            </div>
            <label for="datetimeinput1">Start date</label>
            <div class='input-group form-group' id='datetimepicker1'>
                <input type='text' class="form-control" name="start_date" id="datetimeinput1" value="<?php echo date("Y-m-d") ?>" />
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
            <label for="datetimeinput2">End date</label>
            <div class='input-group form-group' id='datetimepicker2'>
                <input type='text' class="form-control" name="end_date" id="datetimeinput2" value="<?php echo date('Y-m-d', strtotime("+30 days")); ?>" />
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
            <div class="select_type selects">
                <label for="type">Select type</label>
                <select name="type" id="type" class="selectpicker">
                    <option value="1">Single choose</option>
                    <option value="2">Multiple choose</option>
                </select>
            </div>
            <div class="select_status selects">
                <label for="status">Select status</label>
                <select name="status" id="status" class="selectpicker">
                    <option value="1">Active</option>
                    <option value="2">Disabled</option>
                </select>
            </div>
            <?php submit_button('Post') ?>
        </form>
    </div> <?php
}

function poll_update_page() {
    global $wpdb;
    if (!current_user_can('manage_categories')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap poll">
        <h1>Update Poll</h1>
        <?php
        if (!isset($_GET['id']) && !(int) $_GET['id']) {
            return;
        }
        updated_form_handler();
        $poll_id = (int) $_GET['id'];
        $poll_row = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll WHERE id = %d', $poll_id));
        $answer_rows = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll_answer WHERE poll_id = %d', $poll_id));
        ?>

        <form class="poll_form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="question" class="question_label">Question</label>
                <textarea name="question" rows="3" id="question" class="question form-control"><?php echo $poll_row->question ?></textarea>
            </div>
            <div class="form-group answers">
                <?php foreach ($answer_rows as $row) { ?>
                    <div class="form-group">
                        <label for="answer">Old answers</label>
                        <input type="text" id="answer" name="answer[<?php echo $row->id ?>]" placeholder="Answer" value="<?php echo $row->answer; ?>" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="total_count">Answer votes</label>
                        <input type="text" id="total_count" name="total_count[<?php echo $row->id ?>]" placeholder="Total count" value="<?php echo $row->total_count; ?>" class="form-control" />
                    </div>
                    <?php
                }
                ?>
                <label for="new_answers">Add new answers</label>
                <input type="text" id="new_answers" name="new_answer[]" placeholder="Answer" class="form-control answer_field" />
                <div id="update" class="plus">
                    <span class="dashicons dashicons-plus"></span>
                </div>
            </div>
            <label for="datetimeinput1">Start date</label>
            <div class='input-group form-group' id='datetimepicker1'>
                <input type='text' class="form-control" name="start_date" id="datetimeinput1" value="<?php echo $poll_row->start_date ?>" />
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
            <label for="datetimepicker2">End date</label>
            <div class='input-group form-group' id='datetimepicker2'>
                <input type='text' class="form-control" name="end_date" id="datetimeinput1" value="<?php echo $poll_row->end_date ?>" />
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
            <div class="select_type selects">
                <label for="type">Select type</label>
                <select name="type" id="type" class="selectpicker">
                    <?php
                    if ($poll_row->type == 1) { ?>
                        <option selected value="1">Single choose</option>
                        <option value="2">Multiple choose</option> <?php
                    } elseif ($poll_row->type == 2) { ?>
                      <option value="1">Single choose</option>
                      <option selected value="2">Multiple choose</option> <?php
                    }
                    ?>
                </select>
            </div>
            <div class="select_status selects">
                <label for="status">Select status</label>
                <select name="status" id="status" class="selectpicker">
                    <?php
                    if ($poll_row->status == 1) {
                        $select1 = 'selected';
                    } elseif ($poll_row->status == 2) {
                        $select2 = 'selected';
                    }
                    ?>
                    <option <?php echo $select1; ?> value="1">Active</option>
                    <option <?php echo $select2; ?> value="2">Disabled</option>
                </select>
            </div>
            <?php submit_button('Save') ?>
        </form>
    </div>
    <?php
  }
?>
