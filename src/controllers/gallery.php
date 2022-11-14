<?php
// Marc Peral
// script que s'encarrega de mostrar la galeria d'imatges
require_once("src/internal/viewFunctions/pagging.php");


// configurem el numero d'items per pagina, es a dir, quantitat d'imatges per pagina
$itemsPerPage = 20;



include_once("src/views/gallery.vista.php");
