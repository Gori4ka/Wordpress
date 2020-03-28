<?php

function peyotto_register_shortcode() {
    ob_start();
    Peyotto_registration_form();
    return ob_get_clean();
}

add_shortcode('cflrf_registration_form', 'peyotto_register_shortcode');

function Peyotto_registration_form() {
    ?>


    <form method="post" id="peyotto_register_form" action="/wp-admin/admin-ajax.php?action=peyotto_frontend_register">
        <div class="login-form">
            <?php wp_nonce_field('peyotto_frontend_register', 'peyotto_register_form'); ?>
            <div class="form-group">
                <input name="reg_fname" type="text" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_fname']) ? $_REQUEST['reg_fname'] : null); ?>"
                       placeholder="Անուն" id="reg-fname" required>
                <label class="login-field-icon fui-user" for="reg-fname"></label>
            </div>

            <div class="form-group">
                <input name="reg_lname" type="text" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_lname']) ? $_REQUEST['reg_lname'] : null); ?>"
                       placeholder="Ազգանուն" id="reg-lname" required>
                <label class="login-field-icon fui-user" for="reg-lname"></label>
            </div>

            <div class="form-group">
                <input name="reg_email" type="email" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_email']) ? $_REQUEST['reg_email'] : null); ?>"
                       placeholder="Էլ.հասցե" id="reg-email" required>
                <label class="login-field-icon fui-mail" for="reg-email"></label>
            </div>


            <div class="form-group">
                <input name="reg_password" type="password" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_password']) ? $_REQUEST['reg_password'] : null); ?>"
                       placeholder="Գաղտնաբառ" id="reg-pass" required>
                <label class="login-field-icon fui-lock" for="reg-pass"></label>
            </div>
            <div class="form-group">
                <input name="reg_bio" type="number" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_bio']) ? $_REQUEST['reg_bio'] : null); ?>"
                       placeholder="Հեռախոսահամար" id="reg-bio" required>
                <label class="login-field-icon fui-new" for="reg-bio"></label>
            </div>

            <!-- <div class="form-group">
                <input name="reg_email" type="email" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_email']) ? $_REQUEST['reg_email'] : null); ?>"
                       placeholder="Email" id="reg-email">
                <label class="login-field-icon fui-mail" for="reg-email"></label>
            </div> -->

            <!-- <div class="form-group">
                <input name="reg_website" type="text" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_website']) ? $_REQUEST['reg_website'] : null); ?>"
                       placeholder="Website(optional)" id="reg-website"/>
                <label class="login-field-icon fui-chat" for="reg-website"></label>
            </div> -->

            <!-- <div class="form-group">
                <input name="reg_nickname" type="text" class="form-control login-field"
                       value="<?php echo(isset($_REQUEST['reg_nickname']) ? $_REQUEST['reg_nickname'] : null); ?>"
                       placeholder="Nickname" id="reg-nickname"/>
                <label class="login-field-icon fui-user" for="reg-nickname"></label>
            </div> -->
            <div class="register-error"></div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" name="reg_submit" value="Մուտք"/>
        </div>
    </form>

    <?php
}

function PeyottoRegistration($newUser) {
    $userdata = array(
        'user_login' => esc_attr($newUser['username']),
        'user_email' => esc_attr($newUser['email']),
        'user_pass' => esc_attr($newUser['password']),
        'user_url' => esc_attr($newUser['website']),
        'first_name' => esc_attr($newUser['first_name']),
        'last_name' => esc_attr($newUser['last_name']),
        'nickname' => esc_attr($newUser['nickname']),
        'description' => esc_attr($newUser['bio']),
    );

    if (is_wp_error(PeyottoRegisterValidation($newUser))) {
        return array('status' => 'error', 'message' => PeyottoRegisterValidation($newUser)->get_error_message());
    } else {
        $register_user = wp_insert_user($userdata);
        if (!is_wp_error($register_user)) {
            return array('status' => 'ok', 'message' => 'Գրանցումը կատարվել է հաջողությամբ', 'ID' => $register_user);
        } else {
            return array('status' => 'error', 'message' => $register_user->get_error_message());
        }
    }
}

function PeyottoRegisterValidation($newUser) {


    if (empty($newUser['username']) || empty($newUser['username']) || empty($newUser['username'])) {
        return new WP_Error('field', 'Required form field is missing');
    }

    if (strlen($newUser['username']) < 2) {
        return new WP_Error('username_length', 'էլ․ հասցեն Գաղտնաբառը պետք է լինի մինիմում 2 նիշ');
    }

    if (strlen($newUser['first_name']) < 2) {
        return new WP_Error('username_length', 'Անունը պետք է լինի մինիմում 2 նիշ');
    }

    if (strlen($newUser['password']) < 5) {
        return new WP_Error('password', 'Գաղտնաբառը պետք է լինի մինիմում 5 նիշ');
    }

    if (!is_email($newUser['email'])) {
        return new WP_Error('email_invalid', 'էլ․ հասցեն սխալ է մուտքագրված');
    }

    if (email_exists($newUser['email'])) {
        return new WP_Error('email', 'էլ․ հասցեն արդեն գոյությու ունի');
    }

    if (strlen((string)$newUser['bio']) < 6) {
        return new WP_Error('username_length', 'Հեռախոսահամարը պետք է լինի մինիմում 6 նիշ');
    }


    $details = array(
        'Անունը' => $newUser['first_name'],
        'Ազգանունը' => $newUser['last_name'],
        'Հեռախոսահամարը' => $newUser['bio']
    );

    foreach ($details as $field => $detail) {
        if (!validate_username($detail)) {
            return new WP_Error('name_invalid', 'Ներողություն "' . $field . '" սխալ է մուտքագրված');
        }
    }
}

// custom frontend login form

add_action('wp_ajax_peyotto_frontend_register', 'peyotto_frontend_register');
add_action('wp_ajax_nopriv_peyotto_frontend_register', 'peyotto_frontend_register');

function peyotto_frontend_register() {
    $result = array('status' => 'error', 'message' => 'Register Faild');
    if (isset($_POST['peyotto_register_form']) && wp_verify_nonce($_POST['peyotto_register_form'], 'peyotto_frontend_register') && $_REQUEST['reg_submit']) {
        $newUser['username'] = strtolower(implode('@', explode('@', $_REQUEST['reg_email'], -1))) . time();
        $newUser['email'] = $_REQUEST['reg_email'];
        $newUser['password'] = $_REQUEST['reg_password'];
        $newUser['website'] = $_REQUEST['reg_website'];
        $newUser['first_name'] = $_REQUEST['reg_fname'];
        $newUser['last_name'] = $_REQUEST['reg_lname'];
        $newUser['bio'] = $_REQUEST['reg_bio'];

        $result = PeyottoRegistration($newUser);
        //wp_new_user_notification( $result[ID], $_REQUEST['reg_password']);
    }
    wp_send_json($result);
    wp_die();
}

function login_check($username, $password) {
    global $user;
    $creds = array();
    $creds['user_login'] = $username;
    $creds['user_password'] = $password;
    $creds['remember'] = true;
    $user = wp_signon($creds, false);
    //var_dump(get_user_meta($user->ID, 'has_to_be_activated', true));
    if (get_user_meta($user->ID, 'has_to_be_activated', true) != false) {
        return array('status' => 'error', 'message' => "Please activate your account");
    } else if (!is_wp_error($user)) {
        return array('status' => 'ok', 'message' => '');
        exit();
    } else {
        return array('status' => 'error', 'message' => 'Սխալ գաղտնաբառ կամ օգտանուն');//'message' => $user->get_error_message()
    }
}

function login_check_process() {
    ?>
    <form method="post" id="peyotto_login_form" action="/wp-admin/admin-ajax.php?action=peyotto_frontend_login">
        <div class="login-form">
            <?php wp_nonce_field('peyotto_frontend_login', 'peyotto_login_form'); ?>
            <div class="form-group">
                <input name="login_name" type="text" class="form-control login-field" value="" placeholder="Էլ.հասցե" id="login-name" />
                <label class="login-field-icon fui-user" for="login-name"></label>
            </div>

            <div class="form-group" style="margin-bottom: 0px;">
                <input  name="login_password" type="password" class="form-control login-field" value="" placeholder="Գաղտնաբառ" id="login-pass" />
                <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            <div class="login-error"></div>
            <input class="btn btn-primary btn-lg btn-block" type="submit"  name="login_submit" value="Մուտք" />
            <!-- <div class="peyotto-register" id='register-button'>
                <a href="#">Գրանցում</a>
            </div> -->

        </div>
    </form>
    <?php
}

function peyotto_login_shortcode() {
    ob_start();
    login_check_process();
    return ob_get_clean();
}

add_shortcode('peyotto_custom_login_form', 'peyotto_login_shortcode');






add_action('wp_ajax_peyotto_frontend_login', 'peyotto_frontend_login');
add_action('wp_ajax_nopriv_peyotto_frontend_login', 'peyotto_frontend_login');

function peyotto_frontend_login() {
    $result = array('status' => 'error', 'message' => 'User login faild');
    if (isset($_POST['peyotto_login_form']) && wp_verify_nonce($_POST['peyotto_login_form'], 'peyotto_frontend_login') && isset($_POST['login_submit'])) {
        $result = login_check($_POST['login_name'], $_POST['login_password']);
    }
    wp_send_json($result);
    wp_die();
}

function peyotto_change_password_form() {
    ?>
    <form method="post" id="peyotto_change_user_pass_form" action="/wp-admin/admin-ajax.php?action=peyotto_change_user_password">
        <?php wp_nonce_field('peyotto_change_password', 'peyotto_change_form'); ?>
        <div class="pass-change-message"></div>
        <div class="form-group">
            <input class="form-control login-field" value="" placeholder="Նոր գաղտնաբառ" name="pass1" type="password">
            <label class="login-field-icon fui-lock" for="login-pass"></label>
        </div>

        <div class="form-group">
            <input class="form-control login-field" value="" placeholder="Կրկնել գաղտնաբառ" name="pass2" type="password">
            <label class="login-field-icon fui-lock" for="login-pass"></label>
        </div>
        <input class="btn btn-primary btn-lg btn-block" type="submit"  name="updateuser" value="Փոխել" />
    </form>
    <?php
}

function peyotto_change_password_shortcode() {
    ob_start();
    peyotto_change_password_form();
    return ob_get_clean();
}

add_shortcode('peyotto_show_change_form', 'peyotto_change_password_shortcode');

function change_password() {

    if (!is_user_logged_in()) {
        return array('status' => 'error', 'message' => 'User not logged in');
    }
    if (!empty($_POST) && !empty($_POST['pass1']) && !empty($_POST['pass2'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $error = 'Գաղտնաբառը հնարավոր չէ փոփոխել';
            return array('status' => 'error', 'message' => $error);
        } elseif (strlen($_POST['pass1']) < 4) {
            return array('status' => 'error', 'message' => $error);
        } elseif (false !== strpos(wp_unslash($_POST['pass1']), "")) {
            return array('status' => 'error', 'message' => $error);
        } else {
            $error = wp_update_user(array('ID' => get_current_user_id(), 'user_pass' => esc_attr($_POST['pass1'])));

            if (!is_int($error)) {
                $error = 'Գաղտնաբառը հնարավոր չէ փոփոխել';
            } else {
                $error = false;
                return array('status' => 'ok', 'message' => 'Գաղտնաբառը հաջողությամբ փոխված է');
            }
        }

        if ($error) {
            return array('status' => 'ok', 'message' => 'Գաղտնաբառը հնարավոր չէ փոփոխել');
        }
    }
    return array('status' => 'error', 'message' => 'User not logged in');
}

add_action('wp_ajax_peyotto_change_user_password', 'peyotto_change_user_password');

function peyotto_change_user_password() {
    $result = array('status' => 'error', 'message' => 'Գաղտնաբառը հնարավոր չէ փոփոխել');
    if (isset($_POST['peyotto_change_form']) && wp_verify_nonce($_POST['peyotto_change_form'], 'peyotto_change_password') && $_POST['updateuser']) {
        $result = change_password();
    }

    wp_send_json($result);
    wp_die();
}
