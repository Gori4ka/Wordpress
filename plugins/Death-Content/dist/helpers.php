<?php

class Helper {

    public static function check_allowed_mimetypes($mime) {
        $allowed_image_types = array('image/jpeg', 'image/png', 'image/bmp');
        if (in_array($mime, $allowed_image_types)) {
            return true;
        }
        return false;
    }

    public static function gat_language($get) {
        if (!$get) {
            $language = CasesLanguage::hy;
        } else {
            $language = $get;
        }
        return $language;
    }

    public static function redirect_to_cases_main_page() {
        echo "<script type='text/javascript'>window.location.href='/wp-admin/admin.php?page=cases_cpanel'</script>";
        exit;
    }

    public static function redirect_to_cases_edit_page($cases_id) {
        echo "<script type='text/javascript'>window.location.href='/wp-admin/admin.php?page=cases_edit&id=$cases_id'</script>";
        exit;
    }

    public static function redirect_to_cases_unit_page() {
        echo "<script type='text/javascript'>window.location.href='/wp-admin/admin.php?page=unit_list'</script>";
        exit;
    }

    public static function get_country_list($language) {
        global $wpdb;
        $countryList = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases_country as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s', array($language, "country")));
        return $countryList;
    }

    public static function get_region_list($language) {
        global $wpdb;
        $regionList = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases_region as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s', array($language, "region")));
        return $regionList;
    }

    public static function get_unit_list($language) {
        global $wpdb;
        $UnitList = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases_unit as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s', array($language, "unit")));
        return $UnitList;
    }

    public static function get_capitan_rank_list($language) {
        global $wpdb;
        $rankList = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases_capitan_rank as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s', array($language, "rank")));
        return $rankList;
    }

    public static function get_reason_list($language) {
        global $wpdb;
        $reasonList = $wpdb->get_results($wpdb->prepare('SELECT c.* FROM ' . $wpdb->prefix . 'cases_reason as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND t.type = %s', array($language, "reason")));
        return $reasonList;
    }

    public static function return_translate_id_by_base_id($base_id, $lang, $type) {
        global $wpdb;
        if (!$base_id) {
            return;
        }
        $trans_id = $wpdb->get_var($wpdb->prepare('SELECT id_trans FROM ' . $wpdb->prefix . 'cases_translate WHERE id_base=%d  AND lang=%s AND type=%s', array($base_id, $lang, $type)));
        if ($trans_id) {

            return $trans_id;
        }
    }

    public static function media_library($id_base) {
        global $wpdb;
        $result = $wpdb->get_results($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'cases_media WHERE cases_id = %d', $id_base));
        return $result;
    }

    public static function print_list_of_cases($array, $offset) {
        global $wpdb;
        foreach ($array as $key => $res) {
            $i = $key + 1 + $offset;
            echo '<tr>';
            echo '<td>' . $i . '</td>';
            echo '<td>' . $res->frst_name . ' ' . ' ' . $res->last_name . '</td>';
            echo '<td>';
            echo $res->cases_type == 1 ? 'Incident' : 'Death';
            echo '</td>';
            echo '<td>' . $res->date . '</td>';
            if ($res->content_add == 1) {
                ?>
                <td><span class="dashicons dashicons-groups"></span></span></td>
                <?php
            } else {
                ?>
                <td><span class="dashicons dashicons-admin-users"></span></td>
                <?php
            }
            ?>
            <td>
                <a class="" href="/wp-admin/admin.php?page=cases_edit&id=<?php echo $res->id; ?>">
                    <span class="dashicons dashicons-edit"></span></a>
            </td>
            <?php
            $trans = $wpdb->get_var($wpdb->prepare('SELECT id_trans FROM ' . $wpdb->prefix . 'cases_translate WHERE id_base = %d AND lang = "en" AND type = "cases"', array($res->id)));

            if ($trans) {
                ?>
                <td>
                    <a href="/wp-admin/admin.php?page=cases_edit&id=<?php echo $trans; ?>&id_base=<?php echo $res->id; ?>&lang=en">
                        <span class="dashicons dashicons-edit"></span>
                    </a>
                </td>
                <?php
            } else {
                ?>
                <td><a href="/wp-admin/admin.php?page=manage_cases&id_base=<?php echo $res->id; ?>&lang=en">
                        <span class="dashicons dashicons-plus"></span>
                    </a>
                </td>
                <?php
            }
            ?>
            <td><span class="dashicons dashicons-<?php echo $res->status == 1 ? 'yes' : 'no'; ?>"></span></td>
            <td>
                <a class="delete" href="<?php echo wp_nonce_url('/wp-admin/admin.php?page=cases_delete&id=' . $res->id, 'delete_nonce') ?>">
                    <span class="dashicons dashicons-trash"></span>
                </a>
            </td>
            </tr>
            <?php
        }
    }

    public static function cases_list($array, $offset, $limit, $cases_type, $url) {
        global $wpdb;
        ?>
        <div class="wrap">
            <h1>Cases <a href="/wp-admin/admin.php?page=manage_cases" class="page-title-action">Add New Cases</a></h1>

            <table class="wp-list-table widefat fixed striped posts">
                <thead>
                    <tr>
                        <th width="6%">N</th>
                        <th width="25%">Անուն Ազգանուն</th>
                        <th >Cases</th>
                        <th >Ամսաթիվ</th>
                        <th width="10%">Հեղինակ	</th>
                        <th width="7%">
                            <img src="<?php echo plugins_url('../image/hy.png', __FILE__); ?>" >
                        </th>
                        <th width="7%">
                            <img src="<?php echo plugins_url('../image/en.png', __FILE__); ?>">
                        </th>
                        <th width="14%">Հրապարակված</th>
                        <th width="7%">Ջնջել</th>
                    </tr>
                </thead>

                <tbody id="the-list">
                    <?php Helper::print_list_of_cases($array, $offset); ?>
                </tbody>
            </table>
        </div>
        <?php
        if($cases_type !== null){
          $total_count = $wpdb->get_var('SELECT count(*) FROM ' . $wpdb->prefix . 'cases as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id where t.lang="hy" AND t.type="cases" AND c.cases_type='.$cases_type);

          Helper::cases_paginator($total_count, 4, $limit, '/wp-admin/admin.php?page='.$url.'&pagenum=');
        }
    }

    public static function template_page($result, $language) {
        ?>
        <fieldset class="form-group">
            <label for="">Cases</label>
            <select  class="form-control" name="cases_type" >
                <?php if ($result->cases_type == CasesType::DEATH) { ?>
                    <option value="<?php echo CasesType::DEATH; ?>" selected><?php _e('Death', 'cases'); ?></option>
                    <option value="<?php echo CasesType::INCIDENT; ?>" ><?php _e('Incident', 'cases'); ?></option>
                <?php } else {
                    ?>
                    <option value="<?php echo CasesType::INCIDENT; ?>" selected><?php _e('Incident', 'cases'); ?></option>
                    <option value="<?php echo CasesType::DEATH; ?>"><?php _e('Death', 'cases'); ?></option>
                <?php } ?>
            </select>
        </fieldset>

        <fieldset class="form-group">
            <label for=""><?php _e('First Name', 'cases'); ?></label>
            <input type="text" value="<?php echo $result->frst_name ?>" required  class="form-control" name="frst_name" placeholder="<?php _e('First Name', 'cases'); ?>">
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Last Name', 'cases'); ?></label>
            <input type="text" value="<?php echo $result->last_name ?>" required class="form-control" name="last_name" placeholder="<?php _e('Last Name', 'cases'); ?>">
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Date', 'cases'); ?></label>
            <div class="input-group date datepicker">
                <input type="text" required class="form-control " name="date" value = "<?php echo $result->date ?>" placeholder="<?php _e('Date', 'cases'); ?>">
                <span class="input-group-addon">
                    <span class="dashicons dashicons-calendar-alt"></span>
                </span>
            </div>
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Place', 'cases'); ?></label>
            <select id="countryList" class="form-control" name="country_id">
                <option value="" selected disabled hidden ><?php _e('Place', 'cases'); ?></option>
                <?php
                $countryList = Helper::get_country_list($language);
                $selected_country_id = Helper::return_translate_id_by_base_id($result->country_id, $language, 'country');
                if (isset($_GET['id']) && (int) $_GET['id']) {
                    $selected_country_id = $result->country_id;
                }
                if ($countryList) {
                    foreach ($countryList as $country) {
                        $selected = '';

                        if ($selected_country_id && $selected_country_id == $country->id) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $country->id . '" ' . $selected . '>' . $country->name . '</option>';
                    }
                }
                ?>
            </select>
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Region', 'cases'); ?></label>
            <select  class="form-control" id="regionList" name="region_id">
                <option value="" selected disabled hidden><?php _e('Region', 'cases'); ?></option>
                <?php
                $RegionList = Helper::get_region_list($language);
                $selected_region_id = Helper::return_translate_id_by_base_id($result->region_id, $language, 'region');
                if (isset($_GET['id']) && (int) $_GET['id']) {
                    $selected_region_id = $result->region_id;
                }
                if ($RegionList) {
                    foreach ($RegionList as $region) {
                        $selected = '';
                        if ($selected_region_id && $selected_region_id == $region->id) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $region->id . '" class= "country_' . $region->country_id . '" ' . $selected . '>' . $region->name . '</option>';
                    }
                }
                ?>
            </select>
        </fieldset>

        <fieldset class="form-group">
            <label for=""><?php _e('Unit', 'cases'); ?></label>
            <div class="input-group">
                <select  class="form-control" id="unitList" name="unit_id">
                    <option value="" selected disabled hidden><?php _e('Unit', 'cases'); ?></option>
                    <?php
                    $UnitList = Helper::get_unit_list($language);
                    $selected_unit_id = Helper::return_translate_id_by_base_id($result->unit_id, $language, 'unit');
                    if (isset($_GET['id']) && (int) $_GET['id']) {
                        $selected_unit_id = $result->unit_id;
                    }
                    if ($UnitList) {
                        foreach ($UnitList as $unit) {
                            $selected = '';
                            if ($selected_unit_id && $selected_unit_id == $unit->id) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $unit->id . '" class= "region_' . $unit->region_id . '" ' . $selected . '>' . $unit->name . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <label for=""><?php _e('Capitan', 'cases'); ?></label>
            <input type="text" value="<?php echo $result->capitan ?>"  class="form-control" name="capitan" placeholder="<?php _e('capitan', 'cases'); ?>">
        </fieldset>

        <fieldset class="form-group">
            <label for=""><?php _e('Rank', 'cases'); ?></label>
            <select  class="form-control" id="rankList" name="capitan_rank_id">
                <option value="" selected disabled hidden><?php _e('Rank', 'cases'); ?></option>
                <?php
                $rankList = Helper::get_capitan_rank_list($language);
                $selected_rank_id = Helper::return_translate_id_by_base_id($result->capitan_rank_id, $language, 'rank');
                if (isset($_GET['id']) && (int) $_GET['id']) {
                    $selected_rank_id = $result->capitan_rank_id;
                }
                if ($rankList) {
                    foreach ($rankList as $rank) {
                        $selected = '';
                        if ($selected_rank_id && $selected_rank_id == $rank->id) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $rank->id . '"  ' . $selected . '>' . $rank->name . '</option>';
                    }
                }
                ?>
            </select>
        </fieldset>

        <fieldset class="form-group">
            <label for=""><?php _e('Reason', 'cases'); ?></label>
            <select  class="form-control" id="reasonList" name="reason_id">
                <option value="" selected disabled hidden><?php _e('Reason', 'cases'); ?></option>
                <?php
                $reasonList = Helper::get_reason_list($language);
                $selected_reason_id = Helper::return_translate_id_by_base_id($result->reason_id, $language, 'reason');
                if (isset($_GET['id']) && (int) $_GET['id']) {
                    $selected_reason_id = $result->reason_id;
                }
                if ($reasonList) {
                    foreach ($reasonList as $reason) {
                        $selected = '';
                        if ($selected_reason_id && $selected_reason_id == $reason->id) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $reason->id . '"  ' . $selected . '>' . $reason->name . '</option>';
                    }
                }
                ?>
            </select>
        </fieldset>



        <?php if ($result->reason_id == 8) { ?>
            <fieldset id="reasontext" class="form-group">
                <label for="" >Reason text</label>
                <textarea class="form-control" rows="2" name="reason_text" ><?php echo $result->reason_text; ?></textarea>
            </fieldset>
        <?php } else { ?>
            <fieldset id = "reasontext" class="form-group"  style="display:none">
                <label for="" >Reason text</label>
                <textarea name = "reason_text" class="form-control" rows="2"></textarea>
            </fieldset>
        <?php } ?>
        <div class="input_content_editor">
            <?php
            wp_editor($result->content, 'content', array('media_buttons' => false));
            ?>
        </div>
        <div class="form-group card ">
            <h4 class="card-title"><?php _e('status', 'cases'); ?></h4>
            <?php if ($result->content_type == 1) { ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="content_type"  value="1" checked>
                        <?php _e('verified', 'cases'); ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="content_type"  value="false">
                        <?php _e('unverified', 'cases'); ?>
                    </label>
                </div>
            <?php } else {
                ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="content_type"  value="1">
                        <?php _e('verified', 'cases'); ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="content_type"  value="false" checked>
                        <?php _e('unverified', 'cases'); ?>
                    </label>
                </div>
            <?php } ?>
        </div>
        <div class="form-group card ">
            <h4 class="card-title"><?php _e('visibility', 'cases'); ?></h4>
            <?php if ($result->status == 1) { ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="status"  value="1" checked>
                        <?php _e('public', 'cases'); ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="status"  value="false">
                        <?php _e('no public', 'cases'); ?>
                    </label>
                </div>
            <?php } else {
                ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="status"  value="1" >
                        <?php _e('public', 'cases'); ?>
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="status"  value="false" checked>
                        <?php _e('no public', 'cases'); ?>
                    </label>
                </div>
            <?php }
            ?>
        </div>
        <fieldset class="form-group">
            <label for=""><?php _e('Providers_name', 'cases'); ?></label>
            <input type="text" value="<?php echo $result->Providers_name ?>"  class="form-control" name="Providers_name" placeholder="<?php _e('Providers_name', 'cases'); ?>">
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Providers_last_name', 'cases'); ?></label>
            <input type="text" value="<?php echo $result->Providers_last_name ?>"  class="form-control" name="Providers_last_name" placeholder="<?php _e('Providers_last_name', 'cases'); ?>">
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Providers_phone', 'cases'); ?></label>
            <input type="text" value="<?php echo $result->Providers_phone ?>" class="form-control" name=" Providers_phone" placeholder="<?php _e('Providers_phone', 'cases'); ?>">
        </fieldset>
        <fieldset class="form-group">
            <label for=""><?php _e('Providers_email', 'cases'); ?></label>
            <input type="email" value="<?php echo $result->Providers_email; ?>" class="form-control" name="Providers_email" placeholder="<?php _e('Providers_email', 'cases'); ?>">
        </fieldset>

        <fieldset class="form-group">
            <?php
            $upload_link = esc_url(get_upload_iframe_src('image', 1));
            if (isset($_GET['id_base']) && (int) $_GET['id_base']) {
                $cases_id = (int) $_GET['id_base'];
            } elseif (isset($_GET['id']) && (int) $_GET['id']) {
                $cases_id = (int) $_GET['id'];
            }

            $featured_image_id = '';
            $image_lists = Helper::media_library($cases_id);
            $media_ids = array();
            if ($image_lists) {
                foreach ($image_lists as $image) {
                    if ($image->is_featured == 1) {
                        $featured_image_id = $image->media_id;
                    }
                    array_push($media_ids, $image->media_id);
                }
            }
            ?>
            <div id="meta-box-id" class="postbox medialaybri">
                <p class="hide-if-no-js">
                    <a class="upload-custom-img btn btn-info <?php ?>"
                       href="<?php echo $upload_link ?>">
                           <?php
                           _e('Upload image');
                           ?>
                    </a>
                </p>

                <input class="custom-img-id" name="media_id" type="hidden" value="" />
                <input class="featured_id" name="featured_id" type="hidden" value="<?php echo $featured_image_id; ?>" />
                <input class="media_id_lists media_id_lists_val" name="media_ids" type="hidden" value="<?php echo implode(",", $media_ids) ?>" />
            </div>
            <div class="featured-img">
                <?php if ($featured_image_id) : ?>
                    <img class="featured-image" src="<?php echo wp_get_attachment_url($featured_image_id, 'thumbnail'); ?>" alt="" style="max-width:100%;" />
                <?php endif; ?>
            </div>
            <div class="image-lists">
                <?php
                if ($image_lists) {
                    foreach ($image_lists as $image) {
                        ?>
                        <div class="single-image">
                            <div class="image-area clearfix">
                                <img src="<?php echo wp_get_attachment_url($image->media_id, 'thumbnail'); ?>" alt="" style="max-width:100%;" />
                            </div>
                            <div class="image-btn">
                                <span class="dashicons dashicons-trash delete_image" data-image-id="<?php echo $image->media_id ?>"></span>
                                <span class="dashicons dashicons-visibility set_featured_image " data-image-url="<?php echo wp_get_attachment_url($image->media_id, 'thumbnail'); ?>" data-image-id="<?php echo $image->media_id ?>"></span>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </fieldset>
        <?php
    }

    public static function cases_paginator($total, $showPags, $post_per_page, $url) {
        $num_of_pages = ceil($total / $post_per_page);
        $curren_page = (int) $_GET['pagenum'];
        if ($num_of_pages > 1) {
            ?>
            <nav>
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="<?php if ($curren_page - 1 > 0) echo add_query_arg(array('pagenum' => $curren_page - 1),$url); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php
                    if ($curren_page == 1) {
                        $active_class = 'active';
                    }
                    $display_none = '';
                    $display = '';
                    if ($curren_page <= $showPags) {
                        $display_none = 'style = "display:none "';
                    }
                    if ($num_of_pages - $showPags < $curren_page) {
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
                        if ($i > $curren_page - $showPags && $i < $curren_page + $showPags) {
                            $active_class = '';
                            if ($curren_page == $i) {
                                $active_class = ' active';
                            }
                            ?>
                            <li class="page-item  <?php echo $active_class; ?>">
                                <a class="page-link" href="<?php echo add_query_arg(array('pagenum' => $i), $url); ?>"><?php echo $i; ?></a>
                            </li>
                            <?php
                        }
                    }
                    if ($num_of_pages > $showPags) {
                        ?>
                        <li class="page-item" <?php echo $display; ?>>
                            <span class="page-link page-point">...</span>
                        </li>
                        <?php
                    }
                    if ($curren_page == $num_of_pages) {
                        $active = ' active';
                    }
                    ?>
                    <li class="page-item <?php echo $active; ?>">
                        <a class="page-link" href="<?php echo add_query_arg(array('pagenum' => $num_of_pages), $url); ?>"><?php echo $num_of_pages; ?></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="<?php if ($curren_page + 1 <= $num_of_pages) echo add_query_arg(array('pagenum' => $curren_page + 1), $url); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php
        }
    }

    public static function get_frontend_add_incident_forem($type, $lang) {
        ?>
        <div class="add_incident">
            <h1><?php _e('Add a fatality case recorded in the RA armed forces after 1994', 'safesoldiers'); ?></h1>
            <div class="form-wrapper">
                <div class="holder">
                    <div class="img-cont">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/logo.png" alt="Safe soldiers" />
                    </div>
                    <form role="form" method="post" id="frontend-add-incident"  enctype="multipart/form-data" action="/wp-admin/admin-ajax.php"  class="incident-form form">
                        <div class="form-first">
                            <div class="form-group name-details">
                                <input type="hidden" name="cases" value="<?php echo $type; ?>">
                                <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                                <input type="text" name="name" class="form-control" id="name" placeholder="<?php _e('Name', 'safesoldiers') ?>" required>
                                <input type="text" name="surname" class="form-control" id="surname" placeholder="<?php _e('Surname', 'safesoldiers') ?>" required>
                                <div class='input-group date date-wrapper' id='datetimepicker3'>
                                    <input type='taxt'  class="form-control" name="date" id="datetimeinput1" placeholder="<?php _e('Date', 'safesoldiers') ?>" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                            <select name="filter_location" class="selectpicker" id="countryList">
                                <option value=""><?php _e('Location', 'safesoldiers'); ?></option>
                                <?php
                                $countryList = Helper::get_country_list($lang);
                                if ($countryList) {
                                    foreach ($countryList as $country) {
                                        echo '<option value="' . $country->id . '">' . $country->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <select name="filter_region" class="selectpicker" id="regionList">
                                <option value=""><?php _e('Region', 'safesoldiers'); ?></option>
                                <?php
                                $RegionList = Helper::get_region_list($lang);
                                if ($RegionList) {
                                    foreach ($RegionList as $region) {
                                        echo '<option value="' . $region->id . '" class= "country_' . $region->country_id . '">' . $region->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <div class="form-group officer-details">
                                <input type="text" name="unit" class="form-control" id="unit" placeholder="<?php _e('Unit', 'safesoldiers') ?>">
                                <input type="text" name="officer" class="form-control" id="officer" placeholder="<?php _e('Officer', 'safesoldiers') ?>">
                            </div>
                            <select name="officer_status" class="selectpicker" id="rankList">
                                <option value=""><?php _e('Officers status', 'safesoldiers'); ?></option>
                                <?php
                                $rankList = Helper::get_capitan_rank_list($lang);
                                if ($rankList) {
                                    foreach ($rankList as $rank) {
                                        echo '<option value="' . $rank->id . '"  ' . $selected . '>' . $rank->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <select name="death_reason" class="selectpicker">
                                <option value=""><?php _e('Reason', 'safesoldiers'); ?></option>
                                <?php
                                $reasonList = Helper::get_reason_list($lang);
                                if ($reasonList) {
                                    foreach ($reasonList as $reason) {
                                        echo '<option value="' . $reason->id . '"  ' . $selected . '>' . $reason->name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-second">
                            <label for="details" class="details-label"><?php _e('Details', 'safesoldiers'); ?></label>
                            <textarea rows="1" cols="40" id="details" class="details" name="details"></textarea>
                            <p class="form-info">
                                <?php _e('The information of the applicant will not be published, it is only for our records so that we can keep in touch.', 'safesoldiers'); ?>
                            </p>
                            <div class="form-group officer-details">
                                <input type="text" name="applicant_name" class="form-control" id="aplicants_name" placeholder="<?php _e('Applicants name', 'safesoldiers') ?>">
                                <input type="text" name="applicant_surname" class="form-control" id="aplicants_surname" placeholder="<?php _e('Applicants surname', 'safesoldiers') ?>">
                                <input type="text" name="applicant_phone" class="form-control" id="aplicants_phone" placeholder="<?php _e('Applicants phone', 'safesoldiers') ?>">
                                <input type="email" name="applicant_email" class="form-control" id="aplicants_email" placeholder="<?php _e('Applicants email', 'safesoldiers') ?>">
                                <div class="image-up">
                                    <label for="upload"><?php _e('Add media', 'safesoldiers') ?></label>
                                    <input type="file" name="pic" accept="image/*" id="upload">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="save_incident_content">
                        <input type="hidden" name="security" value="<?php echo wp_create_nonce("frontend_ajax_security"); ?>">
                        <div class="g-recaptcha" data-sitekey="6Le-MyUTAAAAANYfBm3jHMfxco5Dhl-98x8ObHX_"></div>
                        <div class="input-group-btn">
                            <button type="submit" id="save_and_submit" class="btn btn-default"><?php _e('Save and submit', 'safesoldiers'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }


    public static function get_frontend_search() {
        global $wpdb;
        $filter = '';
        $args = array();
        if (isset($_POST['filter_deats']) && (int) $_POST['filter_deats'] != 0) {
            $filter.= ' AND cases_type = %d ';
            if ((int) $_POST['filter_deats'] == 1) {
                array_push($args, 1);
            } elseif((int) $_POST['filter_deats'] == 2) {
                array_push($args, 0);
            }
        }else{
          $filter.= ' AND cases_type = %d ';
          array_push($args, 0);
        }


        // if (isset($_POST['first_name']) && $_POST['first_name'] != '') {
        //     $filter.= ' AND frst_name LIKE %s ';
        //     array_push($args, '%' . $_POST['first_name'] . '%');
        // }
        // if (isset($_POST['last_surname']) && $_POST['last_surname'] != '') {
        //     $filter.= ' AND last_name LIKE %s ';
        //     array_push($args, '%' . $_POST['last_surname'] . '%');
        // }
        // if (isset($_POST['date_start']) && $_POST['date_start'] != '') {
        //     $filter.= ' AND date >=  "%s" ';
        //     array_push($args, $_POST['date_start']);
        // }
        // if (isset($_POST['date_end']) && $_POST['date_end'] != '') {
        //     $filter.= ' AND date <=  "%s" ';
        //     array_push($args, $_POST['date_end']);
        // }
        if (isset($_POST['date']) && strlen($_POST['date']) > 5) {
            $arr = explode(" ", $_POST['date']);
            foreach ($arr as $year) {
                $filter .= ' AND YEAR(c.date) IN (' . $year . ') ';
            }
        } elseif (isset($_POST['date']) && $_POST['date'] != '' && $_POST['date'] != 'NaN') {
            $filter .= ' AND YEAR(date) = "%s" ';
            array_push($args, $_POST['date']);
        }

        if (isset($_POST['country']) && (int) $_POST['country'] != 0) {
            $filter.= ' AND country_id = %d ';
            array_push($args, (int) $_POST['country']);
        }

        if (isset($_POST['region']) && (int) $_POST['region'] != 0) {
            $filter.= ' AND region_id =  %d ';
            array_push($args, (int) $_POST['region']);
        }
        if (isset($_POST['reason']) && (int) $_POST['reason'] != 0) {
            $filter.= ' AND reason_id = %d ';
            array_push($args, (int) $_POST['reason']);
        }

        array_unshift($args, ICL_LANGUAGE_CODE, 'cases');
        $cases_list = $wpdb->get_results($wpdb->prepare('SELECT c.id, c.last_name, c.frst_name FROM ' . $wpdb->prefix . 'cases as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id '
                        . ' WHERE t.lang= %s AND t.type = %s AND c.status=1 ' . $filter . ' ORDER BY c.id DESC', $args));
        $result = array();
        if ($cases_list) {
            foreach ($cases_list as $cases) {
                $result[] = array(
                    'id' => $cases->id,
                    'last_name' => $cases->last_name,
                    'first_name' => $cases->frst_name,
                    'image_url' => Helper::get_media_by_cases_id($cases->id),
                    'url' => get_page_cases_url($cases->id)
                );
            }
        }
        if ($result) {
            wp_send_json(array('status' => 'ok', 'data' => $result));
        } else {
            wp_send_json(array('status' => 'error', 'message' => 'not found', 'data' => $result));
        }
    }

    public static function return_fronted_region_name($language, $region_id) {
        global $wpdb;
        $region_mame = $wpdb->get_var($wpdb->prepare('SELECT c.name FROM ' . $wpdb->prefix . 'cases_region as c'
                        . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as t ON t.id_trans = c.id  where t.lang= %s AND c.id = %d AND t.type = %s ', array($language, $region_id, "region")));
        return $region_mame;
    }

    public static function get_media_by_cases_id($cases_id) {
        $image_lists = Helper::media_library($cases_id);
        if ($image_lists) {
            foreach ($image_lists as $image) {
                if ($image->is_featured == 1) {
                    $image_path = wp_get_attachment_url($image->media_id, 'thumbnail');
                    return $image_path;
                }
            }
        } else {
            return get_bloginfo('template_url') . '/img/no-photo.jpg';
        }
    }

}
