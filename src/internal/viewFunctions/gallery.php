<?php

// aquesta funcio agafa una resposta de la base de dades que conte les dades de les imagtes
// genera una url amb aquesta informacio i mostra la imatge
function printImages(PDOStatement $images, bool $selecting): void
{
    require("env.php");

    if ($selecting) {
        $selecting = "";
    } else {
        $selecting = "d-none";
    }
    while ($row = $images->fetch()) {
        $url = getImageUrl($row["fitxer"]);
        if (checkLogin()) {
            $userId = getUserIDSession();
        }

        $editing = "d-none";
        $canDelete = "d-none";
        if (isset($userId) && $row["autor"] == $userId) {
            if ($selecting != "") {
                $editing = "";
            }
            if ($row["utilitzada"] < 1) {
                $canDelete = "";
            }
        }


        $imageId = $row["id"];
        $imageTitle = $row["titol"];
        $description = $row["descripcio"];
        $userName = $row["nom"] . " " . $row["cognoms"];
        echo "  <div class=\"p-1 col-12 col-sm-6  col-lg-4 col-xl-3\">
                    <div class=\"card  h-100\">
                        <img src=\"$url\" class=\"card-img-top\" alt=\"...\" style=\"height:200px; aspect-ratio:1; object-fit: cover; \">
                        <div class=\"card-body d-flex flex-column justify-content-between\">
                            <div>
                                <h5 class=\"card-title\">$imageTitle</h5>
                                <p class=\"card-text\">$description</p>
                            </div>
                            <div>
                                <p class=\"card-text\">$userName</p>
                                <div class=\"d-flex justify-content-between\">
                                    <a class=\"$selecting btn btn-sm btn-primary\" href=gallery?selectImage=$imageId>Seleccionar</a>
                                    <a class=\"$editing btn btn-sm btn-primary\" href=add-image?id=$imageId>Editar Informacio</a>
                                    <!-- Button trigger modal -->
                                    <button type=\"button\" class=\"btn btn-danger align-self-end $canDelete\" data-bs-toggle=\"modal\" data-bs-target=\"#imageModal$imageId\">
                                        <i class=\"bi bi-trash\"></i>
                                    </button>
                                </div>
                            </div>
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

function getImageUrl(string $filename): string
{
    require("env.php");
    $path = $baseDomain . $baseUrl . $uploadsFolder . $filename;

    return $path;
}
