<?php
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");

if (!checkLogin()) {
    redirectClient("/");
}

include("env.php");

$pdo = getMysqlPDO();
$userId = getUserIDSession();
$imageFileList = getUserImageFiles($pdo, $userId);
$viewData["files"] = $imageFileList;
$viewData["replace"] = "";
$viewData["replace-for"] = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    include_once("src/views/rename-image-filename.vista.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST["replace"])) {
        returnAlert("No has introduit una cadena de text a reemplaçar", "danger", "src/views/rename-image-filename.vista.php", $viewData);
    }
    $replaceString = $_POST["replace"];
    $viewData["replace"] = $replaceString;

    if (!isset($_POST["replace-for"])) {
        returnAlert("No has introduit una cadena com a reemplaçament", "danger", "src/views/rename-image-filename.vista.php", $viewData);
    }
    $replaceForString = $_POST["replace-for"];
    $viewData["replace-for"] = $replaceForString;

    foreach ($imageFileList as $i) {
        $file = $i["fitxer"];

        $newFileName = str_replace($replaceString, $replaceForString, $file);
        if ($newFileName == $file) {
            continue;
        }

        $viewData["files"] = getUserImageFiles($pdo, $userId);
        if (file_exists($uploadsFolder . $newFileName)) {
            returnAlert("Aquest fitxer ja existeix, prova a posar un altre nom.", "danger", "src/views/rename-image-filename.vista.php", $viewData);
        }

        if (file_exists($uploadsFolder . $file)) {
            if (rename($uploadsFolder . $file, $uploadsFolder . $newFileName)) {
                if (!renameImageFile($pdo, $file, $newFileName)) {
                    rename($uploadsFolder . $newFileName, $uploadsFolder . $file);
                    returnAlert("S'ha produit un error a l'hora de canviar el nom del fitxer.", "danger", "src/views/rename-image-filename.vista.php", $viewData);
                }
                continue;
            }
        }
        returnAlert("El fitxer que es vol modificar no existeix. Contacta amb l'administrador", "danger", "src/views/rename-image-filename.vista.php", $viewData);
    }
    $viewData["files"] = getUserImageFiles($pdo, $userId);
    returnAlert("S'ha canviat el nom del fitxer correctament.", "success", "src/views/rename-image-filename.vista.php", $viewData);
}
