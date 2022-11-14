<?php
// Marc Peral
// script per esborrar articles de la base de dades


// comprovem si el metode es GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // importem les funcions que necesitem
    include_once("src/internal/db/mysql.php");
    include_once("src/internal/db/session_manager.php");
    include_once("src/internal/viewFunctions/browser.php");

    // comprovem si hi ha un id a esborrar
    // en cas de existir el guardem en una variable
    // en cas de no existir, redireccionem a l'arrel
    if (isset($_GET["id"])) {
        $articleId = intval($_GET["id"]);
    } else {
        redirectClient("/");
    }

    // comprovem si l'usuari te id
    // si no te id, vol dir que no ha iniciat sessio o es invalida. Redireccionem a l'arrel
    if (!isset($_SESSION["id"])) {
        redirectClient("/");
    }

    // agafem l'id de l'usuari
    $userId = $_SESSION["id"];

    // iniciem la connexio amb la base de dades i agafem l'autor de l'article que volem esborrar
    $pdo = getMysqlPDO();
    $articleAuthor = getArticleAuthor($pdo, $articleId);

    // si l'id del actual usuari i l'autor de l'article demanat no coincideixen, redireccionem a l'arrel
    if ($userId != $articleAuthor) {
        redirectClient("/");
    }

    // si tot es correcte, esborrem l'article i redireccionem a l'arrel
    deleteAricle($pdo, $articleId);
    redirectClient("/");
}
