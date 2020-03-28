<?php

function get_infograph_title($type) {
    if (ICL_LANGUAGE_CODE == 'hy' && $type == 'title') {
        return '<span id="infograph_date">' . date(Y) . '</span>';
    } else if (ICL_LANGUAGE_CODE == 'en' && $type == 'subtitle') {
        return '<span id="infograph_date">' . date(Y) . '</span>';
    }
}

function get_infograph() {
    $lang = ICL_LANGUAGE_CODE;
    $ceasfire_violations_id = Helper::return_translate_id_by_base_id(1, $lang, 'reason');
    $murders_id = Helper::return_translate_id_by_base_id(5, $lang, 'reason');
    $inaction_id = Helper::return_translate_id_by_base_id(6, $lang, 'reason');
    $fatal_incident_id = Helper::return_translate_id_by_base_id(7, $lang, 'reason');
    $sudden_fatality_id = Helper::return_translate_id_by_base_id(3, $lang, 'reason');
    $suicide_id = Helper::return_translate_id_by_base_id(2, $lang, 'reason');
    $health_issues_id = Helper::return_translate_id_by_base_id(4, $lang, 'reason');
    ?>
    <div class="infograph unselectable">
        <div class="infograph-block">
            <div class="heading">
                <p class="title1"><?php printf(__('%1$s the number of fatalities in the', 'safesoldiers'), get_infograph_title('title')); ?></p>
                <p class="title2">



                    <?php _e('ra', 'safesoldiers') ?> <small><?php _e('and', 'safesoldiers') ?></small> <?php printf(__('nk armed forces for %1$s', 'safesoldiers'), get_infograph_title('subtitle')) ?> </p>
            </div>
            <div id="informer_arrow" class="arrows">
                <div class="arrow-left">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <div class="arrow-right">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </div>
            </div>
            <div class="share">
                <a href="<?php echo get_permalink(INTERACTIVE); ?>"><?php _e('see more interactive', 'safesoldiers') ?></a>
            </div>
            <div class="total-number"><div class="loader">Loading...</div><span class="count"></span></div>
            <div class="armenia">
                <img id="armenia" class="armenia-img" src="<?php echo get_bloginfo('template_url') ?>/img/infograph/armenia.png" alt="">
            </div>
            <div class="karabakh">
                <img id="karabakh" class="armenia-img" src="<?php echo get_bloginfo('template_url') ?>/img/infograph/karabakh.png" alt="">
            </div>
            <div class="year"><span class="count"><?php echo date("Y"); ?></span></div>
            <div class="all-cases">
                <a id="total" class="total"><?php _e('(All period)', 'safesoldiers') ?></a>
            </div>
            <div class="cases">
                <div class="map-loaction-pointer case-armenia country_id_<?php echo Helper::return_translate_id_by_base_id(1, $lang, 'country'); ?>">
                    <span id="armMapNumber" class="armMapNumber country-location" data-country-id="<?php echo Helper::return_translate_id_by_base_id(1, $lang, 'country'); ?>"><span class="count">0</span> <?php _e('Cases', 'safesoldiers') ?></span>
                    <i class="fa fa-circle" aria-hidden="true"></i>
                </div>
                <div class="map-loaction-pointer case-karabakh country_id_<?php echo Helper::return_translate_id_by_base_id(2, $lang, 'country'); ?>">
                    <i class="fa fa-circle" aria-hidden="true"></i>
                    <span id="karMapNumber" class="karMapNumber country-location"  data-country-id="<?php echo Helper::return_translate_id_by_base_id(2, $lang, 'country'); ?>"><span class="count">0</span> <?php _e('Cases', 'safesoldiers') ?></span>
                </div>
                <div class="map-loaction-pointer case-unknown country_id_<?php echo Helper::return_translate_id_by_base_id(3, $lang, 'country'); ?>">
                    <span id="unknown-number" class="unknown-number country-location" data-country-id="<?php echo Helper::return_translate_id_by_base_id(3, $lang, 'country'); ?>"><span class="count">0</span> <?php _e('Cases', 'safesoldiers') ?></span>
                    <i class="fa fa-circle" aria-hidden="true"></i>
                    <p id="unknown-location" class="unkonown-location"><?php _e('unknown location', 'safesoldiers') ?></p>
                </div>
            </div>

            <div class="death-reasons">
                <div class="reason">
                    <span id="number1" class="case1 reason_id_<?php echo $ceasfire_violations_id; ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/ceasfire.png" alt="">
                        <span class="circle" data-reason-id="<?php echo $ceasfire_violations_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('ceasfire violations', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="reason">
                    <span id="number2" class="case2 reason_id_<?php echo $murders_id; ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/murder.png" alt="">
                        <span class="circle"  data-reason-id="<?php echo $murders_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('murders', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="reason">
                    <span id="number3" class="case3 reason_id_<?php echo $inaction_id; ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/inaction.png" alt="">
                        <span class="circle"   data-reason-id="<?php echo $inaction_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('inaction', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="reason">
                    <span id="number4" class="case4 reason_id_<?php echo $fatal_incident_id; ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/fatal_incidents.png" alt="">
                        <span class="circle"  data-reason-id="<?php echo $fatal_incident_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('fatal incident', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="reason">
                    <span id="number5" class="case5 reason_id_<?php echo $sudden_fatality_id; ?>">
                        <div class="img-cont">
                            <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/unknown_reason.png" alt="">
                        </div>
                        <span class="circle"  data-reason-id="<?php echo $sudden_fatality_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('sudden fatality', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="reason">
                    <span id="number6" class="case6 reason_id_<?php echo $suicide_id; ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/suicude.png" alt="">
                        <span class="circle"  data-reason-id="<?php echo $suicide_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('suicide', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="reason">
                    <span id="number7" class="case7 reason_id_<?php echo $health_issues_id; ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/infograph/health_issues.png" alt="">
                        <span class="circle"  data-reason-id="<?php echo $health_issues_id; ?>">0</span>
                        <p id="text" class="text"><?php _e('health issues', 'safesoldiers') ?></p>
                    </span>
                </div>
                <div class="percents">
                    <span class="percent1 reason_prcent_<?php echo $ceasfire_violations_id; ?>"></span>
                    <span class="percent2 reason_prcent_<?php echo $murders_id; ?>"></span>
                    <span class="percent3 reason_prcent_<?php echo $inaction_id; ?>"></span>
                    <span class="percent4 reason_prcent_<?php echo $fatal_incident_id; ?>"></span>
                    <span class="percent5 reason_prcent_<?php echo $sudden_fatality_id; ?>"></span>
                    <span class="percent6 reason_prcent_<?php echo $suicide_id; ?>"></span>
                    <span class="percent7 reason_prcent_<?php echo $health_issues_id; ?>"></span>
                    <table>
                        <tbody>
                            <tr>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                                <td>.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="description">
            <i class="fa fa-caret-up" aria-hidden="true"></i>
            <p>
                <?php _e('Please note that this interactive infographic reflects data uploaded to this website and should not be considered a comprehensive assessment of all fatalities in the Armenian military. In the image you can see the recorded data of fatal incidents in the Armed Forces by reasons, years and locations. After changing the year, the relevant data recorded for selected year will appear in the graphic. Moreover, after clicking the red circles showing the number of incidents by the particular reason or the location, a new window will appear with profiles of soldiers died by the selcted reason in the selected period of time.', 'safesoldiers') ?>

            </p>
            <a href="<?php echo get_permalink(HOWTOUSE); ?>"><?php _e('HOW TO USE THE WEBSITE', 'safesoldiers') ?></a>
        </div>

        <div class="hidden">
            <input type="hidden" id="infograph_ajax_date" value="2016">
            <input type="hidden" id="infograph_ajax_country" value="">
            <input type="hidden" id="infograph_ajax_region" value="">
            <input type="hidden" id="infograph_ajax_type" value="-1">
            <input type="hidden" id="infograph_ajax_lang" value="<?php echo $lang; ?>">
            <input type="hidden" id="infograph_ajax_security" value="<?php echo wp_create_nonce("infographSecurity"); ?>">

        </div>
    </div>
    <?php
}

add_action('wp_ajax_get_cases_infograph_ajax', 'get_cases_infograph_ajax');
add_action('wp_ajax_nopriv_get_cases_infograph_ajax', 'get_cases_infograph_ajax');

function get_cases_infograph_ajax() {
    check_ajax_referer('infographSecurity', 'security');
    $params = array(
        'date' => $_POST['date'],
        'type' => (int) $_POST['type'],
        'country_id' => (int) $_POST['country'],
        'region_id' => (int) $_POST['region'],
        'lang' => $_POST['lang'],
        'reason' => isset($_POST['reason']) ? (int) $_POST['reason'] : null
    );
    $result = get_infograph_result($params);
}

function get_infograph_result($params) {
    global $wpdb;
    $sql = get_reason_counts_sql($params);
    $reason = $wpdb->get_results($wpdb->prepare($sql));
    $sql = get_country_counts_sql($params);
    $country = $wpdb->get_results($wpdb->prepare($sql));
    wp_send_json(array('reasons' => $reason, 'country' => $country));
}

function get_country_counts_sql($params) {
    global $wpdb;
    $sql = 'SELECT count(*) as count, c.country_id FROM ' . $wpdb->prefix . 'cases as c '
            . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as ct ON ct.id_trans = c.id '
            . ' WHERE  1=1 AND ct.type="cases"  AND c.status=1 AND c.cases_type=0 ';
    if ($params['reason']) {
        $sql .= ' AND c.reason_id = ' . $params['reason'];
    }
    // if ($params['type'] != -1) {
    //     $sql .= ' AND c.cases_type = ' . $params['type'];
    // }
    if ($params['date'] == null) {
        $sql .= ' AND YEAR(c.date) <= "' . date("Y") . '" AND YEAR(c.date) >= "1994"';
    } elseif ($params['date']) {
        $sql .= ' AND YEAR(c.date) = "' . $params['date'] . '"';
    }
    if ($params['country_id']) {
        $sql .= ' AND c.country_id = "' . $params['country_id'] . '"';
    }
    if ($params['region_id']) {
        $sql .= ' AND c.region_id = "' . $params['region_id'] . '"';
    }
    if ($params['lang']) {
        $sql .= ' AND ct.lang = "' . $params['lang'] . '"';
    }
    $sql .= ' GROUP BY c.country_id';
    return $sql;
}

function get_reason_counts_sql($params) {
    global $wpdb;
    $sql = 'SELECT count(*) as count, c.reason_id FROM ' . $wpdb->prefix . 'cases as c '
            . ' INNER JOIN ' . $wpdb->prefix . 'cases_translate as ct ON ct.id_trans = c.id '
            . ' WHERE  1=1 AND ct.type="cases" AND c.status=1 AND c.cases_type=0 ';

    if ($params['reason']) {
        $sql .= ' AND c.reason_id = ' . $params['reason'];
    }
    // if ($params['type'] != -1) {
    //     $sql .= ' AND c.cases_type = ' . $params['type'];
    // }
    if ($params['date'] == null) {
        $sql .= ' AND YEAR(c.date) <= "' . date("Y") . '" AND YEAR(c.date) >= "1994"';
    } elseif ($params['date']) {
        $sql .= ' AND YEAR(c.date) = "' . $params['date'] . '"';
    }
    if ($params['country_id']) {
        $sql .= ' AND c.country_id = "' . $params['country_id'] . '"';
    }
    if ($params['region_id']) {
        $sql .= ' AND c.region_id = "' . $params['region_id'] . '"';
    }
    if ($params['lang']) {
        $sql .= ' AND ct.lang = "' . $params['lang'] . '"';
    }
    $sql .= ' GROUP BY c.reason_id';
    return $sql;
}
