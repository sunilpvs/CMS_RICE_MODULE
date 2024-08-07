<!DOCTYPE html>
<html lang="DE">

<?php
session_start();
$username = $_SESSION['user'];
$Erfolg ="Sie haben sich erfolgreich angemeldet";

// Extrahiere den Autorisierungscode aus der URL
$authorization_code = isset($_GET['code']) ? $_GET['code'] : null;
?>

    <head> 
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Css2.css">
        <script src="Js.js"></script>
        <title>
            Erfolg
        </title>
    </head>
    <body>
        <header>
            <div id="Überschrift">
                <h1>ITH Bolting Technology - Login</h1>
                <?php
                    echo "Benutzer: ";
                    echo($username);
                ?>
            </div>
        </header>
        <main>
            <h3>

<?php

$Erfolg ="Sie haben sich erfolgreich angemeldet";

// Guzzle HTTP Client 
require_once __DIR__.'/vendor/autoload.php';
$clientId = 'XXXXXXXXXXXXXXXXX';
$clientSecret = 'XXXXXXXXXXXXXXXXX';
$redirectUri = 'http://localhost/success.php'; // Ändern Sie dies entsprechend Ihrer Konfiguration
$tenantId = 'XXXXXXXXXXXXXXXXX';
$scope = 'https://graph.microsoft.com/User.Read https://graph.microsoft.com/profile https://graph.microsoft.com/email https://graph.microsoft.com/offline_access';

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => $clientId,
    'clientSecret'            => $clientSecret,
    'redirectUri'             => $redirectUri,
    'urlAuthorize'            => "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/authorize",
    'urlAccessToken'          => "https://login.microsoftonline.com/$tenantId/oauth2/v2.0/token",
    'urlResourceOwnerDetails' => '',
    'scopes'                  => $scope // Ändern Sie die Bereiche entsprechend Ihren Anforderungen
]);

// Autorisierungscode aus der URL-Parameter erhalten
$authorizationCode = isset($_GET['code']) ? $_GET['code'] : null;

if (!$authorizationCode) {
    exit('Authorization code not provided.');
}

try {
    // Zugriffstoken anfordern
    $accessToken = $provider->getAccessToken('authorization_code', ['code' => $authorizationCode]);

    // Zugriffstoken erhalten
    $accessTokenValue = $accessToken->getToken();

    // Informationen über Benutzer abrufen
    $graph = new Microsoft\Graph\Graph();
    $graph->setAccessToken($accessTokenValue);
    $user = $graph->createRequest('GET', '/me')
                  ->setReturnType(Microsoft\Graph\Model\User::class)
                  ->execute();

    // Benutzerinformationen anzeigen
    echo 'Benutzername: ' . $user->getDisplayName();
    echo 'E-Mail: ' . $user->getMail();

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    exit('Failed to get access token: ' . $e->getMessage());
}

// Überprüfen, ob die Anzahl der Benutzer in der Session vorhanden ist
    /*if (isset($_SESSION['user_count'])) {
        echo "<p>Anzahl der Benutzer aus Azure AD: " . $_SESSION['user_count'] . "</p>";
    } else {
        echo "<p>Es wurden keine Benutzer abgerufen.</p>";
    }*/

?>

            </h3> 
            <div id="authCode">
                <?php
                    if ($authorization_code) 
                    {
                        
                         // Autorisierungscode auf der Seite anzeigen
                         echo "<script>document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('authCode').textContent = 'Autorisierungscode: $authorization_code';
                        });</script>";
                    }
                ?>
            </div> 
        </main>
    </body>

</html>
