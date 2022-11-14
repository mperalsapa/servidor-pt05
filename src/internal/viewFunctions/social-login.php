<?php
// Marc Peral
// script que s'encarrega de fer que l'usuari inici sessio amb social login (google, github...), i si ja ha iniciat
// sessio, s'encarrega de agafar les dades com el nom i el correu electronic

// importem la llibreria de hybridAuth
include_once("src/internal/hybridAuth/autoload.php");

// aquesta funcio inicia sessio amb google. En cas de que no tinguem el token de login, realitzara una redireccio al client
function googleLogin(string $googleClientID, string $googleClientSecret, string $callbackUrl): \Hybridauth\Provider\Google
{
    $config = [
        'callback' => $callbackUrl . 'google-login', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        'keys' => ['id' => $googleClientID, 'secret' => $googleClientSecret], // Your Github application credentials
    ];
    var_dump($config);
    $googleAuth = new \Hybridauth\Provider\Google($config);
    $googleAuth->authenticate();
    return $googleAuth;
}

// si el client ha iniciat sesio a google, aquesta funcio ens permet agafar el seu nom, cognom i correu electronic
// i retornem aquestes dades
function getGoogleProfile(string $googleClientID, string $googleClientSecret, string $callbackUrl): array
{
    $googleAuth = googleLogin($googleClientID, $googleClientSecret, $callbackUrl);
    try {
        if ($googleAuth->authenticate("Google")) {
            $userProfile = $googleAuth->getUserProfile();
            $userInfo["email"] = $userProfile->email;
            if (empty($userProfile->firstName)) {
                $userInfo["name"] = $userProfile->displayName;
            } else {
                $userInfo["name"] = $userProfile->firstName;
            }
            $userInfo["surname"] = $userProfile->lastName;
        } else {
            die();
        }
    } catch (Hybridauth\Exception\HttpClientFailureException $e) {
        echo 'Curl text error message : ' . $googleAuth->getHttpClient()->getResponseClientError();
    } catch (\Exception $e) {
        echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
    }

    $googleAuth->disconnect();
    return $userInfo;
}

// aquesta funcio inicia sessio amb github. En cas de que no tinguem el token de login, realitzara una redireccio al client
function githubLogin(string $githubClientID, string $githubClientSecret, string $callbackUrl): \Hybridauth\Provider\GitHub
{
    $config = [
        'callback' => $callbackUrl . 'github-login', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        'keys' => ['id' => $githubClientID, 'secret' => $githubClientSecret], // Your Github application credentials
        'curl_options' => [
            CURLOPT_USERAGENT => 'mperalsapa'
        ]
    ];
    $github = new Hybridauth\Provider\GitHub($config);
    $github->authenticate();
    return $github;
}

// si el client ha iniciat sesio a github, aquesta funcio ens permet agafar el seu nom, cognom i correu electronic
// i retornem aquestes dades
function getGithubProfile(string $githubClientID, string $githubClientSecret, string $callbackUrl): array
{
    $github = githubLogin($githubClientID, $githubClientSecret, $callbackUrl);
    try {
        if ($github->authenticate("GitHub")) {
            $userProfile = $github->getUserProfile();
            $userInfo["email"] = $userProfile->email;
            if (empty($userProfile->firstName)) {
                $userInfo["name"] = $userProfile->displayName;
            } else {
                $userInfo["name"] = $userProfile->firstName;
            }
            $userInfo["surname"] = $userProfile->lastName;
        } else {
            die();
        }
    } catch (Hybridauth\Exception\HttpClientFailureException $e) {
        echo 'Curl text error message : ' . $github->getHttpClient()->getResponseClientError();
    } catch (\Exception $e) {
        echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
    }
    $github->disconnect();
    return $userInfo;
}

// aquesta funcio inicia sessio amb twitter. En cas de que no tinguem el token de login, realitzara una redireccio al client
function twitterLogin(string $twitterClientID, string $twitterClientSecret, string $callbackUrl): \Hybridauth\Provider\Twitter
{
    $config = [
        'callback' => $callbackUrl . 'twitter-login', // or Hybridauth\HttpClient\Util::getCurrentUrl()
        "enabled" => true,
        'keys' => ['key' => $twitterClientID, 'secret' => $twitterClientSecret] // Your Github application credentials
    ];
    $twitter = new Hybridauth\Provider\Twitter($config);
    $twitter->authenticate();
    return $twitter;
}

// si el client ha iniciat sesio a twitter, aquesta funcio ens permet agafar el seu nom, cognom i correu electronic
// i retornem aquestes dades
function getTwitterProfile(string $twitterClientID, string $twitterClientSecret, string $callbackUrl): array
{
    $twitter = twitterLogin($twitterClientID, $twitterClientSecret, $callbackUrl);
    try {
        if ($twitter->authenticate("Twitter")) {
            $userProfile = $twitter->getUserProfile();
            $userInfo["email"] = $userProfile->email;
            if (empty($userProfile->firstName)) {
                $userInfo["name"] = $userProfile->displayName;
            } else {
                $userInfo["name"] = $userProfile->firstName;
            }
            $userInfo["surname"] = $userProfile->lastName;
        } else {
            die();
        }
    } catch (Hybridauth\Exception\HttpClientFailureException $e) {
        echo 'Curl text error message : ' . $twitter->getHttpClient()->getResponseClientError();
    } catch (\Exception $e) {
        echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
    }
    $twitter->disconnect();
    return $userInfo;
}

// aquesta funcio agafa informacio d'usuari com el correu, nom i cognom i comprova 
// si aquest usuari ja existeix en la base de dades. En cas de ja existir, guardem les dades en la sessio
// en cas de no existir, registrem l'usuari i guardem les dades en la sessio
function socialLoginUser(array $userInfo): void
{
    include_once("src/internal/db/mysql.php");
    include_once("src/internal/db/session_manager.php");
    include_once("src/internal/viewFunctions/browser.php");
    $pdo = getMysqlPDO();
    if (userExists($pdo, $userInfo["email"])) {
        setUserLoggedinData($pdo, $userInfo["email"]);
        redirectClient("/");
    }

    $register = addUser($pdo, $userInfo["name"], $userInfo["surname"], $userInfo["email"], "");
    if ($register) {
        setUserLoggedinData($pdo, $userInfo["email"]);
        redirectClient("/");
    }
}
