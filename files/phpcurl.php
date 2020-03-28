<?php

header("Content-type: application/json");

$ids = explode(',', $_GET['ids']);
$images = [];

if(count($ids) > 1) {
	foreach ($ids as $id) {
		$filename = getImage($id);
		$images[] = $filename;
	}
}

echo json_encode(['images' => $images]);

function getImage($id) {
	$curl = curl_init();
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_URL => 'https://api.colourbox.com/media/' . $id . '/download',
	    CURLOPT_HEADER => true,
	    CURLOPT_HTTPHEADER => array(
			'Authorization: CBX-SIMPLE-TOKEN Token=b1a8fae657aff19c4be1a04116b167c900415',
			'Content-type: image/jpeg'
		),
	));

	$response = curl_exec($curl);

	list($headers, $content) = explode("\r\n\r\n", $response, 2);

	if ($headers !== false) {
		if (curl_getinfo($curl, CURLINFO_HTTP_CODE) == '200') {
			$reDispo = '/^Content-Disposition: .*?filename=(?<f>[^\s]+|\x22[^\x22]+\x22)\x3B?.*$/m';
			if (preg_match($reDispo, $headers, $mDispo)) {
				$filename = trim($mDispo['f'],' ";');
				if(file_put_contents('uploads/'.$filename, $content)) {
					return $filename;
				}
			}
		}
	}
}