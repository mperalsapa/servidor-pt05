<?php
// Marc Peral
// script que s'encarrega de mostrar el perfil de l'usuari

// importem les funcions necessaries
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

// si l'usuari no te sessio iniciada, redireccionem a la pagina de login
if (!checkLogin()) {
    redirectClient("/login");
}

// guardem el id que tenim a la sessio
$userId = getUserIDSession();

// iniciem la conexio amb la base de dades
$pdo = getMysqlPDO();

// agafem el nom, cognoms i correu electronic per mostrar-ho en el perfil
$userData = getUserName($pdo, $userId);
$name = $userData["nom"] . " " . $userData["cognoms"];
$email = $userData["correu"];

// mostrem la vista del perfil
include_once("src/views/profile.vista.php");
