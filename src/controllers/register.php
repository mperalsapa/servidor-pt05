<?php
// Marc Peral
// script que s'encarrega de registrar l'usuari correctament

// importem les funcions necessaries
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");

// comprovem si la sol·licitut es GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // redireccionem el client en cas de que ja tingui una sesio iniciada
    if (checkLogin()) {
        redirectClient("/");
    }
    // mostrem la vista de registre
    include_once("src/views/register.vista.php");
    die();
}

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // agafem les variables del formulari, i en cas de no existir en aquest, les omplim amb valors buits
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $email2 = isset($_POST["verify-email"]) ? $_POST["verify-email"] : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $password2 = isset($_POST["verify-password"]) ? $_POST["verify-password"] : '';

    // afegim les dades necesaries per mostrar la vista
    $viewData["name"] = $name;
    $viewData["lastname"] = $lastname;
    $viewData["email"] = $email;

    // fem les comprovacions dels camps del registre per veure si son buits o valids
    if (empty($name)) {
        $formResult = "<span>El camp Nom es buit</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
    if (empty($lastname)) {
        $formResult = "<span>El camp Cognom es buit</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
    if (empty($email)) {
        $formResult = "<span>El camp Email es buit</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
    if (empty($email2)) {
        $formResult = "<span>La verificacio de correu es buida</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
    if (empty($password)) {
        $formResult = "<span>El camp Contrassenya es buit</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
    if (empty($password2)) {
        $formResult = "<span>La verificacio de contrasenya es buida</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }

    if ($email != $email2) {
        $formResult = "<span>El correu i la verificacio no coincideixen</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
    if ($password != $password2) {
        $formResult = "<span>La contrasenya i la verificacio no coincideixen</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }


    // si tots els camps son correctes, iniciem una connexio amb la base de dades
    $pdo = getMysqlPDO();
    // comprovem si l'usuari ja esta registrat. En aquest cas, retornarem un error, i esborrarem el correu de la vista
    if (userExists($pdo, $email)) {
        $viewData["email"] = "";
        $formResult = "<span>Aquest correu ja pertany a un compte. Si no recordes la contrasenya, fes una recuperació aqui: <a class=\"alert-link\" href=\"lost-password\">Recuperació de contrasenya</a></span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    };

    // si l'usuari no esta registrat, l'afegim a la base de dades
    $insertsuccess = addUser($pdo, $name, $lastname, $email, $password);
    if ($insertsuccess) {
        // en cas de que l'usuari s'hagi registrat correctament, li guardarem les dades en la sessio
        setUserLoggedinData($pdo, $email);
        redirectClient("/");
    } else {
        // en cas de que l'usuari no s'hagues pogut registrar correctament, mostrem un missatge d'error
        $formResult = "<span>S'ha produit un error a l'hora de realitzar el register. Intenta-ho un altre cop.</span>";
        returnAlert($formResult, "danger", "src/views/register.vista.php", $viewData);
    }
}
