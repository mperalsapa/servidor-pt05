<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <?php include_once("src/internal/viewFunctions/header.php"); ?>
</head>

<body class="m-0 p-0 bg-dark" style="background-color:#212529">
    <?php
    include_once("src/internal/viewFunctions/navbar.php");
    ?>
    <div class="contenidor container bg-white rounded p-4">
        <div class="d-flex flex-wrap">
            <?php

            for ($i = 0; $i < 15; $i++) {
                echo "<div class=\"m-5\">
                <img class=\"img-thumbnail\" src=\"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUw-ExG4g1VwP-6ez0s4fZFjUPXN7MCWpsFrVuRcYidg&s\" alt=\"wikipedia logo\">
                </div>";
            }
            ?>

        </div>

        <?php
        printPagination(3, 1, 9, 6)
        ?>
    </div>

    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>