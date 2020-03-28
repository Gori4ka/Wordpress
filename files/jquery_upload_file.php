<?php

//////////////////////// php code function.php ///////////////////


add_action('wp_ajax_upload_artwork', 'upload_artwork');
add_action('wp_ajax_nopriv_upload_artwork', 'upload_artwork');

function upload_artwork() {
    check_ajax_referer('security', 'security');
    if ( 0 < $_FILES['file']['error'] ) {
        wp_send_json(array('status' => 'error'));
    }
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $new_file_name = md5(time() . $_FILES['file']['name']) . '.' . $ext;
    $path = WP_PLUGIN_DIR.'/openswatch/images/uploads/';
    if(move_uploaded_file($_FILES['file']['tmp_name'], $path. $new_file_name)){
      wp_send_json(array('status' => 'ok', 'file_name' => $new_file_name));
    }
    die;
}

///////////////// remove upload file /////////////////////////
add_action('wp_ajax_remove_upload_artwork', 'remove_upload_artwork');
add_action('wp_ajax_nopriv_remove_upload_artwork', 'remove_upload_artwork');

function remove_upload_artwork() {
    if (!$_POST['file_name']) {
        wp_send_json(array('status' => 'error'));
    }

    $path = WP_PLUGIN_DIR.'/openswatch/images/uploads/';
    $file = $path.$_POST['file_name'];
    if (!unlink($file)) {
      wp_send_json(array('status' => 'error'));
    }
    else{
      wp_send_json(array('status' => 'ok'));
    }
    die;
}

?>

<!-- html code -->

<input id="upload_your_artwork" type="file" name="your_artwork" accept=".jpeg,.jpg,.gif,.png,.eps,.pdf,.psd" />

<!-- js code -->

<script type="text/javascript">

	$(document).on('change', '#upload_your_artwork', function(e){
		var fileName = e.target.files[0].name;
		$('#your_artwork_info span').html(fileName);
		$('#your_artwork_info').css("display", "block");

		var file_data = $(this).prop('files')[0];
		artworkUpload(file_data, 'your_artwork');

	})

	<?php $ajax_nonce = wp_create_nonce("security"); ?>
	
	window.artworkUpload = function(file_data, artwork_name) {
		var form_data = new FormData();
		form_data.append('file', file_data);
		form_data.append('action', "upload_artwork");
		form_data.append('security', '<?php echo $ajax_nonce; ?>');
		form_data.append('artwork_name', artwork_name);
		$.ajax({
			url: openwatch_ajax_url,
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function(a) {
				console.log(a)
			}
		})
	}
</script>
