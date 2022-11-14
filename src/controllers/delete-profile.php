<?php
// Marc Peral
// script per esborrar compte d'un usuari

// importem les funcions que necesitem
include("env.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");
include_once("src/internal/viewFunctions/email.php");
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");

// comprovem si no s'ha iniciat sessio
if (!checkLogin()) {
    redirectClient("/login");
}

// agafem el lloc de la sol·licitut, per comprovar si es email o contrasenya
$url = getPathOverBase();

// comprovem si la sol·licitut es GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // iniciem la connexio amb la base de dades
    $pdo = getMysqlPDO();
    // comprovem si NO hi tenim un token a la URL
    if (!isset($_GET["token"])) {
        // si no hi ha token disponible, agafem les dades del usuari actual
        $userId = $_SESSION["id"];
        $email = getUserEmail($pdo, $userId);

        // agafem les dades del token associat al compte
        $lastTokenTimestamp = strtotime(getLastTokenTimestamp($pdo, $email));
        $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

        $timeSinceLastTry = $actualTimestamp - $lastTokenTimestamp;
        $minWaitTimeMinute = 5;

        // comprovem si l'anterior token s'ha generat avans de 5 minuts, si es aixi retornem misatge
        if ($timeSinceLastTry < $minWaitTimeMinute * 60) {
            $message = "Has d'esperar $minWaitTimeMinute minuts des de l'anterior intent.";
            returnAlert($message, "danger", "src/views/ask-profile-token.vista.php");
        }

        // si la comprovacio de l'anterior token es valid, generem un token nou
        $token = setResetTokenByEmail($pdo, $email);
        // enviem el token per correu electronic. En cas de no poder enviar-se retornem una alerta indicant-ho
        if (!sendDeleteAccountToken($email, $token)) {
            returnAlert("S'ha produit un error a l'hora d'enviar el missatge. Si el problema persisteix, contacta amb un administrador", "danger", "src/views/ask-profile-token.vista.php");
        };

        // si tot ha sortit correctament, indiquem que s'ha enviat un enllaç per correu electronic
        returnAlert("S'ha enviat un enllaç al teu correu electronic. Segueix aquest enllaç per realitzar els canvis.", "primary", "src/views/ask-profile-token.vista.php");
    }

    // si tenim un token disponible, el guardem, i agafem les dades del token a la base de dades
    $token = $_GET["token"];
    $tokenData = getResetToken($pdo, $token);

    // preparem el missatge de error i comprovem si el token es valid o ha caducat
    $errorMessage = "Aquest enllaç de recuperacio ha caducat. Pots demanar un enllaç de recuperacio un altre cop.";
    if (empty($tokenData)) {
        returnAlert($errorMessage, "danger", "src/views/ask-profile-token.vista.php");
    }
    $tokenTimeStamp = strtotime($tokenData["token_caducity"]);
    $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

    if ($actualTimestamp > $tokenTimeStamp) {
        returnAlert($errorMessage, "danger", "src/views/ask-profile-token.vista.php");
    }

    // si el token no ha caducat, preparem les dades de la vista i la mostrem
    $viewData["token"] = $token;
    $viewData["success"] = false;
    include_once("src/views/delete-profile.vista.php");
}

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // preparem les dades de la vista
    $viewData["token"] = "";
    $viewData["success"] = true;

    // si submit no esta present o no es "delete" retornem un error, ja que el boto de esborrar del formulari conté aquestes dades
    if (!isset($_POST["submit"]) || $_POST["submit"] != "delete") {
        returnAlert("S'ha produit un error a l'hora d'esborrar el compte, prova un altre cop. Si el problema persisteix, contacta amb un administrador.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    // preparem la conexio amb  la base de dades
    $pdo = getMysqlPDO();

    // si tot es correcte, esborrem l'usuari, esborrem la sessio, i finalment mostrem missatge de que s'ha esborrat l'usuari correctament
    removeUserAccount($pdo, getUserIDSession());
    session_destroy();
    returnAlert("S'ha esborrat el compte correctament.", "success", "src/views/change-email.vista.php", $viewData);
}
