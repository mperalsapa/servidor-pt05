<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <title>Registre</title>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="register" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registrar-se</li>
                    </ol>
                </nav>
                <div class="row">
                    <label>Nom
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo isset($viewData["name"]) ? $viewData["name"] : '' ?>">
                    </label>
                </div>
                <div class="row mt-2">
                    <label>Cognoms
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Cognoms" value="<?php echo isset($viewData["lastname"]) ? $viewData["lastname"] : '' ?>">
                    </label>
                </div>

                <div class="row mt-2">
                    <label>Correu Electronic
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text h-100"><i class="bi bi-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correu Electronic" value="<?php echo isset($viewData["email"]) ? $viewData["email"] : '' ?>">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">
                    <label>Verificacio Correu Electronic
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text h-100"><i class="bi bi-check-all"></i></span>
                            </div>
                            <input type="email" class="form-control" id="verify-email" name="verify-email" placeholder="Correu Electronic" autocomplete="off">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">
                    <label>Contrasenya
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text h-100"><i class="bi bi-key"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contrasenya">
                        </div>
                    </label>
                </div>
                <div class="row mt-2">
                    <label>Verificacio Contrasenya
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text h-100"><i class="bi bi-check-all"></i></span>
                            </div>
                            <input type="password" class="form-control" id="verify-password" name="verify-password" placeholder="Contrasenya">
                        </div>
                    </label>
                </div>
                <?php
                if (!empty($alertMessage)) {
                    echo "<div class=\"mt-3 d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
                }
                ?>
                <button type="submit" class="btn btn-primary col-12 mt-3"><i class="bi bi-pen"></i> Registrar</button>
            </form>
            <hr class="hr m-4" />
            <div class="m-4">

                <div class="d-flex flex">
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center" href="login"><i class="me-2 bi bi-box-arrow-in-right"></i> Iniciar Sessió</a>
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center ms-2" href="lost-password"><i class="me-2 bi bi-question-octagon"></i> Recuperar Contrasenya</a>
                </div>
            </div>
        </div>

    </div>

    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>