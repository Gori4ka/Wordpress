<?php
function wpcf7_send_formdata ($WPCF7_ContactForm) {
    $options = get_option( 'senzey_settings' );
    if($options['senzey_contact_form_id'] == $_POST['_wpcf7']){
        $post_data = [
            "x_name" => $_POST['contactName'],
            "x_phone" => $_POST['contactPhone'],
            "x_email1" => $_POST['contactEmail'],
            "x_comments" => $_POST['contactComment']
        ];

        $url = "https://{$options['senzey_account_name']}.senzey.com/extapi/pclient/add.php?username={$options['senzey_username']}&password={$options['senzey_password']}";

        $requestHeader = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Accept: application/json");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close ($ch);
    }

    if($options['senzey_contact_form_id2'] == $_POST['_wpcf7']){
        $post_data = [
            "x_name" => $_POST['contactName'],
            "x_phone" => $_POST['contactPhone'],
            "x_email1" => $_POST['contactEmail'],
            "x_comments" => $_POST['contactComment']
        ];

        $url = "https://{$options['senzey_account_name']}.senzey.com/extapi/pclient/add.php?username={$options['senzey_username']}&password={$options['senzey_password']}";

        $requestHeader = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Accept: application/json");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close ($ch);
        

    }

    if($options['senzey_contact_form_id3'] == $_POST['_wpcf7']){
        //client data
        $post_data = [
            "x_name" => $_POST['contactName'],
            "x_phone" => $_POST['contactPhone'],
            "x_email1" => $_POST['contactEmail'],
            "x_comments" => $_POST['contactComment']
        ];

        $url = "https://{$options['senzey_account_name']}.senzey.com/extapi/pclient/add.php?username={$options['senzey_username']}&password={$options['senzey_password']}";

        $requestHeader = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Accept: application/json");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close ($ch);
        

    }

    if($options['senzey_contact_form_id4'] == $_POST['_wpcf7']){
        //client data
        $post_data = [
            "x_name" => $_POST['contactName'],
            "x_phone" => $_POST['contactPhone'],
            "x_email1" => $_POST['contactEmail'],
            "x_comments" => $_POST['contactComment']
        ];

        $url = "https://{$options['senzey_account_name']}.senzey.com/extapi/pclient/add.php?username={$options['senzey_username']}&password={$options['senzey_password']}";

        $requestHeader = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Accept: application/json");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close ($ch);
    }

    if($options['senzey_contact_form_id5'] == $_POST['_wpcf7']){
        $post_data = [
            "x_name" => $_POST['contactName'],
            "x_phone" => $_POST['contactPhone'],
            "x_email1" => $_POST['contactEmail'],
            "x_comments" => $_POST['contactComment']
        ];

        $url = "https://{$options['senzey_account_name']}.senzey.com/extapi/pclient/add.php?username={$options['senzey_username']}&password={$options['senzey_password']}";

        $requestHeader = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Accept: application/json");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close ($ch);
        

    }

    if($options['senzey_contact_form_id6'] == $_POST['_wpcf7']){
        //client data
        $post_data = [
            "x_name" => $_POST['contactName'],
            "x_phone" => $_POST['contactPhone'],
            "x_email1" => $_POST['contactEmail'],
            "x_comments" => $_POST['contactComment']
            //.... other data 
        ];

        $url = "https://{$options['senzey_account_name']}.senzey.com/extapi/pclient/add.php?username={$options['senzey_username']}&password={$options['senzey_password']}";

        $requestHeader = array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Accept: application/json");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeader); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch));
        curl_close ($ch);
        

    }

}
add_action("wpcf7_before_send_mail", "wpcf7_send_formdata");

////////////////////add setings ///////////////////////////////

add_action( 'admin_menu', 'senzey_add_admin_menu' );
add_action( 'admin_init', 'senzey_settings_init' );

function senzey_add_admin_menu(  ) { 
	add_options_page( 'Senzey poster', 'Senzey poster', 'manage_options', 'senzey_poster', 'senzey_options_page' );
}

function senzey_settings_init(  ) {

    register_setting( 'senzeySettings', 'senzey_settings' );

    add_settings_section(
        'senzey_senzeySettings_section',
        __( 'Senzey poster settings', 'senzey' ),
        'senzey_settings_section_callback',
        'senzeySettings'
    );

    add_settings_field(
        'senzey_account_name',
        __( 'Account name', 'senzey' ),
        'senzey_account_name_render',
        'senzeySettings',
        'senzey_senzeySettings_section'
    );

    add_settings_field(
        'senzey_username',
        __( 'Username', 'senzey' ),
        'senzey_username_render',
        'senzeySettings',
        'senzey_senzeySettings_section'
    );

    add_settings_field(
        'senzey_password',
        __( 'Password', 'senzey' ),
        'senzey_password_render',
        'senzeySettings',
        'senzey_senzeySettings_section'
    );
}

function senzey_account_name_render(  ) {
    $options = get_option( 'senzey_settings' );
    ?>
    <input type='text' name='senzey_settings[senzey_account_name]' value='<?php echo $options['senzey_account_name']; ?>'>
    <?php
}

function senzey_username_render(  ) {
    $options = get_option( 'senzey_settings' );
    ?>
    <input type='text' name='senzey_settings[senzey_username]' value='<?php echo $options['senzey_username']; ?>'>
    <?php
}

function senzey_password_render(  ) {
    $options = get_option( 'senzey_settings' );
    ?>
    <input type='password' name='senzey_settings[senzey_password]' value='<?php echo $options['senzey_password']; ?>'>
    <?php
}

function senzey_settings_section_callback(  ) {
    echo __( 'Provide data for senzey poster plugin that will send the name, phone, email and a comment from contact form 7 using the <a href="http://senzey.com/contacts-api-en" target="_blank">Senzey API</a>', 'senzey' );
}


function senzey_options_page(  ) {
    ?>
    <form action='options.php' method='post'>

        <h1>Senzey poster</h1>
        <?php
        settings_fields( 'senzeySettings' );
        do_settings_sections( 'senzeySettings' );
        submit_button();
        ?>
    </form>
    <?php
}
?>