<?php

// aquesta funcio agafa una resposta de la base de dades que conte les dades de les imagtes
// genera una url amb aquesta informacio i mostra la imatge
function printImages(PDOStatement $images): void
{
    require("env.php");
    global $userId;

    while ($row = $images->fetch()) {
        $url = $baseDomain . $baseUrl . $uploadsFolder . $row["fitxer"];
        if (checkLogin()) {
            $userId = getUserIDSession();
        }

        if (isset($userId) && $row["autor"] == $userId) {
            $display = "";
        } else {
            $display = "d-none";
        }
        echo "  <div style=\"width: 20%;\">
                    <div class=\"card m-1\">
                        <img src=\"$url\" class=\"card-img-top\" alt=\"...\" style=\"height:200px; aspect-ratio:1; object-fit: cover; \">
                        <div class=\"card-body d-flex justify-content-between\">
                            <div>
                                <h5 class=\"card-title\">Títol</h5>
                                <p class=\"card-text\">Marc Peral</p>
                            </div>
                            <!-- Button trigger modal -->
                            <button type=\"button\" class=\"btn btn-danger align-self-end $display\" data-bs-toggle=\"modal\" data-bs-target=\"#exampleModal\">
                                <i class=\"bi bi-trash\"></i>
                            </button>
                            <!-- Modal -->
                            <div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                                <div class=\"modal-dialog\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h5 class=\"modal-title\" id=\"exampleModalLabel\">Esborrar imatge</h5>
                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                        </div>
                                        <div class=\"modal-body\">
                                            Aquesta imatge s'esborrara de forma permanent. Si s'esta fent servir en algun article, aquest article es mantindra sense la imatge.
                                        </div>
                                        <div class=\"modal-footer\">
                                            <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
                                            <a class=\"btn btn-danger\" href=\"delete-image\">Esborrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
    }
}
