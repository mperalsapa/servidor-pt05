<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir Imatge</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex align-items-center justify-content-center">
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="add-image" method="POST" enctype="multipart/form-data">
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
                            <input type="text" class="form-control col-12" id="imageTitle" name="imageTitle" placeholder="Títol de la imatge">
                        </label>
                    </div>
                    <div class="mb-3 col-12">
                        <label class="col-12">Imatge
                            <input class="form-control" id="imageFile" name="imageFile" type="file" accept="image/png, image/jpeg" onchange="setImagePreview(this)">
                        </label>
                    </div>
                    <div class="col-6 mb-3 w-100 position-relative border" style="min-height: 200px;">
                        <img id="previewImage" class="w-100 rounded">
                        <span class="position-absolute translate-middle top-50 start-50">Previsualitzacio</span>
                    </div>
                    <?php
                    if (!empty($alertMessage)) {
                        echo "<div class=\"mb-3 mb-0 d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
                    }
                    ?>
                    <button type="submit" name="submit" class="btn btn-primary mt-auto">Guardar Imatge</button>
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