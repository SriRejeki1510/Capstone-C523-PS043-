<?php

require('./vendor/autoload.php');

# Add your client ID and Secret
$client_id = "326511344097-506f74t43h6afqr0jpuhd033t8ue9dt2.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# redirection location is the path to login.php
$redirect_uri = 'http://localhost/capstone/login-index.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");