<?php
// Marc Peral
// script que s'encarrega del proces de recuperacio de contrasenya

include_once("src/internal/db/mysql.php");
include_once("src/internal/viewFunctions/form-error.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/email.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["resetToken"])) {
        include_once("src/views/lost-password.vista.php");
        die();
    }
    $token = $_GET["resetToken"];

    $pdo = getMysqlPDO();
    $tokenData = getResetToken($pdo, $token);

    $errorMessage = "Aquest enllaç de recuperacio ha caducat. Pots demanar un enllaç de recuperacio un altre cop.";
    if (empty($tokenData)) {
        returnAlert($errorMessage, "danger", "src/views/lost-password.vista.php");
    }

    $tokenTimeStamp = strtotime($tokenData["token_caducity"]);
    $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

    if ($actualTimestamp < $tokenTimeStamp) {
        $viewData["resetPassword"] = true;
        include_once("src/views/reset-password.vista.php");
        die();
    }

    returnAlert($errorMessage, "danger", "src/views/lost-password.vista.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        $viewData["email"] = $email;

        if (!isset($_POST['h-captcha-response'])) {
            $formResult = "S'ha produit un error validant el captcha. Torna a probar.";
            returnAlert($formResult, "danger", "src/views/lost-password.vista.php", $viewData);
        }

        $validCaptcha = checkCaptcha($_POST['h-captcha-response']);
        if (!$validCaptcha) {
            $formResult = "No has omplert el captcha correctament. Torna a probar.";
            returnAlert($formResult, "danger", "src/views/lost-password.vista.php", $viewData);
        }

        $formResult = "Si aquest correu existeix, s'enviara un missatge amb un enllaç de recuperacio.";

        include_once("src/internal/db/mysql.php");
        $pdo = getMysqlPDO();
        if (!userExists($pdo, $email)) {
            returnAlert($formResult, "primary", "src/views/lost-password.vista.php");
        };

        $lastTokenTimestamp = strtotime(getLastTokenTimestamp($pdo, $email));
        $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

        $timeSinceLastTry = $actualTimestamp - $lastTokenTimestamp;
        $minWaitTimeMinute = 5;

        if ($timeSinceLastTry < $minWaitTimeMinute * 60) {
            $formResult = "Has d'esperar $minWaitTimeMinute minuts avans de tornar a intentar-ho.";
            returnAlert($formResult, "danger", "src/views/lost-password.vista.php", $viewData);
        }

        $token = setResetTokenByEmail($pdo, $email);
        if (!sendLostPasswordEmail($email, $token)) {
            $formResult = "S'ha produit un error a l'hora d'enviar el missatge. Si el problema persisteix, contacta amb un administrador";
            returnAlert($formResult, "danger", "src/views/lost-password.vista.php");
        };
        returnAlert($formResult, "primary", "src/views/lost-password.vista.php");
    }
    if (isset($_POST["password"])) {
        $password = $_POST["password"];
        $token = $_GET["resetToken"];

        $pdo = getMysqlPDO();
        setUserPasswordByToken($pdo, $password, $token);
        redirectClient("/login");
    }
}
