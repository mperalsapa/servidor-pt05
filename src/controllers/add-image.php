<?php
// Marc Peral
// script que s'encarrega de mostrar la galeria d'imatges

// la funcio de pujar una imatge s'ha "inspirat" en aquest tutorial de w3schools
// https://www.w3schools.com/php/php_file_upload.asp

include_once("src/internal/viewFunctions/pagging.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/db/mysql.php");
include_once("src/internal/viewFunctions/form-error.php");
include_once("src/internal/viewFunctions/browser.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("env.php");
    $fileName = $_FILES["imageFile"]["name"];
    $targetFile = $uploadsFolder . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // comprovem si el post rebut es des d'un formulari amb un submit
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
        if ($check == false) {
            returnAlert("El fixter que s'ha introduit no es una imatge.", "danger", "src/views/add-image.vista.php", null);
        }
    } else {
        returnAlert("El fixter que s'ha introduit no es una imatge.", "danger", "src/views/add-image.vista.php", null);
    }


    // comprovem si el fitxer que volem guardar ja existeix (o un fitxer amb el mateix nom)
    if (file_exists($targetFile)) {
        returnAlert("El nom del fixer ja existeix. Canvia el nom i torna a provar.", "danger", "src/views/add-image.vista.php", null);
    }


    // comprovem si el fitxer es menor del tamany maxim
    if ($_FILES["imageFile"]["size"] > 500000) {
        returnAlert("El fitxer es massa gran.", "danger", "src/views/add-image.vista.php", null);
    }



    // comprovem si el fixer te una extensio d'imatge (jpg, png, jpeg o gif)
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        returnAlert("El fitxer no es una imatge. Els fitxers admesos son: jpg, jpeg, png i gif..", "danger", "src/views/add-image.vista.php", null);
    }


    // guardem les dades de la imatge a la base de dades. En cas d'error retornem a l'usuari l'error i no guardem.
    $pdo = getMysqlPDO();
    if (!addImage($pdo, getUserIDSession(), "", $fileName)) {
        returnAlert("El fitxer no s'ha pogut guardar. Torna a provar mes tard. Si l'error persisteix, contacta amb un administrador.", "danger", "src/views/add-image.vista.php", null);
    }

    // intentem guardar la imatge, si dona error mostrem un misatge
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $targetFile)) {
        redirectClient("gallery");
    } else {
        returnAlert("El fitxer no s'ha pogut guardar. Torna a provar mes tard. Si l'error persisteix, contacta amb un administrador.", "danger", "src/views/add-image.vista.php", null);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once("src/views/add-image.vista.php");
}
