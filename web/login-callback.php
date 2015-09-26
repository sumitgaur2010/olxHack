<?php
session_start();
require_once __DIR__ . '/../facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
		'app_id' => '463005370545725',
		'app_secret' => '5a715c60bddc7de247ac6299bb338f8d',
		'default_graph_version' => 'v2.2',
]);

function getResponseFromFaceBook($fb){
	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $fb->get('/me?fields=id,name', 'CAAGlGdaj9j0BAKCNTQB9GRyJaMZAXKp4rIrZAKDtWOoYXyU94qq6VLKXuEX2MYm4ZCtWOoTfVAc3cbU6d6HKAgS5XrNGTBpe21kXJ2L3Q3wQQjxz72peGJt8gmVKdCikshhHBDmMlaBid5D0rLdIpRrUD3YqUVoYyhdogVFvli2aiN8PeY826vODq8iApWwRYIj4rIhWwZDZD');
		return $response;
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
}

$response=getResponseFromFaceBook($fb);
$user = $response->getGraphUser();

echo 'Name: ' . $user;
$response = $fb->get($user["id"].'/likes', 'CAAGlGdaj9j0BAKCNTQB9GRyJaMZAXKp4rIrZAKDtWOoYXyU94qq6VLKXuEX2MYm4ZCtWOoTfVAc3cbU6d6HKAgS5XrNGTBpe21kXJ2L3Q3wQQjxz72peGJt8gmVKdCikshhHBDmMlaBid5D0rLdIpRrUD3YqUVoYyhdogVFvli2aiN8PeY826vODq8iApWwRYIj4rIhWwZDZD');
$likesArray = $response->getDecodedBody()['data'];
print_r($likesArray);
echo 'RESPONSE FROM'."\n";
foreach ($likesArray as $like){
	getDataFromOlx($like['name']);
}


function getDataFromOlx($search)
{
//die('http://olx.in/all-results/q-/'.$search);
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,'http://olx.in/all-results/q-/'.urlencode($search));
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	if (empty($buffer)){
		print "Nothing returned from url.<p>";
	}
	else{
		print $buffer;
	}

}
