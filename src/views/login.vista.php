<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessió</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
    <script src='https://www.hCaptcha.com/1/api.js' async defer></script>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4" action="login" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Iniciar Sessió</li>
                    </ol>
                </nav>
                <h2>Iniciar Sessió</h2>
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
                <div class="form-group mt-4">
                    <label for="password">Contrasenya</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text h-100"><i class="bi bi-key"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" placeholder="Contrasenya" id="password" required>
                    </div>
                    <div class="invalid-feedback">Introdueix una contrasenya</div>
                </div>
                <?php
                if (!empty($alertMessage)) {
                    echo "<div class=\"mt-3 mb-0 d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
                }
                if (isset($_SESSION["login-attempts"])) {
                    if ($_SESSION["login-attempts"] > 2) {
                        echo "<label class=\"mt-3\">Captcha</label>";
                        echo "<div class=\"h-captcha\" data-sitekey=\"4d7d3404-e41b-4616-8035-8fd9b72cca7b\"></div>";
                    }
                }
                ?>
                <button type="submit" class="btn btn-primary col-12 mt-3"><i class="bi bi-send"></i> Iniciar Sessió</button>
            </form>
            <hr class="hr m-4" />
            <div class="mx-4">

                <div class="d-flex">
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center " href="register"><i class="me-2 bi bi-clipboard-minus"></i> Registre</a>
                    <a class="btn btn-secondary col d-flex align-items-center justify-content-center ms-2 " href="lost-password"><i class="me-2 bi bi-question-octagon"></i> Recuperar Contrasenya</a>
                </div>
            </div>
            <div class="accordion mt-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed p-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Social - <i class="ms-2 bi bi-google"></i> <i class="ms-1 bi bi-github"></i> <i class="ms-1 bi bi-twitter"></i>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body p-0">
                            <div class=" m-4 d-grid gap-3">
                                <a class="d-flex justify-content-center align-items-center border btn btn-primary py-3 " href="login?socialLogin=google">
                                    <i class="bi bi-google"></i>
                                    <p class="m-0 ms-3">Google</p>
                                </a>
                                <a class="d-flex justify-content-center align-items-center border btn btn-dark py-3 " href="login?socialLogin=github">
                                    <i class="bi bi-github"></i>
                                    <p class="m-0 ms-3">Github</p>
                                </a>
                                <a class="d-flex justify-content-center align-items-center border btn btn-info py-3 " href="login?socialLogin=twitter">
                                    <i class="bi bi-twitter"></i>
                                    <p class="m-0 ms-3">Twitter</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>