<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canviar Correu Electrónic</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">

        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4 <?php echo $viewData["success"] ? "d-none" : ""; ?>" action="change-email?token=<?= $viewData["token"] ?>" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item"><a href="profile">Perfil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Canviar Correu Electrónic</li>
                    </ol>
                </nav>
                <h2>Canviar Correu Electrónic</h2>
                <div class="form-group">
                    <label for="email">Correu Electronic</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text h-100"><i class="bi bi-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="email" placeholder="Correu Electronic" id="email" required value="<?php echo isset($viewData["email"]) ? $viewData["email"] : '' ?>">
                    </div>
                    <div class="invalid-feedback">Introdueix un correu electronic valid</div>
                </div>
                <div class="form-group">
                    <label for="verify-email">Verificació de Correu Electronic</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text h-100"><i class="bi bi-envelope"></i></span>
                        </div>
                        <input type="email" autocomplete="off" class="form-control" name="verify-email" placeholder="Verificació de Correu Electronic" id="verify-email" required>
                    </div>
                    <div class="invalid-feedback">Introdueix un correu electronic valid</div>
                </div>
                <div class="mt-3">
                    <?php
                    if (!empty($alertMessage)) {
                        echo "<div class=\"alert alert-$alertType\" role=\"alert\">$alertIcon $alertMessage</div>";
                    }
                    ?>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary col-12"><i class="bi bi-send"></i> Enviar</button>
                    </div>
                </div>
            </form>
            <?php
            if ($viewData["success"]) {
                echo "<div class=\"m-4 d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
            }
            ?>


        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>