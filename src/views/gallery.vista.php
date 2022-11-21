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
        <?php
        $displayImgSelection = checkLogin() ? "" : "d-none";
        $meActive = "";
        $allActive = "";

        if (empty($displayImgSelection)) {
            if (isset($_GET["view"])) {
                if ($_GET["view"] == "all") {
                    $allActive = "active";
                } else {
                    $meActive = "active";
                }
            } else {
                $meActive = "active";
            }

            $selecting = true;
            if (empty($_GET["a"]) || $_GET["a"] != "selectImage") {
                $selecting = false;
                echo "<div class=\"btn-group m-1 $displayImgSelection\" role=\"group\" aria-label=\"Basic example\">";
                echo "<a class=\"btn btn-primary $allActive\" href=\"gallery?p=$page&view=all\">Totes</a>";
                echo "<a class=\"btn btn-primary $meActive\" href=\"gallery?p=$page&view=mine\">Meves</a>";
                echo "</div>";
            }
        }


        echo "<div class=\"d-flex flex-wrap\">";

        if ($images != null) {
            printImages($images, $selecting);
        } else {
            echo "No hi ha imatges a mostrar... ¬¬";
        }

        echo "</div>";

        printPagination($page, 1, $maxPage, 6)
        ?>
    </div>

    <?php include_once("src/internal/viewFunctions/body-end.php"); ?>
</body>

</html>