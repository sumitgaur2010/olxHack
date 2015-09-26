<?php
require_once __DIR__ . '/../facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
		'app_id' => '463005370545725',
		'app_secret' => '5a715c60bddc7de247ac6299bb338f8d',
		'default_graph_version' => 'v2.2',
]);

function getResponseFromFaceBook($fb){
	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $fb->get('/me?fields=id,name', 'CAAGlGdaj9j0BAIARyTGImBPDqD7HElb0qtukIMAO0ghBUNCf3ZBa1M56Ai2PTVKyRKGKVXtOv9npAxDz35vTTRzB6wzFDERx2DGk0MYqaZCIQJvsZCAnYrFaBmilcfV918JyR7S5tVRIEZClmnvyKEoRrjoR19IoFRCIYhnjB9WxP0QV7j7LfHP3GVPEIZBFy55ZAZBuAoxcwZDZD');
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
$response = $fb->get($user["id"].'/likes', 'CAAGlGdaj9j0BAIARyTGImBPDqD7HElb0qtukIMAO0ghBUNCf3ZBa1M56Ai2PTVKyRKGKVXtOv9npAxDz35vTTRzB6wzFDERx2DGk0MYqaZCIQJvsZCAnYrFaBmilcfV918JyR7S5tVRIEZClmnvyKEoRrjoR19IoFRCIYhnjB9WxP0QV7j7LfHP3GVPEIZBFy55ZAZBuAoxcwZDZD');
$likesArray = $response->getDecodedBody()['data'];
print_r($likesArray);
echo 'dsadsadsadsa'."\n";
getDataFromOlx();
function getDataFromOlx()
{
 $curl_handle=curl_init();
  curl_setopt($curl_handle,CURLOPT_URL,'http://olx.in/all-results/q-car-hy/');
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
