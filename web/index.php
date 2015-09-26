<?php
require_once __DIR__ . '/../facebook-php-sdk-v4-5.0-dev/src/Facebook/autoload.php';
session_start();
$fb = new Facebook\Facebook([
  'app_id' => '463005370545725',
  'app_secret' => '5a715c60bddc7de247ac6299bb338f8d',
  'default_graph_version' => 'v2.2',
  ]);



# login.php
//$fb = new Facebook\Facebook([/* . . . */]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'user_likes']; // optional
$loginUrl = $helper->getLoginUrl('http://www.mydomain.com/olx/web/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
