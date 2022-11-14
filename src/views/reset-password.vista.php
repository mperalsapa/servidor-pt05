<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if ($viewData["resetPassword"]) {
            echo "Restablir contrasenya";
        } else {
            echo "Canviar contrasenya";
        } ?>
    </title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">

        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">

            <?php
            if (isset($viewData["success"])) {
                $display = $viewData["success"] ? "d-none" : "";
            } else {
                $display = "";
            }
            if ($viewData["resetPassword"]) {

                echo "<form class=\"align-middle m-4 $display\" action=\"lost-password?resetToken=$token\" method=\"POST\">";
            } else {
                echo "<form class=\"align-middle m-4 $display\" action=\"change-password\" method=\"POST\">";
            }
            ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index">Inici</a></li>
                    <?php if ($viewData["resetPassword"]) {
                        echo "<li class=\"breadcrumb-item\"><a href=\"lost-password\">Recuperar Contrasenya</a></li>";
                    } else {
                        echo "<li class=\"breadcrumb-item\"><a href=\"profile\">Perfil</a></li>";
                        echo "<li class=\"breadcrumb-item active\" aria-current=\"page\">Canviar Contrasenya</li>";
                    }
                    ?>
                </ol>
            </nav>
            <h2>
                <?php if ($viewData["resetPassword"]) {
                    echo "Restablir contrasenya";
                } else {
                    echo "Canviar contrasenya";
                } ?>
            </h2>
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
            <div class="mt-3">
                <?php
                if (!empty($alertMessage)) {
                    echo "<div class=\"d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
                }
                ?>
                <button type="submit" class="btn btn-primary col-12"><i class="bi bi-send"></i> Enviar</button>
            </div>
            </form>

            <div></div>
            <?php
            if (!$viewData["resetPassword"]) {
                if ($viewData["success"]) {
                    echo "<div class=\"my-4\">";
                    echo "<div class=\"mx-4 alert alert-$alertType\" role=\"alert\">$alertIcon $alertMessage</div>";
                    echo "<a class=\"mx-4 btn btn-primary\" href=\"index\"><i class=\"bi bi-house\"></i> Tornar a l'inici</a>";
                    echo "</div>";
                }
            }
            ?>
        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>