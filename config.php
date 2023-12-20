<?php

require('./vendor/autoload.php');

# Add your client ID and Secret
$client_id = "326511344097-fk47mtu148fm1sigdauqthvgvo8m97eu.apps.googleusercontent.com ";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# redirection location is the path to login.php
$redirect_uri = 'https://21102117.kelasmm3.cloud/21102117-mm3-pw2324/capstone-fix/index.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");