<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="bg-white rounded col-10 col-md-8 col-lg-6 col-xxl-4 mb-4">
            <div class="align-middle m-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Inici</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                    </ol>
                </nav>
                <div class="row col-12 d-flex justify-content-center m-0">
                    <div class="col-3 m-5 bg-dark d-flex rounded-circle justify-content-center align-items-center" style="aspect-ratio: 1;">
                        <p class="m-0 text-white display-4">MP</p>
                    </div>
                </div>
                <div class="row col-11 d-flex justify-content-center p-0 my-0 mx-auto">
                    <p class="p-0 m-0 text-center display-6"><?= $name ?></p>
                    <p class="p-0 m-0 text-center display-12"><?= $email ?></p>
                </div>

                <div class="row col-8 d-flex justify-content-center align-items-center mx-auto my-5">
                    <div class="row d-flex p-0 m-0">
                        <a class="btn btn-primary" href="change-email">Actualitzar Correu electronic</a>
                    </div>
                    <div class="row d-flex p-0 m-0 mt-3">
                        <a class="btn btn-primary" href="change-password">Actualitzar Contrasenya</a>
                    </div>
                    <div class="row d-flex p-0 m-0 mt-3">
                        <a class="btn btn-warning" href="logout">Tancar Sessio</a>
                    </div>
                    <div class="row d-flex p-0 m-0 mt-5">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountToggle"><i class="bi bi-trash"></i> Esborrar Compte</button>
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
                                    <button class="btn btn-danger" data-bs-target="#deleteAccountConfirmationToggle2" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="bi bi-trash"></i> Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteAccountConfirmationToggle2" aria-hidden="true" aria-labelledby="deleteAccountConfirmationToggleLabel2" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAccountConfirmationToggleLabel2">Confirmacio Definitiva</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Segurisim que vols continuar?
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="delete-account"><i class="bi bi-trash"></i> Estic segur</a>
                                </div>
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