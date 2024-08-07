<?php
    use myPHPnotes\Microsoft\Auth;
    use myPHPnotes\Microsoft\Handlers\Session;
    use myPHPnotes\Microsoft\Models\User;

    session_start();

    require "vendor/autoload.php";
    $config = require 'config.php';

    $tenant_id=$config['tenant_id'];
    $client_id=$config['clientId'];
    $client_secret=$config['clientSecret'];
    $redirect_uri=$config['redirectUri'];
    //$scopes= ['User.Read'];
    $scopes= ['openid',' profile','email'];
    //$tenant_id = Session::get("tenant_id");
    //$tenant_id = $_Session["tenant_id"];
    //$tenant_id = getenv('tenant_id');
    //$client_id = getenv('CLIENT_ID');
    //$client_secret = getenv('CLIENT_SECRET');
    //$redirect_uri = getenv('REDIRECT_URI');
    //$scopes = json_decode(getenv('SCOPES'), true);
    //$scopes = getenv('SCOPES');

    //$auth = new Auth(Session::get("tenant_id"), Session::get("client_id"), Session::get("client_secret"), Session::get("redirect_uri"), Session::get("scopes"));
    $auth = new myPHPnotes\Microsoft\Auth($tenant_id, $client_id, $client_secret, $redirect_uri, $scopes);
    $tokens = $auth->getToken($_REQUEST['code'], $_REQUEST['state']);
    $accessToken = $tokens->access_token;

    $auth->setAccessToken($accessToken);

    $user = new User;
    echo "Name: "  . $user->data->getDisplayName() . "<br>";
    echo "Email: " . $user->data->getUserPrincipalName() . "<br>";

?>