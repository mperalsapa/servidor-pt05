<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renombrar fitxers</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">

        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-6 mb-4 d-flex flex-row p-4">
            <form class="col me-4" action="rename-image-filename" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="gallery">Galeria</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Renombrar</li>
                    </ol>
                </nav>
                <h2>Renombrar fitxers</h2>
                <div class="form-group">
                    <label for="replace">Cadena de text a reemplaçar</label>
                    <input type="text" class="form-control" name="replace" placeholder="Cadena de text a reemplaçar" id="replace" required value="<?= $viewData["replace"] ?>">
                    <div class="invalid-feedback">Introdueix un correu electronic valid</div>
                </div>
                <div class="form-group mt-4">
                    <label for="replace-for">Nova cadena de text</label>
                    <input type="text" class="form-control" name="replace-for" placeholder="Nova cadena de text" id="replace-for" required value="<?= $viewData["replace-for"] ?>">
                    <div class="invalid-feedback">Introdueix una contrasenya</div>
                </div>
                <?php

                if (!empty($alertMessage)) {
                    echo "<div class=\"mt-3 mb-0 d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
                }
                ?>
                <button type="submit" class="btn btn-primary col-12 mt-3"><i class="bi bi-send"></i> Iniciar Sessió</button>
            </form>
            <div class="col d-flex flex-column " style="max-height: 300px;">
                Fitxers en propietat
                <div class=" d-flex flex-wrap border overflow-auto ">

                    <ul class="list-group col-12">
                        <?php
                        $files = $viewData["files"];
                        if ($files->rowCount() == 0) {

                            echo "<li class=\"list-group-item\">No tens ninguna imatge</li>";
                            $files = null;
                        }
                        while ($row = $viewData["files"]->fetch()) {

                            echo "<li class=\"list-group-item\"> " . $row["fitxer"] . "</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>