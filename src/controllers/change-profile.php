<?php
// Marc Peral
// script per canviar email i/o contrasenya d'un compte autenticat

// importem les funcions que necesitem
include("env.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");
include_once("src/internal/viewFunctions/email.php");
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");

// si l'usuari no te una sessio iniciada, l'enviem al login ja que el perfil es una pagina per a usuaris amb compte
if (!checkLogin()) {
    redirectClient("/login");
}


// agafem el lloc de la sol·licitut, per comprovar si es email o contrasenya
$url = getPathOverBase();

// comprovem si la sol·licitut es get
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // iniciem la connexio amb la base de dades
    $pdo = getMysqlPDO();
    // comprovem si NO es canvi d'email
    if ($url != "/change-email") {
        // en cas de no ser canvi d'email, iniciem les variables de la plantilla amb la configuracio de contrasenya
        $viewData["resetPassword"] = false;
        $viewData["success"] = false;
        $viewData["postUrl"] = "/change-password";

        // mostrem la plantilla
        include_once("src/views/reset-password.vista.php");
        die();
    }
    // comprovem si NO hi tenim un token a la URL
    if (!isset($_GET["token"])) {
        // si no tenim token, hem de demanar un. Agafem les dades del usuari
        $userId = $_SESSION["id"];
        $email = getUserEmail($pdo, $userId);

        // agafem la data de l'ultim token que es va demanar
        $lastTokenTimestamp = strtotime(getLastTokenTimestamp($pdo, $email));
        $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

        $timeSinceLastTry = $actualTimestamp - $lastTokenTimestamp;
        $minWaitTimeMinute = 5;

        // comprovem si l'ultim token demanat ha sigut fa mes de 5 minuts
        if ($timeSinceLastTry < $minWaitTimeMinute * 60) {
            // en cas de no ser-ho mostrem un missatge indicant que s'ha desperar
            $message = "Has d'esperar $minWaitTimeMinute minuts des de l'anterior intent.";
            returnAlert($message, "danger", "src/views/ask-profile-token.vista.php");
        }

        // en cas de poder demanar un altre cop un token, demanem un token i el guardem a la base de dades
        $token = setResetTokenByEmail($pdo, $email);
        // provem a enviar el correu amb el token. En cas de no poder enviar-se retornem una alerta indicant-ho
        if (!sendChangeEmailToken($email, $token)) {
            returnAlert("S'ha produit un error a l'hora d'enviar el missatge. Si el problema persisteix, contacta amb un administrador", "danger", "src/views/ask-profile-token.vista.php");
        };

        // si tot ha sortit be, mostrem una alerta indicant-ho
        returnAlert("S'ha enviat un enllaç al teu correu electronic. Segueix aquest enllaç per realitzar els canvis.", "primary", "src/views/ask-profile-token.vista.php");
    }

    // en cas de si tenir token, l'agafem
    $token = $_GET["token"];
    // agafem les dades a les que pertany aquest token
    $tokenData = getResetToken($pdo, $token);

    // preparem el missatge en cas de que el token no sigui valid
    $errorMessage = "Aquest enllaç de recuperacio ha caducat. Pots demanar un enllaç de recuperacio un altre cop.";
    // comprovem si les dades del token son buides
    if (empty($tokenData)) {
        // en cas de ser buides retornem l'alerta
        returnAlert($errorMessage, "danger", "src/views/ask-profile-token.vista.php");
    }
    // si el token conté dades, agafem la caducitat del token i agafem la data actual
    $tokenTimeStamp = strtotime($tokenData["token_caducity"]);
    $actualTimestamp = strtotime(date('Y-m-d H:i:s'));

    // comprovem si la data actual es superior a la caducitat del token
    if ($actualTimestamp > $tokenTimeStamp) {
        // si la data actual es superior a la caducitat del token, retornem una alerta
        returnAlert($errorMessage, "danger", "src/views/ask-profile-token.vista.php");
    }

    // si el token es valid guardem les dades de la vista
    $viewData["token"] = $token;
    $viewData["success"] = false;
    // mostrem la vista
    include_once("src/views/change-email.vista.php");
}

// comprovem si la sol·licitut es post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // iniciem la connexio amb la base de dades
    $pdo = getMysqlPDO();
    // comprovem si NO es canvi d'email
    if ($url != "/change-email") {
        // en cas de no ser canvi d'email, iniciem les variables de la plantilla amb la configuracio de contrasenya
        $viewData["resetPassword"] = false;
        $viewData["success"] = false;

        // fem comprovacions dels camps de contrasenya
        // si la contrasenya es buida
        // si la verificacio es buida
        // si la contrasenya i la verificacio no coincideixen
        if (empty($_POST["password"])) {
            returnAlert("La contrasenya es buida, introdueix una contrasenya valida", "danger", "src/views/reset-password.vista.php", $viewData);
        }
        $password = $_POST["password"];

        if (empty($_POST["verify-password"])) {
            returnAlert("La verificacio de la contrasenya es buida, introdueix una contrasenya valida", "danger", "src/views/reset-password.vista.php", $viewData);
        }
        $password2 = $_POST["verify-password"];

        if ($password != $password2) {
            returnAlert("La verificacio de la contrasenya i la contrasenya no coincideixen. Prova un altre cop", "danger", "src/views/reset-password.vista.php", $viewData);
        }

        // si la contrasenya i la verificacio son correctes, canviem la contrasenya de l'usuari
        setUserPasswordById($pdo, $password, $_SESSION["id"]);
        // mostrem la plantilla amb "success"
        $viewData["success"] = true;
        returnAlert("S'ha canviat la contrasenya correctament.", "success", "src/views/reset-password.vista.php", $viewData);
    }

    // comprovem si el token no esta disponible
    if (!isset($_GET["token"])) {
        // en cas de no estar disponible, redirigim a la pagina de canviar email
        redirectClient("/change-email");
    }
    // si el token es valid, inicialitzem les variables de la vista
    $viewData["token"] = $_GET["token"];
    $viewData["success"] = false;

    // comprovem si el email que s'ha introduit per canviar es buit
    if (!isset($_POST["email"])) {
        // en cas de ser buit, mostrem alerta
        returnAlert("No has introduit un correu electronic.", "danger", "src/views/change-email.vista.php", $viewData);
    }
    // si es valid, guardem l'email
    $email = $_POST["email"];

    // realitzem la mateixa comprovacio que la del correu pero amb la verificacio
    if (!isset($_POST["verify-email"])) {
        returnAlert("No has introduit la verificacio del correu electronic.", "danger", "src/views/change-email.vista.php", $viewData);
    }
    $email2 = $_POST["verify-email"];

    // comprovem si el email i la verificacio coincideixen
    if ($email != $email2) {
        // en cas de no coincidir, mostrem alerta informant
        returnAlert("El correu electronic i la verificacio no coincideixen.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    // comprovem existeix un usuari amb el nou correu electronic
    if (userExists($pdo, $email)) {
        // en cas de existir, notifiquem a l'usuari
        returnAlert("Aquest correu ja s'esta fent servir en un altre compte.", "danger", "src/views/change-email.vista.php", $viewData);
    }

    // si no existeix el correu a la base de dades, canviem el correu de l'usuari que demana al correu demanat
    setUserEmail($pdo, $email, $_SESSION["id"]);

    // comprovem si existeix a la base de dades el nou correu
    if (!userExists($pdo, $email)) {
        // en cas de no existir, notifiquem que s'ha produit un error a l'hora de canviar el correu
        returnAlert("S'ha produit un error canviant el correu electronic. Si el problema persiteix contacta amb l'administrador", "danger", "src/views/change-email.vista.php", $viewData);
    }

    // si tot ha sortit be, guardem les dades de la plantilla i la mostrem
    $viewData["token"] = "";
    $viewData["success"] = true;
    returnAlert("S'ha realitzat el canvi de correu electronic correctament.", "success", "src/views/change-email.vista.php", $viewData);
}
