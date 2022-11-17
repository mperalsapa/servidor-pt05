<?php
// Marc Peral
// script per esborrar articles de la base de dades

// importem les funcions que necesitem
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

// comprovem si el metode es GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // comprovem si hi ha un id a esborrar
    // en cas de existir el guardem en una variable
    // en cas de no existir, redireccionem a l'arrel
    if (isset($_GET["id"])) {
        $imageId = intval($_GET["id"]);
    } else {
        redirectClient("gallery");
    }

    // comprovem si l'usuari ha iniciat sessio
    // si no ha iniciat sessio, redireccionem a l'arrel
    if (!checkLogin()) {
        redirectClient("gallery");
    }

    // agafem l'id de l'usuari
    $userId = getUserIDSession();

    // iniciem la connexio amb la base de dades i agafem l'autor de la imatge que volem esborrar
    $pdo = getMysqlPDO();
    $imageAuthor = getImageAuthor($pdo, $imageId);

    // si l'id del actual usuari i l'autor de l'imatge demanada no coincideixen, redireccionem a l'arrel
    if ($userId != $imageAuthor) {
        redirectClient("gallery");
    }

    // si tot es correcte, esborrem la imatge i redireccionem a l'arrel
    if (deleteImage($pdo, $imageId)) {
        redirectClient("gallery");
    } else {
        echo "S'ha produit un error esborrant la teva imatge. Torna a provar mes tard i si el problema persisteix, contacta amb un administrador";
    }
    redirectClient("gallery");
}
