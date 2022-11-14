<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esborrar Compte</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <form class="align-middle m-4 <?php echo $viewData["success"] ? "d-none" : ""; ?>" action="delete-account?token=<?= $viewData["token"] ?>" method="POST">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item"><a href="profile">Perfil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Esborrar Compte</li>
                    </ol>
                </nav>
                <h2>Esborrar Compte</h2>
                <div class="mt-3">
                    <?php
                    if (!empty($alertMessage)) {
                        echo "<div class=\"alert alert-$alertType\" role=\"alert\">$alertIcon $alertMessage</div>";
                    }
                    ?>
                    <div class="mt-3">
                        <button type="button" class="btn btn-danger col-12" data-bs-toggle="modal" data-bs-target="#deleteAccountToggle"><i class="bi bi-trash"></i> Esborrar Compte</button>
                    </div>



                    <div class="modal fade" id="deleteAccountToggle" aria-hidden="true" aria-labelledby="deleteAccountLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAccountLabel">Esborrar Compte</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Estas segur que vols esborrar el teu compte? Aquesta accio es irreversible. S'esborraran els teus articles per sempre.
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" value="delete" class="btn btn-danger"><i class="bi bi-trash"></i> ESBORRAR COMPTE</button>
                                </div>
                            </div>
                        </div>
                    </div>






                </div>
            </form>
            <?php
            if ($viewData["success"]) {
                echo "<div class=\"d-flex justify-content align-items-center alert alert-$alertType alert-dismissible\" role=\"alert\"><span class=\"me-3\">$alertIcon</span> $alertMessage <button type=\"button\" class=\"btn-close\" aria-label=\"Close\" data-bs-dismiss=\"alert\" ></button></div>";
            }
            ?>


        </div>

    </div>
    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>