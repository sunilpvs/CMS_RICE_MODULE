<?php
session_start();

// Check if the user is already authenticated
if (isset($_SESSION['token'])) {
    header('Location: http://localhost/success.php');
    exit();
}

// Include the required libraries
require_once __DIR__.'/vendor/autoload.php';

// Configuration for Azure AD OAuth2 provider
$clientId = 'XXXXXXXXXXXXXXXXX';
$clientSecret = 'XXXXXXXXXXXXXXXXX';
$redirectUri = 'http://localhost/success.php'; // Change this according to your configuration
$tenantId = 'XXXXXXXXXXXXXXXXX';
$scope = 'https://graph.microsoft.com/User.Read https://graph.microsoft.com/profile https://graph.microsoft.com/email https://graph.microsoft.com/offline_access';



$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => $clientId,
    'clientSecret'            => $clientSecret,
    'redirectUri'             => $redirectUri,
    'urlAuthorize'            => "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/authorize",
    'urlAccessToken'          => "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token",
    'urlResourceOwnerDetails' => '',
    'scopes'                  => $scope, // Change the areas according to your requirements
    'enablePkce' => true
]);


$authorizationUrl = $provider->getAuthorizationUrl();

$_SESSION['oauth2state'] = $provider->getState();

header('Location: ' . $authorizationUrl);
exit();
?>
