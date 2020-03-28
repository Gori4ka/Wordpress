<?php

function register_front_single_poll_widget() {
    register_widget('front_single_poll_widget');
}

add_action('widgets_init', 'register_front_single_poll_widget');

class front_single_poll_widget extends WP_Widget {

    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        $this->defaults = array(
        );
        $widget_ops = array(
        );
        $control_ops = array(
        );

        $this->WP_Widget('user-profile', __('Frontpage Single Poll', 'bootstrap-basic'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        global $wpdb;
        extract($args);
        /** Merge with defaults */
        $instance = wp_parse_args((array) $instance, $this->defaults);

        $select_poll = isset($instance['select_poll']) ? (int)$instance['select_poll'] : '';

        if (!$select_poll) {
            $poll = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll WHERE status = %d ORDER BY id DESC', 1));
        }else{
            $poll = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll WHERE status = %d AND id = %d', 1, $select_poll));
        }

        if (!$poll) {
            echo __('Poll not found', 'bootstrap-basic');
            return;
        }
        ?>
        <div class="request-left">
            <div class="request-left-title">
                <h4><?php echo $poll->question; ?></h4>
            </div>
            <div class="request-left-radio">
                <?php
                if ($poll->state == 1) {
                    $poll_state = 1;
                } elseif ($poll->state == 2) {
                    $poll_state = 2;
                }
                if ($_COOKIE['poll_cookie_' . $poll->id] || validate_user($poll->id) || $poll_state == 2) {
                    $answer_text = true;
                    ?>
                    <fieldset class="voted">
                    <?php get_poll_answers($poll->id, $poll->type, $answer_text, $poll_state); ?>
                    </fieldset>
                    <?php
                } else {
                    $answer_text = false;
                    ?>
                    <form class="poll_form user_vote_poll form-group" method="post" enctype="multipart/form-data">
                        <?php get_poll_answers($poll->id, $poll->type, $answer_text); ?>
                        <div class="request-save clearfix">
                        <?php wp_nonce_field('user_poll_vote', 'wp_poll_nonce_' . $poll->id, $answer_text); ?>
                            <input type="hidden" id="_poll_id" value="<?php echo $poll->id; ?>" name="poll_id" />
                            <button id="form_submit" type="submit" value="submit_<?php echo $poll->id; ?>" class="btn btn-success button-confirm">Հաստատել</button>
                        </div>
                    </form>
                    <?php
                }
                ?>
                <div class="bloc-center-save">
                  <a href="/polls" class="btn btn-primary btn-view-all btn-xs">Դիտել բոլորը</a>
                </div>
            </div>
        </div>

        <?php
    }

    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, $this->defaults);

        $poll_row = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'poll WHERE status = %d ORDER BY id DESC', 1));
        ?>
        <p>
            <label for="select_poll">Select poll</label>
            <select id="<?php echo $this->get_field_id('select_poll'); ?>" name="<?php echo $this->get_field_name('select_poll'); ?>" class="select_poll" style="width:100%;">
              <option class="poll_options"  value="0">Latest poll</option>
                <?php
                foreach ($poll_row as $poll) {
                    $selected = '';
                    if (isset($instance['select_poll']) && $instance['select_poll'] == $poll->id) {
                        $selected = 'selected';
                    }
                    ?>
                    <option class="poll_options" <?php echo $selected; ?> value="<?php echo $poll->id; ?>"><?php echo $poll->question; ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $new_instance['select_poll'] = strip_tags($new_instance['select_poll']);
        return $new_instance;
    }

}

function poll_widgets_init() {

    register_sidebar(array(
        'name' => __('Frontpage polls'),
        'id' => 'front_polls'
    ));

    register_sidebar(array(
        'name' => __('Poll list'),
        'id' => 'poll_list'
    ));

    register_widget('poll_list_widget');
}

add_action('widgets_init', 'poll_widgets_init');

class poll_list_widget extends WP_Widget {

    public function __construct() {
        parent:: __construct(false, __('Poll list'));
    }

    public function widget($args, $instance) {
        $count = $instance['count'];
        poll_list_generator($count);
    }

    public function form($instance) {
        $defaults = array();
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count:', "bootstrap-basic"); ?></label>
            <input id="" type="number" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" style="width:100%;" /></p>
        <?php
    }

}
