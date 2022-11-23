<?php
// Marc Peral
// script que s'encarrega de crear articles nous o modificar articles existents

// importem les funcions necessaries
include_once("src/internal/db/mysql.php");
include_once("src/internal/db/session_manager.php");
include_once("src/internal/viewFunctions/browser.php");
include_once("src/internal/viewFunctions/form-error.php");

// funcio per generar els camps que conte la vista de crear articles
function getArticleData(int $articleId = NULL): array
{
    // si l'id del article es NULL, retornem un array conforme es vol crear un nou article
    if (is_null($articleId)) {
        $result = array(
            "formTitle" => "Nou Article",
            "formSubmitButton" => "Crear",
            "date" => "",
            "article" => "",
            "articleTitle" => "",
            "imageId" => 0,
            "id" => 0,
            "canDelete" => 0
        );
        setLastArticleWrite($result["id"]);
        return $result;
    }

    // en cas de no ser null, agafem les dades del article que volem modificar
    $pdo = getMysqlPDO();
    $row = getArticleById($pdo, $articleId);
    $row = $row->fetch();

    // comprovem que l'autor que esta accedint correspon amb l'autor de l'article original
    $articleAuthor = $row["autor"];
    if ($articleAuthor != $_SESSION['id']) {
        redirectClient("/");
    }

    // si tot es correcte, guardem l'article i el retornem
    $result = array(
        "formTitle" => "Editar Article",
        "formSubmitButton" => "Guardar",
        "date" => $row["data"],
        "article" => $row["article"],
        "articleTitle" => $row["titol"],
        "imageId" => $row["imatge"],
        "id" => $row["id"],
        "canDelete" => 1
    );

    setLastArticleWrite($result["id"]);
    return $result;
}

if (!checkLogin()) {
    redirectClient("/");
}

// comprovem si la sol·licitut es GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // mostrem "nou article" si no hi ha id, o agafem les dades del article si tenim id
    if (!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        $viewData = getArticleData($id);
    } else {
        $viewData = getArticleData();
    }

    if (!empty($_GET["newImage"])) {
        $imageId = $_GET["newImage"];
        $viewData["imageId"] = $imageId;
    }

    // mostrem la vista
    include_once("src/views/write-article.vista.php");
}

// comprovem si la sol·licitut es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // mostrem "nou article" si no hi ha id, o agafem les dades del article si tenim id
    if (!empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        $viewData = getArticleData($id);
    } else {
        $viewData = getArticleData();
    }

    if (empty($_POST["articleTitle"])) {
        $formResult = "El titol de l'article es buit.";
        returnAlert($formResult, "danger", "src/views/write-article.vista.php", $viewData);
    }
    $viewData["articleTitle"] = $_POST["articleTitle"];

    // comprovem si els camps del formulari son buits. Si ho son, mostrem error informant. Si no ho son, els guardem
    if (empty($_POST["article"])) {
        $formResult = "L'article es buit, si el vols esborrar, fes clic a esborrar.";
        returnAlert($formResult, "danger", "src/views/write-article.vista.php", $viewData);
    }
    $viewData["article"] = $_POST["article"];

    if (empty($_POST["article-date"])) {
        $formResult = "La data de l'article es buida.";
        returnAlert($formResult, "danger", "src/views/write-article.vista.php", $viewData);
    }
    $viewData["date"] = $_POST["article-date"];

    $viewData["imageId"] = intval($_POST["imageId"]);

    // iniciem connexio amb la base de dades. Si l'id no es present, vol dir que hem d'afegir un nou article
    $pdo = getMysqlPDO();
    if (!isset($_GET["id"])) {
        addArticle($pdo, $_SESSION["id"], $viewData["articleTitle"], $viewData["article"], $viewData["imageId"], $viewData["date"]);
        redirectClient("/");
    }

    // en cas d'haver-hi id, actualitzem l'article
    $articleId = $_GET["id"];
    updateArticle($pdo, $articleId, $viewData["articleTitle"], $viewData["article"], $viewData["imageId"], $viewData["date"]);
    redirectClient("/");
}
