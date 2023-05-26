<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('686909323639-km6rjn4aq4o7u41i7aebmbrb7r0vure3.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/Rent-A-Ride/login.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page

?>