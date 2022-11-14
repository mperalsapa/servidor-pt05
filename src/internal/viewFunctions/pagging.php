<?php
// Marc Peral
// script que s'encarrega de mostrar la paginacio a l'hora de mostrar els articles

// aquesta funcio, agafa de la base de dades el numero d'articles que hi ha a la base de dades
// fa un calcul en base a un parametre, i retorna el numero maxim de pagines segons el numero d'articles
// que volem per pagina
function checkMaxPage(PDO $conn, int $itemsPerPage): int
{
    if (empty($itemsPerPage) || $itemsPerPage < 1) {
        $itemsPerPage = 3;
    }
    $pdo = $conn->prepare('SELECT count(*) as count FROM article');
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    $count = ceil($count / $itemsPerPage);
    return $count;
}


// aquesta funcio neteja la entrada del parametre de pagina
// si el la pagina introduida es buida, redirigim a la primera pagina
// si el la pagina introduida no coincideix amb la evaluacio redirigim a la evaluacio
// per exemple, si introduim "123cjedcju1", la evaluacio es 123. 
// si la pagina es 0, redirigim a la 1
// finalment si la apgina es major que el numero maxim de pagines, redirigim al la pagina maxima
function getPagNumber(int $maxPage): int
{
    if (empty($_GET["p"])) {
        return 1;
    }

    $pag = intval($_GET["p"]);

    if ($pag != $_GET["p"]) {
        redirectClient("?p=$pag");
    }
    if ($pag < 1) {
        redirectClient("?p=1");
    }
    if ($pag > $maxPage) {
        redirectClient("?p=$maxPage");
    }

    return $pag;
}

// aquesta funcio mostra els botons de paginacio sense ningun calcul
function printStaticPagination(int $page, int $maxPage): void
{
    for ($actualPage = 1; $actualPage <= $maxPage; $actualPage++) {
        printPaginationButton($actualPage, $page);
    }
}

// aquesta funcio mostra els botons de paginacio calculant si s'ha de "moure" per que la pagina actual sigui al mi
// per exemple, si com a la pagina 6, hauria de ser aixi (tenin en compte que volem 5 botons de paginacio) 4 5 6 7 8 
function printDynamicPagination(int $page, int $maxPagination, int $maxPage, int $minPage): void
{

    // fem una comprovacio de si es parell. En cas de ser parell, li sumarem un per que no sigui parell
    // ja que volem que hi hagi un boto de paginacio en mig, per exemple: volem 3 4 5 en comptes de 3 4 5 6
    if (!fmod($maxPagination, 2)) {
        $maxPagination++;
    }

    // configurem un offset per fer servir a l'hora de comprovar si som al maxim o minim de la paginacio
    $offs = ($maxPagination - 1) / 2;

    // iniciem un bucle per mostrar els botons
    for ($p = 1; $p <= min($maxPage, $maxPagination); $p++) {

        // uniciem un bucle anidat per fer les comprovacions de si som a prop del maxim o minim de la paginacio
        // el numero de iteracions depen del offset, que aquest depen del tamany de la paginacio. Si tenim 5 botons de pagina
        // el bucle fara 2 iteracions ja que es el que hi ha en un costat
        for ($i = 0; $i < $offs; $i++) {
            // comprovem el costat del principi
            if ($minPage + $i == $page) {
                // si som al costat del pricipi
                // calculem el offset per al principi
                $actualPage = $p - ($i + 1);
                $extreme = true;
                break;
            }
            // comprovem el costat del final
            if ($maxPage - $i == $page) {
                // si som al costat del final
                // calculem l'offset per al final
                $actualPage = ($p - $maxPagination) + $i;
                $extreme = true;
                break;
            }
        }

        // si som a un extrem, no calculem en base al centre de la paginacio
        if (!isset($extreme)) {
            $actualPage = $p - $offs - 1;
        }

        // finalment afegim la pagina als calculs que hem fet
        $actualPage = $page + $actualPage;

        // finalment mostrem el boto amb la pagina calculada anteriorment
        printPaginationButton($actualPage, $page);
    }
}

// aquesta funcio mostra un boto de paginacio, i si es la pagina actual, el mostra inhabilitat
function printPaginationButton(int $actualPage, int $page): void
{
    $visibility = getPaginationVisibility();
    if ($actualPage == $page) {
        echo "<li class=\"page-item active user-select-none\"><a class=\"page-link\" >$actualPage</a></li>";
    } else {
        echo "<li class=\"page-item \"><a class=\"page-link\" href=\"?p=$actualPage" . $visibility . "\">$actualPage</a></li>";
    }
}

// aquesta funcio mostra el primer boto de paginacio, (<< Primera)
function printFirstPage(int $page, int $minPage): void
{
    echo "<li class=\"page-item\">";
    if ($page == $minPage) {
        echo "<li class=\"page-item disabled\">";
    } else {
        echo "<li class=\"page-item\">";
    }
    $visibility = getPaginationVisibility();
    echo "<a class=\"page-link\" href=\"?p=$minPage" . $visibility . "\" aria-label=\"Next\">";
    echo "      <i class=\"bi bi-chevron-double-left\"></i>
    <span class=\"sr-only\">Primera</span>
    </a>
    </li>";
}

// aquesta funcio mostra el ultim boto de paginacio, (Ultima >>)
function printLastPage(int $page, int $maxPage): void
{
    echo "<li class=\"page-item\">";
    if ($page == $maxPage) {
        echo "<li class=\"page-item disabled\">";
    } else {
        echo "<li class=\"page-item\">";
    }
    $visibility = getPaginationVisibility();
    echo "<a class=\"page-link\" href=\"?p=$maxPage" . $visibility . "\" aria-label=\"Next\">";
    echo "      <span class=\"sr-only\">Ultima</span>
                <i class=\"bi bi-chevron-double-right\"></i>
			</a>
		</li>";
}

// aquesta funcio mostra el primer i ultim boto de paginacio, i decideix si mostrar paginacio dinamica o estatica
function printPagination(int $page, int $minPage, int $maxPage, int $maxPagination): void
{
    echo "<nav><ul class=\"pagination justify-content-center p-5 mt-5\">";
    printFirstPage($page, $minPage);
    if ($maxPage < $maxPagination) {
        printStaticPagination($page, $maxPage);
    } else {
        printDynamicPagination($page, $maxPagination, $maxPage, $minPage);
    }
    printLastPage($page, $maxPage);
    echo "</ul></nav>";
}

// aquesta funcio decideix si la paginacio es publica o privada
// ja que un usuari amb sessio iniciada, pot decidir si veure els seus articles o el de tots
function getPaginationVisibility(): string
{
    if (!isset($_GET["art"])) {
        return "";
    }
    if ($_GET["art"] == "all") {
        return "&art=all";
    } else {
        return "&art=me";
    }
}
