<?php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('805941365766-9s8ki6b0hvott5uidk9ab9ipka40ebf3.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('XGvT_vpYzNRVuMGtz3fGPTBf');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/google_auth/dashboard.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>