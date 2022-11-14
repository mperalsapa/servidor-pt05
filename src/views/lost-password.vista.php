<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contrasenya</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">

        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="lost-password" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Recuperar Contrasenya</li>
                    </ol>
                </nav>
                <h2>Recuperar Contrasenya</h2>
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
                <?php
                if (!empty($alertMessage)) {
                    echo "<div class=\" mt-3 mb-0 d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
                }
                ?>

                <label class="mt-3">Captcha</label>
                <div class="h-captcha" data-sitekey="4d7d3404-e41b-4616-8035-8fd9b72cca7b"></div>
                <button type="submit" class="btn btn-primary col-12 mt-3"><i class="bi bi-send"></i> Enviar</button>
            </form>
            <hr class="hr m-4" />
            <div class="m-4">

                <div class="d-flex flex">
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center" href="login"><i class="me-2 bi bi-box-arrow-in-right"></i> Iniciar Sessió</a>
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center ms-2" href="register"><i class="me-2 bi bi-clipboard-minus"></i> Registre</a>
                </div>
            </div>

        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>