<?php
require_once __DIR__ . '/../facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '463005370545725',
  'app_secret' => '5a715c60bddc7de247ac6299bb338f8d',
  'default_graph_version' => 'v2.2',
  ]);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', 'CAAGlGdaj9j0BAIARyTGImBPDqD7HElb0qtukIMAO0ghBUNCf3ZBa1M56Ai2PTVKyRKGKVXtOv9npAxDz35vTTRzB6wzFDERx2DGk0MYqaZCIQJvsZCAnYrFaBmilcfV918JyR7S5tVRIEZClmnvyKEoRrjoR19IoFRCIYhnjB9WxP0QV7j7LfHP3GVPEIZBFy55ZAZBuAoxcwZDZD');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user;
  $response = $fb->get($user["id"].'/likes', 'CAAGlGdaj9j0BAIARyTGImBPDqD7HElb0qtukIMAO0ghBUNCf3ZBa1M56Ai2PTVKyRKGKVXtOv9npAxDz35vTTRzB6wzFDERx2DGk0MYqaZCIQJvsZCAnYrFaBmilcfV918JyR7S5tVRIEZClmnvyKEoRrjoR19IoFRCIYhnjB9WxP0QV7j7LfHP3GVPEIZBFy55ZAZBuAoxcwZDZD');
$likesArray = $response->getDecodedBody()['data'];
print_r($likesArray);
// OR
// echo 'Name: ' . $user->getName();
