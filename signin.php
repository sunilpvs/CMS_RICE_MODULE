<?php

session_start();

require 'vendor/autoload.php';

use myPHPnotes\Microsoft\Auth;

//'tenant_id'               => 'eb9d2f1d-c6cd-4cce-9a4c-38e31163644f',
//secret_id value K6q8Q~YD.RIHjQg_VNhAcL1CT0rjA6OHO_I5VcS9
//secret_id ace9c036-bfb2-4b33-baf7-39564271237d
$tenant = 'common';
$client_id = 'bc87fb47-a4b3-4a4b-8917-c0e726c1bf2c';
$client_secret = 'K6q8Q~YD.RIHjQg_VNhAcL1CT0rjA6OHO_I5VcS9';
$callback = 'http://localhost/callback'; // Your callback URL
$scopes = ['User.Read', 'Files.ReadWrite.All', 'offline_access'];

$microsoft = new Auth($tenant, $client_id, $client_secret, $callback, $scopes);

header('location: ' . $microsoft->getAuthUrl());
