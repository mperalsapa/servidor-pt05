<?php
// Marc Peral
// script que s'encarrega del proces de tancar sessio

// importem les funcions necessaries
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");

// si l'usuari te una sessio iniciada, la destruim i redireccionem a l'arrel
if (checkLogin()) {
    session_destroy();
    redirectClient("/");
}
