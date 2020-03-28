<?php
include('includes/admin-pages.php');

//function for handling the poll adding form

function backend_form_handler() {
    if (isset($_POST["submit"])) {
        global $wpdb;
        $user_id = get_current_user_id();
        if (isset($_POST['question']) && $_POST['question']) {
            $question = $_POST['question'];
        }
        if (isset($_POST['start_date']) && $_POST['start_date']) {
            $start_date = $_POST['start_date'];
        }
        if (isset($_POST['end_date']) && $_POST['end_date']) {
            $end_date = $_POST['end_date'];
        }
        if (isset($_POST['status']) && (int) $_POST['status']) {
            $status = (int) $_POST['status'];
        }
        if (isset($_POST['type']) && (int) $_POST['type']) {
            $type = (int) $_POST['type'];
        }
        if (isset($_POST['answer']) && $_POST['answer']) {
            $answers = $_POST['answer'];
        }
        $wpdb->query($wpdb->prepare(
        'INSERT INTO ' . $wpdb->prefix . 'poll ( question, user_id, start_date, end_date, status, type ) VALUES ( %s, %d, %s, %s, %d, %d )', $question, $user_id, $start_date, $end_date, $status, $type
        ));

        $poll_id = $wpdb->insert_id;
        foreach ($answers as $answer) {
            $answer = trim($answer);
            if (!empty($answer)) {
                $wpdb->query($wpdb->prepare(
                                'INSERT INTO ' . $wpdb->prefix . 'poll_answer ( poll_id, answer ) VALUES ( %d, %s )', $poll_id, $answer
                ));
            } else {
                return;
            }
        }

        echo '<div class="alert alert-success">' .
        '<strong>Success!</strong> Poll was created' .
        '<span class="message_close_btn dashicons dashicons-no"></span>' .
        '</div>';
    }
}

//function for updating the poll in backend

function updated_form_handler() {
    global $wpdb;
    global $site_url;
    if (isset($_POST["submit"])) {

        $user_id = get_current_user_id();

        if (isset($_POST['question']) && $_POST['question']) {
            $question = $_POST['question'];
        }
        if (isset($_POST['start_date']) && $_POST['start_date']) {
            $start_date = $_POST['start_date'];
        }
        if (isset($_POST['end_date']) && $_POST['end_date']) {
            $end_date = $_POST['end_date'];
        }
        if (isset($_POST['status']) && (int) $_POST['status']) {
            $status = (int) $_POST['status'];
        }
        if (isset($_POST['type']) && (int) $_POST['type']) {
            $type = (int) $_POST['type'];
        }
        if (isset($_POST['answer']) && $_POST['answer']) {
            $answers = $_POST['answer'];
        }
        if (isset($_POST['new_answer']) && $_POST['new_answer']) {
            $new_answers = $_POST['new_answer'];
        }
        if (isset($_POST['total_count']) && $_POST['total_count']) {
            $total_counts = $_POST['total_count'];
        }

        if($end_date < date("Y-m-d")){
          $state = 2;
        }
        else{
          $state = 1;
        }

        $poll_update = $wpdb->update(
                $wpdb->prefix . 'poll', array(
            'question' => $question,
            'user_id' => $user_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => $status,
            'state' => $state,
            'type' => $type
                ), array('ID' => (int) $_GET['id']), array(
            '%s', '%d', '%s', '%s', '%d', '%d', '%d'
                )
        );

        $poll_id = (int) $_GET['id'];
        if ($answers) {
            foreach ($answers as $key => $answer) {
                if ($answer != '' && $key != 0) {
                    $count = isset($total_counts[$key]) ? (int) $total_counts[$key] : 0;
                    $args = array('poll_id' => $poll_id, 'answer' => $answer, 'total_count' => $count, 'answer_id' => $key);
                    update_poll_answer($args);
                }
            }
        }

        if ($new_answers) {
            foreach ($new_answers as $new_answer) {
                $new_answer = trim($new_answer);
                if (!empty($new_answer)) {
                    $wpdb->query($wpdb->prepare(
                                    'INSERT INTO ' . $wpdb->prefix . 'poll_answer ( poll_id, answer ) VALUES ( %d, %s )', $poll_id, $new_answer
                    ));
                }
            }
        }
        ?>

        <div class="alert alert-success">
            <strong>Success!</strong> Poll was updated
            <span class="message_close_btn dashicons dashicons-no"></span>
        </div>
        <a href="<?php echo $site_url; ?>/wp-admin/admin.php?page=poll" class="return">Return to Polls</a> <?php
    }
}

//function for updating the polls answers

function update_poll_answer($args) {
    global $wpdb;
    $wpdb->update(
            $wpdb->prefix . 'poll_answer', array(
        'poll_id' => (int) $args['poll_id'],
        'answer' => $args['answer'],
        'total_count' => (int) $args['total_count']
            ), array('id' => (int) $args['answer_id']), array(
        '%d', '%s', '%d'
            )
    );
}

//function for deleting the polls

add_action('wp_ajax_delete_poll', 'delete_poll');

function delete_poll() {
    if (isset($_POST['delete']) && (int) $_POST['delete']) {
        global $wpdb;

        $poll_id = (int) $_POST['delete'];
        $res = true;
        $wpdb->delete($wpdb->prefix . 'poll', array('ID' => $poll_id));
        $wpdb->delete($wpdb->prefix . 'poll_answer', array('poll_id' => $poll_id));
        $wpdb->delete($wpdb->prefix . 'poll_user', array('poll_id' => $poll_id));

        if ($res) {
            $response = array('status' => 'ok', 'message' => '');
        } else {
            $response = array('status' => 'error', 'message' => 'Error!!! Poll wasn\'t deleted. Try again.');
        }
        return wp_send_json($response);
    }
}

//function for echoing the poll answers in frontend

function get_poll_answers($id, $type, $answer_text, $poll_state = '') {
  global $wpdb;
  $answer_rows = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll_answer WHERE poll_id = %d', $id));

  $answer_count = $wpdb->get_var($wpdb->prepare('SELECT SUM(total_count) FROM ' . $wpdb->prefix . 'poll_answer WHERE poll_id = %d', $id));
    ?>
    <div class="answer-list"> <?php
    foreach ($answer_rows as $row) {

      if($row->total_count){
        $sum = ($row->total_count * 100) / $answer_count;
      }else{
        $sum = 0;
      }

      if($answer_text == true || $poll_state == 2){ ?>
        <div class="radio-and-progress clearfix">
          <div class="radio">
            <span class="answer"><?php echo $row->answer; ?></span>
            <span class="request-count">(<?php echo $row->total_count; ?>)</span>
          </div>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($sum); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($sum); ?>%;"><?= round($sum) ?>%</div>
          </div>
        </div>
        <?php
      } elseif($answer_text == false ){ ?>
        <div class="radio-and-progress clearfix">
          <div class="radio">
            <label>
              <?php if ($type == 1) { ?>
                <input type="radio" id="answer_<?php echo $row->id ?>" name="answer" value="<?php echo $row->id ?>" class="radio_input" />
                <?php
              } elseif ($type == 2) {
                ?>
                <input type="checkbox" id="answer_<?php echo $row->id ?>" name="answer" value="<?php echo $row->id ?>" class="checkbox_input" /> <?php
              } echo $row->answer;
              ?>
            </label>
          </div>
        </div>
        <?php
      }
    }
    ?>
  </div>
  <?php
  }

add_action('wp_ajax_nopriv_submit_frontend_form', 'submit_frontend_form');
add_action('wp_ajax_submit_frontend_form', 'submit_frontend_form');

function submit_frontend_form() {

    $poll_id = isset($_POST['poll_id']) ? (int)$_POST['poll_id'] : '';
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : '';
    $single_answer_id = isset($_POST['answer']) ? (int)$_POST['answer'] : '';
    $multi_answer_id = isset($_POST['multi_answer']) ? $_POST['multi_answer'] : '';

    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
        return wp_send_json(array('status' => 'error', 'message' => 'Սխալ էլ.փոստ'));
    }

    if (isset($_COOKIE['poll_cookie_' . $poll_id]) || validate_user ($poll_id, $user_email)) {
        return wp_send_json(array('status' => 'error', 'message' => "Դուք արդեն քվեարկել եք"));
    }

    if($poll_id){
      set_poll_cookie($poll_id);
    }

    if ($single_answer_id) {
        update_answer_result($single_answer_id);
    } else if (is_array($multi_answer_id) && count($multi_answer_id) > 0) {
        foreach ($multi_answer_id as $answer_id) {
            update_answer_result((int) $answer_id);
        }
    }

    if($user_email){
      poll_user_data($poll_id, $user_email);
    }

    return wp_send_json(array('status' => 'ok', 'message' => 'Շնորհակալություն քվեարկության համար'));
}

function update_answer_result($answer_id) {
    global $wpdb;
    $answer_count = $wpdb->get_var($wpdb->prepare('SELECT total_count FROM ' . $wpdb->prefix . 'poll_answer WHERE id = %d', $answer_id));
    $answer_count = $answer_count + 1;
    $wpdb->update(
            $wpdb->prefix . 'poll_answer', array(
        'total_count' => $answer_count
            ), array('id' => $answer_id), array(
        '%d'
            )
    );
}

function poll_user_data($poll_id, $email){
  global $wpdb;

  $user_ip = get_user_ip();

  $wpdb->query($wpdb->prepare('INSERT INTO ' . $wpdb->prefix . 'poll_user ( poll_id, user_email, user_ip ) VALUES ( %d, %s, %s )', $poll_id, $email, $user_ip));
}

function get_user_ip() {
  if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
    $user_ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else {
    $user_ip = $_SERVER['REMOTE_ADDR'];
  }
  return $user_ip;
}

function validate_user ($poll_id, $user_email = ''){
  global$wpdb;
  $user_ip = get_user_ip();
  $user = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll_user WHERE poll_id = %d AND (user_email = %s OR user_ip = %s)', $poll_id, $user_email, $user_ip));
  return $user;
}

add_action('submit_frontend_form', 'set_poll_cookie');

function set_poll_cookie($id) {
    setcookie('poll_cookie_' . $id, 1, time() + 60 * 60 * 24 * 30, COOKIEPATH, COOKIE_DOMAIN);
}

function check_poll_expire_date($poll_id){
  global $wpdb;

  $poll_state = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll WHERE id = %d', $poll_id));

  if($poll_state){
    if($poll_state->end_date < date("Y-m-d")){
      update_poll_state($poll_id, 2);
    }
    else{
      update_poll_state($poll_id, 1);
    }
  }
}

function update_poll_state($poll_id, $column){
  global $wpdb;

  $wpdb->update(
  $wpdb->prefix . 'poll', array(
    'state' => $column
  ), array('ID' => $poll_id), array(
      '%d'
    )
  );
}

function poll_pagination($total, $showPages, $post_per_page, $url) {
    $num_of_pages = ceil($total / $post_per_page);
    $current_page = (int) $_GET['pagenum'];

    if ($num_of_pages > 1) {
        ?>
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="<?php if ($current_page - 1 > 0) echo add_query_arg(array('pagenum' => $current_page - 1),$url); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <?php
                if ($current_page == 1) {
                    $active_class = 'active';
                }
                $display_none = '';
                $display = '';
                if ($current_page <= $showPages) {
                    $display_none = 'style = "display:none "';
                }
                if ($num_of_pages - $showPages < $current_page) {
                    $display = 'style = "display:none "';
                }
                ?>
                <li class="page-item  <?php echo $active_class; ?>">
                    <a class="page-link" href="<?php echo add_query_arg(array('pagenum' => 1), $url); ?>">1</a>
                </li>
                <li class="page-item" <?php echo $display_none; ?> >
                    <span class="page-link page-point">...</span>
                </li>
                <?php
                for ($i = 2; $i < $num_of_pages; $i++) {
                    if ($i > $current_page - $showPages && $i < $current_page + $showPages) {
                        $active_class = '';
                        if ($current_page == $i) {
                            $active_class = ' active';
                        }
                        ?>
                        <li class="page-item  <?php echo $active_class; ?>">
                            <a class="page-link" href="<?php echo add_query_arg(array('pagenum' => $i), $url); ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                    }
                }
                if ($num_of_pages > $showPages) {
                    ?>
                    <li class="page-item" <?php echo $display; ?>>
                        <span class="page-link page-point">...</span>
                    </li>
                    <?php
                }
                if ($current_page == $num_of_pages) {
                    $active = ' active';
                }
                ?>
                <li class="page-item <?php echo $active; ?>">
                    <a class="page-link" href="<?php echo add_query_arg(array('pagenum' => $num_of_pages), $url); ?>"><?php echo $num_of_pages; ?></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?php if ($current_page + 1 <= $num_of_pages) echo add_query_arg(array('pagenum' => $current_page + 1), $url); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
        <?php
    }
}
