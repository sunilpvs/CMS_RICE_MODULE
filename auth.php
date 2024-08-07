<?php
require 'vendor/autoload.php';

use League\OAuth2\Client\Provider\GenericProvider;

$config = require 'config.php';

$provider = new GenericProvider([
    'tenant_id'               => $config['tenant_id'],
    'clientId'                => $config['clientId'],
    'clientSecret'            => $config['clientSecret'],
    'redirectUri'             => $config['redirectUri'],
    'urlAuthorize'            => $config['urlAuthorize'],
    'urlAccessToken'          => $config['urlAccessToken'],
    'urlResourceOwnerDetails' => $config['urlResourceOwnerDetails'],
    'scopes'                  => $config['scopes'],
]);

if (!isset($_GET['code'])) {
    // Step 1. Get authorization code
    $authorizationUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authorizationUrl);
    exit;
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    // State is invalid, possible CSRF attack in progress
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    // Step 2. Get an access token using the authorization code
    try {
        $accessToken = $provider->getAccessToken('authorization_code', ['code' => $_GET['code']
        ]);

        // Step 3. Get the user's profile
        $resourceOwner = $provider->getResourceOwner($accessToken);

        // Use this to interact with an API on the users behalf
        $_SESSION['accessToken'] = $accessToken->getToken();
        $_SESSION['user'] = $resourceOwner->toArray();

        header('Location: /home');
        exit;
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        exit('Failed to get access token: ' . $e->getMessage());
    }
}

?>