<?php

function poll_list_generator($count = 12){
  global $wpdb;

  $limit = $count;
  $pagenum = 1;
  if (isset($_GET['pagenum']) && (int) $_GET['pagenum']) {
    $pagenum = (int) $_GET['pagenum'];
  }
  $offset = ( $pagenum - 1 ) * $limit;

  $total_count = $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM ' . $wpdb->prefix . 'poll WHERE status = %d', 1));

  $poll_row = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll'
  . ' WHERE status=%d ORDER BY id DESC LIMIT ' . $limit . ' OFFSET ' . $offset, 1));

    if($poll_row) { ?>
      <div class="poll_list">
        <div class="featured_poll_list">
          <?php
          foreach($poll_row as $poll) {
            check_poll_expire_date($poll->id);
          ?>
              <div class="request-left col-md-6">
                <div class="request-left">
                  <div class="request-left-title">
                    <h4><?php echo $poll->question; ?></h4>
                  </div>
                  <div class="request-left-radio">
                    <?php
                    if($poll->state == 1){
                      $poll_state = 1;
                    } elseif($poll->state == 2){
                      $poll_state = 2;
                    }

                    if($_COOKIE['poll_cookie_'.$poll->id] || validate_user($poll->id) || $poll_state == 2){
                      $answer_text = true;
                      ?>
                      <fieldset class="voted">
                        <?php get_poll_answers($poll->id, $poll->type, $answer_text, $poll_state);?>
                      </fieldset>
                      <?php
                    } else{
                      $answer_text = false;
                      ?>
                      <form class="poll_form user_vote_poll form-group" method="post" enctype="multipart/form-data">
                        <?php get_poll_answers($poll->id, $poll->type, $answer_text, $poll_state);?>
                        <div class="request-save clearfix">
                          <?php wp_nonce_field('user_poll_vote', 'wp_poll_nonce_'.$poll->id, $answer_text); ?>
                          <input type="hidden" id="_poll_id" value="<?php echo $poll->id; ?>" name="poll_id" />
                          <button id="form_submit" type="submit" value="submit_<?php echo $poll->id; ?>" class="btn btn-success button-confirm">Հաստատել</button>
                        </div>
                      </form>
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div> <?php
          }
          ?>
          <?php poll_pagination($total_count, 4, $limit, '/polls/?pagenum='); ?>
        </div>
      </div>
      <?php
    }
}
function poll_list_generator_shortcode(){
  return poll_list_generator();
}
add_shortcode( 'poll_list_shortcode', 'poll_list_generator_shortcode' );