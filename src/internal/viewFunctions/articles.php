<?php
// Marc Peral
// script que s'encarrega de mostrar els articles en la pagina principal


// aquesta funcio mostra els articles que es passen
function printArticlesbyUserId(?PDOStatement $articles): void
{
    // comprovem si els articles no son buits
    if (isset($articles) && $articles != NULL) {
        // comprovem si l'id de l'usuari esta a la sessio
        if (isset($_SESSION["id"])) {
            $userId = $_SESSION["id"];
        }
        // iterem sobre cada article que hi tenim per mostrar-lo
        while ($row = $articles->fetch()) {
            echo "<div class=\" border border-dark m-4 p-4 rounded  \">";
            echo "<p>";
            echo $row["article"];
            echo "</p>";
            echo "<div>" . $row["nom"] . " " . $row["cognoms"] . " - " . $row["data"] . "</div>";
            // si tenim un id d'usuari, vol dir que pot modificar i/o esborrar un article, per lo que li mostrem els botons
            // per poder realitzar aquestes accions
            if (isset($userId)) {
                if ($userId == $row["autor"]) {
                    echo "<div class=\"mt-3\">";
                    echo "<a class=\"btn btn-sm btn-outline-primary me-3\" href=\"write-article?id=" . $row["id"] . "\"><i class=\"bi bi-pencil\"></i> Editar</a>";
                    echo "
                        <div class=\"modal fade\" id=\"articleDelete\" tabindex=\"-1\" aria-labelledby=\"articleDeleteLabel\" aria-hidden=\"true\">
                            <div class=\"modal-dialog\">
                                <div class=\"modal-content\">
                                    <div class=\"modal-header\">
                                        <h5 class=\"modal-title\" id=\"articleDeleteLabel\">Esborrar Article</h5>
                                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                    </div>
                                    <div class=\"modal-body\">
                                        Estas segur que vols esborrar aquest article? No es podra recuperar una vegada esborrat!
                                    </div>
                                    <div class=\"modal-footer\">
                                        <button type=\"button\" class=\"btn btn-primary\" data-bs-dismiss=\"modal\">Cancel·lar</button>
                                        <a class=\"btn btn-danger \" href=\"delete-article?id=" . $row["id"] . "\"><i class=\"bi bi-trash\"></i> Esborrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    echo "<button type=\"button\" class=\"btn btn-sm btn-outline-danger\" data-bs-toggle=\"modal\" data-bs-target=\"#articleDelete\">
                            <i class=\"bi bi-trash\"></i> Esborrar
                        </button>";
                    echo "</div>";
                }
            }
            echo "</div>";
        }
    } else {
        // en cas de tenir articles buits, mostrem que no hi ha
        echo "<div class=\" border border-dark m-4 p-4 rounded  \">";
        echo "<p>";
        echo "No hi ha articles disponibles. Pots afegir un article aqui: <a href=write-article> Afegir article</a>";
        echo "</p>";
        echo "</div>";
    }
};
