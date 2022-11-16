<!-- navbar del lloc -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 pb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="index">Articles de Pel·licules</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- TODO: dynamic "active" link based on actual page -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index">Inici</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="gallery">Galeria</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Legal
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="tos">Terms de servei</a></li>
                        <li><a class="dropdown-item" href="privacy">Privacitat</a></li>
                        <li><a class="dropdown-item" href="contact">Contacte</a></li>
                    </ul>
                </li>
                <li>
                    <?php
                    include_once("src/internal/db/session_manager.php");
                    if (checkLogin()) {
                        include_once("src/internal/db/mysql.php");
                        include_once("src/internal/viewFunctions/browser.php");

                        $pdo = getMysqlPDO();
                        $pagePath = getPathOverBase(false);
                        if ($pagePath == "gallery" || $pagePath == "add-image") {
                            $badgeText = "Afegir Image";
                            $badgeUrl = "add-image";
                            $badgeCount = getImageCountByUserID($pdo, $_SESSION["id"]);
                        } else {
                            $badgeText = "Nou Article";
                            $badgeUrl = "write-article";
                            $badgeCount = getArticleCountByUser($pdo, $_SESSION["id"]);
                        }
                        echo "<a class=\"ms-3 nav-link bg-primary rounded text-white\" href=\"$badgeUrl\"><i class=\"bi bi-plus-square\"></i> $badgeText <span class=\"badge bg-secondary\">$badgeCount</span></a>";
                    }
                    ?>
                </li>
            </ul>




            <ul class="nav-item dropstart m-0 p-0">
                <a class="nav-link dropdown-toggle text-white bg-primary rounded" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    if (checkLogin()) {
                        $nameInitial = $_SESSION['name-initial'];
                        $surnameInitial = $_SESSION['surname-initial'];

                        echo "<span class=\"my-0\">$nameInitial$surnameInitial</span>";
                    } else {
                        echo "<i class=\"bi bi-person-fill\"></i>";
                    }


                    ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    include_once("src/internal/db/session_manager.php");
                    include_once("src/internal/viewFunctions/browser.php");
                    if (checkLogin()) {
                        echo "<li><a class=\"dropdown-item\" href=\"profile\"><i class=\"bi bi-person-fill\"></i> Perfil</a></li>";
                        echo "<li><a class=\"dropdown-item\" href=\"logout?redirect=" . getPathOverBase(false) .  "\"><i class=\"bi bi-box-arrow-right\"></i> Tancar sesió</a></li>";
                    } else {
                        echo "<li><a class=\"dropdown-item\" href=\"login\"><i class=\"bi bi-box-arrow-in-right\"></i> Iniciar Sessió</a></li>";
                        echo "<li><a class=\"dropdown-item\" href=\"register\"><i class=\"bi bi-clipboard-minus\"></i> Registrarse</a></li>";
                    } ?>
                </ul>
            </ul>

        </div>
    </div>
</nav>