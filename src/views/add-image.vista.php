<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $viewData["formTitle"] ?></title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex align-items-center justify-content-center">
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="write-article<?php echo $viewData["id"] ? "?id=" . $viewData["id"] : "" ?>" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="gallery">Galeria</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Afegir Imatge</li>
                    </ol>
                </nav>
                <h1>Afegir Imatge</h1>
                <div class="d-flex flex-column">
                    <div class="mb-3 col-12">
                        <label class="col-12">Titol de la imatge
                            <input type="text" class="form-control col-12" id="title" name="title" placeholder="Títol de la imatge">
                        </label>
                    </div>
                    <div class="mb-3 col-12">
                        <label class="col-12">Imatge
                            <input class="form-control" type="file" accept="image/png, image/jpeg" id="formFile" onchange="setImagePreview(this)">
                        </label>
                    </div>
                    <div class="col-6 my-5 w-100 position-relative">
                        <img id="previewImage" class="img-fluid position-absloute border">
                        <span class="position-absolute translate-middle top-50 start-50">Previsualitzacio</span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-auto">Guardar Imatge</button>
                </div>
            </form>

        </div>
    </div>

    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
    <script>
        function setImagePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('#previewImage').src = e.target.result;

                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>