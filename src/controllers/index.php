<?php
// Marc Peral
// script que s'encarrega de l'index del lloc

// importem les funcions que farem servir
require_once("src/internal/db/session_manager.php");
require_once("src/internal/db/mysql.php");
require_once("src/internal/viewFunctions/pagging.php");
require_once("src/internal/viewFunctions/browser.php");

// Ens connectem a la base de dades	
$pdo = getMysqlPDO();

// configurem el numero d'items per pagina, es a dir, quantitat d'articles per pagina
$itemsPerPage = 5;
// si la url no conté "art" configurem $meArticles a true.
// aquest atribut fa que es mostrin els articles de l'usuari que conte sessio iniciada
// o que es mostrin tots els articles
if (isset($_GET["art"])) {
  $meArticles = $_GET["art"] == "me" ? true : false;
} else {
  $meArticles = true;
}

// comprovem si l'usuari ha iniciat sessio i vol mostrar els seus articles
// en cas de que no tingui sessio iniciada, no es podran mostrar aquests articles
if (checkLogin() && $meArticles) {
  // si l'usuari ha iniciat sessio agafem el seu id i el fem servir per agafar el numero d'articles que te
  $userid = $_SESSION["id"];
  $artCount = getArticleCountByUser($pdo, $userid);
  // si NO te 0 articles, fem els calculs de la paginacio i agafem els articles que toquen per la pagina actual
  if (!$artCount == 0) {
    $maxPage = ceil($artCount / $itemsPerPage);
    $page = getPagNumber($maxPage);
    $articles = getArticlePageByUser($pdo, $page, $itemsPerPage, $userid);
  } else {
    // si te 0 articles, definim les variables minimes per funcionar
    $articles = NULL;
    $page = 1;
    $maxPage = 1;
  }
} else {
  // en cas de voler mostrar tots els articles o no tenir una sessio iniciada
  // agafem numero d'articles totals
  $artCount = getArticleCount($pdo);

  // si tenim 0 articles, redirigim a l'arrel del lloc
  // ALERTA: si la pagina es l'arrel i aquesta te 0 articles, pot donar lloc a un bucle infinit de redireccions
  if ($artCount == 0) {
    redirectClient("/");
  }

  // calculem la paginacio i demanem els articles que toquen per la pagina actual
  $maxPage = ceil($artCount / $itemsPerPage);
  $page = getPagNumber($maxPage);
  $articles = getArticlePage($pdo, $page, $itemsPerPage);
}

// finalment mostrem la vista
require_once("src/views/index.vista.php");
