<?php
session_start();
//config.php

//Include Google Client Library for PHP autoload file
require 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$fb =new Facebook\Facebook([
    'app_id' => '470297251879650',
    'app_secret' => '292283754ad87852cb3a7da1e431e6e2',
    'default_graph+version' => '2.10'
]);

$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/Rent-A-Ride/login.php");
try{
    $accessToken = $helper->getAccessToken();
    if(isset($accessToken)) {
        $_SESSION['access_token'] = (sting)$accessToken;
        header("location:index.php");
    }
}
catch(Exception $e){
    echo $e->getTraceAsString();
}

?>