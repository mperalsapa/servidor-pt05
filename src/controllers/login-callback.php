<?php
// Marc Peral
// script que s'encarrega de la crida del callback de login social

// importem les funcions necessaries
include_once("src/internal/viewFunctions/social-login.php");
include_once("src/internal/viewFunctions/browser.php");
include("env.php");

// agafem la url per seleccionar el tipus d'autenticacio
$authProvider = getPathOverBase();

// definim la url del callback, juntant el domini base i la url base
$callbackUrl = $baseDomain . $baseUrl;
// seleccionem la funcio corresponent en base a la url que s'ha introduit
switch ($authProvider) {
    case '/google-login':
        echo "google";
        $userInfo = getGoogleProfile($googleClientID, $googleClientSecret, $callbackUrl);
        break;
    case '/github-login':
        echo "github";
        $userInfo = getGithubProfile($githubClientID, $githubClientSecret, $callbackUrl);
        break;
    case '/twitter-login':
        echo "twitter";
        $userInfo = getTwitterProfile($twitterClientID, $twitterClientSecret, $callbackUrl);
        break;
}

// finalment, si la informacio d'usuari NO es buida, cridem la funcio de social login
if (!empty($userInfo)) {
    socialLoginUser($userInfo);
}

// en cas de no tenir dades d'usuari, redireccionem al login, ja que ha donat algun error
// no informem d'aquest error
redirectClient("login");