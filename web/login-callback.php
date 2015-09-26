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
		$response = $fb->get('/me?fields=id,name', 'CAAGlGdaj9j0BADwSZCIZBZBKRZBdmVRVnppUm6TI33ptZCfjGQam0eQCmRGksEXFHGKQ4INQfP8QD5ddIFAaT6SGTp8KyCakITJkp93IRZCS2SBLe0PVByX4NSkRydlrkaWRZAMwN4BLM7ZC8QGiVC5dDToU1G2F9fCGW0GN7zizZBQAoxZB5cSBIDGhyWPtTmpNYZD');
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
$response = $fb->get($user["id"].'/likes', 'CAAGlGdaj9j0BADwSZCIZBZBKRZBdmVRVnppUm6TI33ptZCfjGQam0eQCmRGksEXFHGKQ4INQfP8QD5ddIFAaT6SGTp8KyCakITJkp93IRZCS2SBLe0PVByX4NSkRydlrkaWRZAMwN4BLM7ZC8QGiVC5dDToU1G2F9fCGW0GN7zizZBQAoxZB5cSBIDGhyWPtTmpNYZD');
$likesArray = $response->getDecodedBody()['data'];
print_r($likesArray);
echo "\n".'RESPONSE FROM OLX'."\n";
foreach ($likesArray as $like){
	getDataFromOlx($like['name']);
}


function getDataFromOlx($search)
{
$url = 'http://olx.in/all-results/q-'.urlencode($search);
echo $url."\n";
print_r(file_get_contents('http://olx.in/all-results/q-'.urlencode($search)));
/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$a = curl_exec($ch);
if(preg_match('#Location: (.*)#', $a, $r))
 $l = trim($r[1]);
//Header('''http://olx.in/all-results/q-'.urlencode($search)));
/*	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,'http://olx.in/all-results/q-'.urlencode($search));
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	if (empty($buffer)){
		print "Nothing returned from url.<p>";
	}
	else{
		print $buffer;
	}
*/
}
