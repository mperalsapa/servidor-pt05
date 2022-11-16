<?php

// aquesta funcio agafa una resposta de la base de dades que conte les dades de les imagtes
// genera una url amb aquesta informacio i mostra la imatge
function printImages(PDOStatement $images): void
{
    require("env.php");

    while ($row = $images->fetch()) {
        $url = $baseDomain . $baseUrl . $uploadsFolder . $row["fitxer"];
        echo "  <div style=\"width: 20%;\">
                    <div class=\"card m-1\">
                        <img src=\"$url\" class=\"card-img-top\" alt=\"...\" style=\"height:200px; aspect-ratio:1; object-fit: cover; \">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">Títol</h5>
                            <p class=\"card-text\">Marc Peral</p>
                        </div>
                    </div>
                </div>";
        // echo "  <div class=\"m-3\">
        //             <img class=\"img-thumbnail\" style=\"max-width:200px; aspect-ratio:1; object-fit: cover;\" src=\"$url\" alt=\"wikipedia logo\">
        //         </div>";
    }
}
