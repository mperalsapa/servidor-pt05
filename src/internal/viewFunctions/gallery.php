<?php

// aquesta funcio agafa una resposta de la base de dades que conte les dades de les imagtes
// genera una url amb aquesta informacio i mostra la imatge
function printImages(PDOStatement $images): void
{
    require("env.php");

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
        $imageId = $row["id"];
        $imageTitle = $row["titol"];
        $userName = $row["nom"] . " " . $row["cognoms"];
        echo "  <div style=\"width: 20%;\">
                    <div class=\"card m-1\">
                        <img src=\"$url\" class=\"card-img-top\" alt=\"...\" style=\"height:200px; aspect-ratio:1; object-fit: cover; \">
                        <div class=\"card-body d-flex justify-content-between\">
                            <div>
                                <h5 class=\"card-title\">$imageTitle</h5>
                                <p class=\"card-text\">$userName</p>
                            </div>
                            <!-- Button trigger modal -->
                            <button type=\"button\" class=\"btn btn-danger align-self-end $display\" data-bs-toggle=\"modal\" data-bs-target=\"#imageModal$imageId\">
                                <i class=\"bi bi-trash\"></i>
                            </button>
                            <!-- Modal -->
                            <div class=\"modal fade\" id=\"imageModal$imageId\" tabindex=\"-1\" aria-labelledby=\"imageModalLabel$imageId\" aria-hidden=\"true\">
                                <div class=\"modal-dialog\">
                                    <div class=\"modal-content\">
                                        <div class=\"modal-header\">
                                            <h5 class=\"modal-title\" id=\"imageModalLabel$imageId\">Esborrar imatge</h5>
                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                        </div>
                                        <div class=\"modal-body\">
                                            Aquesta imatge s'esborrara de forma permanent. Si s'esta fent servir en algun article, aquest article es mantindra sense la imatge.
                                        </div>
                                        <div class=\"modal-footer\">
                                            <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Close</button>
                                            <a class=\"btn btn-danger\" href=\"delete-image?id=$imageId\">Esborrar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
    }
}
