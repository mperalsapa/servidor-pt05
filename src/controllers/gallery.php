<?php
// Marc Peral
// script que s'encarrega de mostrar la galeria d'imatges
include_once("src/internal/viewFunctions/pagging.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/db/mysql.php");
include_once("src/internal/viewFunctions/gallery.php");


if (isset($_GET["view"])) {
    $meImg = $_GET["view"] == "mine" ? true : false;
} else {
    $meImg = true;
}

// configurem el numero d'items per pagina, es a dir, quantitat d'imatges per pagina
$itemsPerPage = 5;

// agafem de la base de dades el numero d'imatges que hi ha, depenent de si l'usuari ha iniciat sesio o no
$pdo = getMysqlPDO();
if (checkLogin() && $meImg) {
    $userId = getUserIDSession();
    $imageCount = getImageCountByUserID($pdo, getUserIDSession());
    $maxPage = ceil($imageCount / $itemsPerPage);
    $page = getPagNumber($maxPage);
    $images = getImagePageByUserID($pdo, $page, $itemsPerPage, getUserIDSession());
} else {
    $imageCount = getImageCount($pdo);
    $maxPage = ceil($imageCount / $itemsPerPage);
    $page = getPagNumber($maxPage);
    $images = getImagePage($pdo, $page, $itemsPerPage);
}

include_once("src/views/gallery.vista.php");
