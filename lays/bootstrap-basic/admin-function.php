<?php
add_action('admin_menu', 'peyotto_admin_plugin_setup_menu');

function peyotto_admin_plugin_setup_menu() {
    add_menu_page('Admin option page', 'Admin options', 'manage_options', 'voting_admin', 'peyotto_admin_init');
}

function peyotto_admin_init() {

    if ($_POST['set_acrive_competition']) {
        update_option('active_voting', (int) $_POST['set_acrive_competition'], false);
    }
    $active = get_option('active_voting');
    ?>
    <h1>Set Active Competition</h1>
    <form method="post" action="" novalidate="novalidate">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="default_role">Set Active Competition</label></th>
                    <td>
                        <select name="set_acrive_competition" id="default_role">
                            <?php
                            $terms = get_terms(array(
                                'taxonomy' => 'competition',
                                'hide_empty' => false,
                            ));
                            echo '<option value="0">Select Item</option>';
                            if ($terms) {
                                foreach ($terms as $term) {
                                    if ($active == $term->term_id) {
                                        echo '<option selected="selected" value="' . $term->term_id . '">' . $term->name . '</option>';
                                    } else {
                                        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
                                    }
                                }
                            }
                            ?>                          
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
    <?php
}

add_action('admin_menu', 'peyotto_vote_list_plugin_setup_menu');

function peyotto_vote_list_plugin_setup_menu() {
    add_menu_page('Vote page', 'Vote', 'manage_options', 'voting_list_admin', 'peyotto_vote_admin_init');
}

function peyotto_vote_admin_init() {
    $regKey = md5(time());
    update_option('download_voting', $regKey, false);
    if (!$_GET['current']) {
        $terms = get_terms(array(
            'taxonomy' => 'competition',
            'hide_empty' => false,
        ));
        if ($terms) {
            echo '<h1>Competition List<h1>';
            foreach ($terms as $term) {
                echo '<a href="/wp-admin/admin.php?page=voting_list_admin&current=' . $term->term_id . '">' . $term->name . '</a>';
            }
        }
    } else {

        echo '<h1>Competition Members<h1>';
        echo '<a href="/dwnl.php?current=' . (int) $_GET['current'] . '&dwn=' . $regKey . '" > Export </a>'
        ?>

        <table class="wp-list-table widefat fixed striped posts">
            <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">#</td>
                    <th scope="col" class="column-author">Vote</th>
                    <th scope="col" id="title" class="manage-column column-title column-primary  ">User</th>
                    <th scope="col" id="author" class="manage-column column-author">Contact</th>
                   
                </tr>
            </thead>

            <tbody id="the-list">
                <?php
                $items = get_members_list((int) $_GET['current']);
                $i = 1;
                if ($items) {

                    foreach ($items as $item) {
                        ?>
                        <tr id="post-1" class="iedit author-self level-0 post-1 type-post status-publish format-standard hentry category-uncategorized">
                            <th scope="row" class="check-column"><?php echo $i++; ?>
                            </th>
                            <td class="column-author" data-colname="Title">
                                <strong><?php echo $item->cnt ?></strong>
                            </td>
                            <td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
                                <strong><a href="<?php echo get_permalink($item->id) ?>" target="_blank"><?php echo get_the_title($item->id) ?></a></strong>
                            </td>
                            <td class="author column-author" data-colname="Author">
                                <?php get_contect_link($item->id); ?>                              
                            </td>
                            
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
        <?php
    }
}

function get_contect_link_excel($id) {
    $post_item = get_post($id);
    if ($post_item) {
        $user_info = get_userdata($post_item->post_author);
        if ($user_info->user_url != '') {

            return $user_info->user_url;
        } else {
            return get_the_author_meta('description', $post_item->post_author);
        }
    }else{
        return 'not set';
    }
}

function get_contect_link($id) {
    $post_item = get_post($id);
    if ($post_item) {
        $user_info = get_userdata($post_item->post_author);

        if ($user_info->user_url != '') {
            ?>
            <a href="<?php echo $user_info->user_url; ?>" target="_blank">Fb</a>
            <?php
        } else {
            echo get_the_author_meta('description', $post_item->post_author);
        }
        ?>
        <?php
    }
}

function get_members_list($termId) {
    global $wpdb;

    $result = $wpdb->get_results('select wtr.object_id as id, count(wp.object_id) as cnt 
from wp_term_relationships as wtr
INNER JOIN wp_posts as p ON p.ID = wtr.object_id and p.post_status = "publish"
LEFT JOIN wp_vote as wp on wp.object_id = wtr.object_id
where wtr.term_taxonomy_id=' . $termId . ' 
group by wtr.object_id  order by cnt  desc limit 1000');
    return $result;
}
