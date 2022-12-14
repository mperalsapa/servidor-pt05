<?php
// Marc Peral 2DAW

// aquesta funcio s'encarrega de connectar amb la base de dades
// si es produeix un error, indiquem a l'usuari que s'ha produit un error i que contacti amb l'administrador
function getMysqlPDO(): PDO
{
    include("env.php");
    $servername = $mysqlHost;
    $username = $mysqlUser;
    $password = $mysqlPassword;
    $dbname = $mysqlDB;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
        echo "<p>S'ha produit un error a l'hora de connectarse amb la base de dades. Contacta amb un administrador.</p>";
        echo "<p>Error: $e</p>";
        die();
    }

    return $conn;
}

// aquesta funcio ens retorna tots els articles, es una funcio de prova
function getArticles(PDO $conn): PDOStatement
{
    $pdo = $conn->prepare('SELECT * from article');
    $pdo->execute();
    return $pdo;
}

// aquesta funcio ens retorna els articles amb paginacio
// segons la pagina en la que ens trobem i el numero maxim d'articles per pagina
// ens retornara uns articles o uns altres (paginacio)
function getArticlePage(PDO $conn, int $page, int $maxArtPerPage): PDOStatement
{
    $minim = ($page * $maxArtPerPage) - $maxArtPerPage;
    $maxim = $maxArtPerPage;
    $pdo = $conn->prepare("SELECT a.id, a.titol, i.fitxer, a.article, a.autor, DATE_FORMAT(a.data, '%d/%m/%Y') as data, u.nom, u.cognoms FROM article a INNER JOIN usuari u ON u.id = a.autor LEFT JOIN imatge i ON i.id = a.imatge ORDER BY a.data DESC LIMIT :minLimit, :maxLimit ");
    $pdo->bindParam(":minLimit", $minim, PDO::PARAM_INT);
    $pdo->bindParam(":maxLimit", $maxim, PDO::PARAM_INT);
    $pdo->execute();

    return $pdo;
}

function getArticlePageByUser(PDO $conn, int $page, int $maxArtPerPage, int $userId): PDOStatement
{
    $min = ($page * $maxArtPerPage) - $maxArtPerPage;
    $max = $maxArtPerPage;
    $pdo = $conn->prepare("SELECT a.id, a.titol, i.fitxer, a.article, a.autor, DATE_FORMAT(a.data, '%d/%m/%Y') as data, u.nom, u.cognoms FROM article a INNER JOIN usuari u ON u.id = a.autor LEFT JOIN imatge i ON i.id = a.imatge WHERE a.autor = :autorId ORDER BY a.data DESC LIMIT :minLimit, :maxLimit ");
    $pdo->bindParam(":autorId", $userId, PDO::PARAM_INT);
    $pdo->bindParam(":minLimit", $min, PDO::PARAM_INT);
    $pdo->bindParam(":maxLimit", $max, PDO::PARAM_INT);
    $pdo->execute();

    return $pdo;
}

// aquesta funcio ens retorna el numero de articles totals en la base de dades
function getArticleCount(PDO $conn): int
{
    $pdo = $conn->prepare('SELECT count(*) as count FROM article');
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    return $count;
}
function getArticleCountByUser(PDO $conn, int $userId): int
{
    $pdo = $conn->prepare('SELECT count(*) as count FROM article WHERE article.autor = :autorId');
    $pdo->bindParam(":autorId", $userId);
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    return $count;
}

function getArticleAuthor(PDO $conn, int $articleId): int
{
    $pdo = $conn->prepare("SELECT autor FROM article WHERE article.id = :articleId");
    $pdo->bindParam(":articleId", $articleId);
    $pdo->execute();
    if ($pdo->rowCount() < 1) {
        return -1;
    }
    return $pdo->fetch()["autor"];
}

function userExists(PDO $conn, string $email): bool
{
    $pdo = $conn->prepare('SELECT count(*) as count FROM usuari WHERE correu = :correu');
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $count = $pdo->fetch()["count"];
    if ($count > 0) {
        return true;
    };
    return false;
}

function addUser(PDO $conn, string $name, ?string $lastname, string $email, ?string $password): bool
{
    $password = hash("sha256", $password, false);
    $pdo = $conn->prepare("INSERT INTO `usuari` (`nom`, `cognoms`, `correu`, `contrasenya`) VALUES (:nom, :cognoms, :correu, :contrasenya)");
    $pdo->bindParam(":nom", $name);
    $pdo->bindParam(":cognoms", $lastname);
    $pdo->bindParam(":correu", $email);
    $pdo->bindParam(":contrasenya", $password);
    return $pdo->execute();
}

function checkUserPassword(PDO $conn, string $password, string $email): bool
{
    $password = hash("sha256", $password, false);
    $pdo = $conn->prepare("SELECT usuari.contrasenya FROM usuari WHERE usuari.correu LIKE :correu ");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $dbPassword = $pdo->fetch()["contrasenya"];
    if ($password == $dbPassword) {
        return true;
    }
    return false;
}

function getUserInitials(PDO $conn, string $email): array
{
    $pdo = $conn->prepare("SELECT usuari.nom, usuari.cognoms FROM usuari WHERE usuari.correu LIKE :correu");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $row = $pdo->fetch();
    $name = $row["nom"];
    $surname = $row["cognoms"];
    $initials[0] = $name[0];
    $initials[1] = $surname[0];

    return $initials;
}

function getUserID(PDO $conn, string $email): int
{
    $pdo = $conn->prepare("SELECT usuari.id FROM usuari WHERE usuari.correu LIKE :correu");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $id = $pdo->fetch()["id"];
    return $id;
}


function addArticle(PDO $conn, int $userId, string $articleTitle, string $article, ?int $imageId, string $date): void
{
    $pdo = $conn->prepare("INSERT INTO article (titol, article, autor, imatge, data) VALUES (:articleTitle, :article, :userId, :imageId, :articleDate)");
    $pdo->bindParam(":articleTitle", $articleTitle);
    $pdo->bindParam(":article", $article);
    $pdo->bindParam(":userId", $userId);
    $pdo->bindParam(":imageId", $imageId, PDO::PARAM_INT);
    $pdo->bindParam(":articleDate", $date);
    $pdo->execute();
}

function updateArticle(PDO $conn, int $articleId, string $articleTitle, string $article, ?int $imageId, string $date): void
{
    echo "updating article. id: $articleId <br> body: $article. <br> Image id: $imageId <br> date: $date";
    $pdo = $conn->prepare("UPDATE article SET titol = :articleTitle,  article = :article, imatge = :imageId, data = :articleDate WHERE article.id = :articleId");
    $pdo->bindParam(":articleTitle", $articleTitle);
    $pdo->bindParam(":article", $article);
    $pdo->bindParam(":articleDate", $date);
    $pdo->bindParam(":imageId", $imageId, PDO::PARAM_INT);
    $pdo->bindParam(":articleId", $articleId);
    $pdo->execute();
}
function deleteAricle(PDO $conn, int $articleId): void
{
    $pdo = $conn->prepare("DELETE FROM article WHERE article.id = :articleId");
    $pdo->bindParam(":articleId", $articleId);
    $pdo->execute();
}


function getArticleById(PDO $conn, int $articleId): PDOStatement
{
    $pdo = $conn->prepare("SELECT * FROM article WHERE id = :articleId");
    $pdo->bindParam("articleId", $articleId, PDO::PARAM_INT);
    $pdo->execute();

    return $pdo;
}


function setResetTokenByEmail(PDO $conn, string $email): string
{
    $pdo = $conn->prepare("SELECT contrasenya FROM usuari WHERE usuari.correu = :correu");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    $row = $pdo->fetch();

    $password = $row["contrasenya"];
    $token = hash("sha256", $password . date('Y-m-d H:i:s'), false);
    $expiryTimestamp = date('Y-m-d H:i:s', strtotime('now +15 minute'));
    $actualTimestamp = date('Y-m-d H:i:s');

    $pdo = $conn->prepare("UPDATE usuari SET reset_token = :token, caducitat_token = :tokenTimeStamp, ultima_solicitud_token = :tokenCaducity WHERE usuari.correu = :correu");
    $pdo->bindParam(":token", $token);
    $pdo->bindParam(":tokenTimeStamp", $expiryTimestamp);
    $pdo->bindParam(":tokenCaducity", $actualTimestamp);
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
    return $token;
}

function setResetTokenById(PDO $conn, int $id): string
{
    $pdo = $conn->prepare("SELECT contrasenya FROM usuari WHERE usuari.id = :id");
    $pdo->bindParam(":id", $id);
    $pdo->execute();
    $row = $pdo->fetch();

    $password = $row["contrasenya"];
    $token = hash("sha256", $password . date('Y-m-d H:i:s'), false);
    $expiryTimestamp = date('Y-m-d H:i:s', strtotime('now +15 minute'));
    $actualTimestamp = date('Y-m-d H:i:s');

    $pdo = $conn->prepare("UPDATE usuari SET reset_token = :token, caducitat_token = :tokenTimeStamp, ultima_solicitud_token = :lastTry WHERE usuari.id = :id");
    $pdo->bindParam(":token", $token);
    $pdo->bindParam(":tokenTimeStamp", $expiryTimestamp, PDO::PARAM_STR);
    $pdo->bindParam(":lastTry", $actualTimestamp, PDO::PARAM_STR);
    $pdo->bindParam(":id", $id);
    $pdo->execute();
    return $token;
}

function getResetToken(PDO $conn, string $token): array
{
    $pdo = $conn->prepare("SELECT reset_token, caducitat_token FROM usuari WHERE reset_token = :token");
    $pdo->bindParam(":token", $token);
    $pdo->execute();

    $count = $pdo->rowCount();
    if ($count == 0) {
        return array();
    }
    $row = $pdo->fetch();
    $result["reset_token"] = $row["reset_token"];
    $result["token_caducity"] = $row["caducitat_token"];
    return $result;
}

function getLastTokenTimestamp(PDO $conn, string $email): ?string
{
    $pdo = $conn->prepare("SELECT ultima_solicitud_token FROM usuari WHERE usuari.correu = :correu");
    $pdo->bindParam(":correu", $email);
    $pdo->execute();

    $row = $pdo->fetch();
    $result = $row["ultima_solicitud_token"];
    return $result;
}

function setUserPasswordByToken(PDO $conn, string $password, string $token): void
{
    $password = hash("sha256", $password, false);
    $pdo = $conn->prepare("UPDATE usuari SET contrasenya = :contrasenya, reset_token = NULL, caducitat_token = NULL WHERE usuari.reset_token = :token");
    $pdo->bindParam(":contrasenya", $password);
    $pdo->bindParam(":token", $token);
    $pdo->execute();
}

function setUserPasswordById(PDO $conn, string $password, int $userId): void
{
    $password = hash("sha256", $password, false);
    $pdo = $conn->prepare("UPDATE usuari SET contrasenya = :contrasenya, reset_token = NULL, caducitat_token = NULL WHERE usuari.id = :id");
    $pdo->bindParam(":contrasenya", $password);
    $pdo->bindParam(":id", $userId);
    $pdo->execute();
}

function getUserName(PDO $conn, int $userId): array
{
    $pdo = $conn->prepare("SELECT usuari.id, usuari.nom, usuari.cognoms, usuari.correu FROM usuari WHERE usuari.id = :usuariId");
    $pdo->bindParam(":usuariId", $userId, PDO::PARAM_INT);
    $pdo->execute();
    $row = $pdo->fetch();
    return $row;
}

function setUserEmail(PDO $conn, string $email, int $userId): void
{
    $pdo = $conn->prepare("UPDATE usuari SET correu = :correu WHERE usuari.id = :id");
    $pdo->bindParam(":id", $userId);
    $pdo->bindParam(":correu", $email);
    $pdo->execute();
}

function getUserEmail(PDO $conn, int $userId): string
{
    $pdo = $conn->prepare("SELECT correu FROM usuari WHERE usuari.id = :id");
    $pdo->bindParam(":id", $userId);
    $pdo->execute();
    $row = $pdo->fetch();

    return $row["correu"];
}

function removeUserAccount(PDO $conn, int $userId): void
{
    $pdo = $conn->prepare("DELETE FROM usuari WHERE usuari.id = :id");
    $pdo->bindParam(":id", $userId);
    $pdo->execute();
}

// aquesta funcio afegeix a la base de dades la informacio d'una imatge que s'ha pujat al servidor
// retorna true si l'insert s'ha produit correctament
// retorna false si l'insert no s'ha pogut executar
function addImage(PDO $conn, int $userId, string $title, string $description, string $fileName): bool
{
    $pdo = $conn->prepare("INSERT INTO imatge (autor, titol, descripcio, fitxer) VALUES (:id, :titol, :description, :fitxer)");
    $pdo->bindParam(":id", $userId);
    $pdo->bindParam(":titol", $title);
    $pdo->bindParam(":description", $description);
    $pdo->bindParam(":fitxer", $fileName);
    $pdo->execute();

    if ($pdo->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function updateImageMetaData(PDO $conn, int $imageId, string $title, string $description): bool
{
    $pdo = $conn->prepare("UPDATE imatge SET descripcio = :imageDescription WHERE imatge.id = :imageId");
    $pdo->bindParam(":imageDescription", $description);
    $pdo->bindParam(":imageId", $imageId);
    $pdo->execute();

    if ($pdo->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getImageCount(PDO $conn): int
{
    $pdo = $conn->prepare("SELECT count(*) as 'Count' FROM imatge");
    $pdo->execute();
    $row = $pdo->fetch();

    return $row["Count"];
}

function getImageCountByUserID(PDO $conn, int $userId): int
{
    $pdo = $conn->prepare("SELECT count(*) as 'Count' FROM imatge WHERE autor = :id");
    $pdo->bindParam(":id", $userId);
    $pdo->execute();
    $row = $pdo->fetch();

    return $row["Count"];
}

function getImagePage(PDO $conn, int $page, int $maxImgPerPage): ?PDOStatement
{

    $min = ($page * $maxImgPerPage) - $maxImgPerPage;
    $max = $maxImgPerPage;

    $pdo = $conn->prepare("SELECT i.id, i.autor, i.titol,i.descripcio, i.fitxer, u.nom, u.cognoms, (SELECT count(*) FROM article WHERE imatge = i.id) as utilitzada FROM imatge as i LEFT JOIN usuari u ON u.id = i.autor LIMIT :minLimit, :maxLimit");
    $pdo->bindParam(":minLimit", $min, PDO::PARAM_INT);
    $pdo->bindParam(":maxLimit", $max, PDO::PARAM_INT);
    $pdo->execute();

    if ($pdo->rowCount() > 0) {
        return $pdo;
    } else {
        return null;
    }
}

function getImagePageByUserID(PDO $conn, int $page, int $maxImgPerPage, int $userId): ?PDOStatement
{

    $min = ($page * $maxImgPerPage) - $maxImgPerPage;
    $max = $maxImgPerPage;

    $pdo = $conn->prepare("SELECT i.id, i.autor, i.titol,i.descripcio, i.fitxer, u.nom, u.cognoms, (SELECT count(*) FROM article WHERE imatge = i.id) as utilitzada FROM imatge as i LEFT JOIN usuari u ON u.id = i.autor WHERE i.autor = :id LIMIT :minLimit, :maxLimit");
    $pdo->bindParam(":id", $userId);
    $pdo->bindParam(":minLimit", $min, PDO::PARAM_INT);
    $pdo->bindParam(":maxLimit", $max, PDO::PARAM_INT);
    $pdo->execute();

    if ($pdo->rowCount() > 0) {
        return $pdo;
    } else {
        return null;
    }
}

function getImageAuthor(PDO $conn, int $imageId): ?int
{
    $pdo = $conn->prepare("SELECT autor FROM imatge WHERE imatge.id = :idImatge");
    $pdo->bindParam(":idImatge", $imageId);
    $pdo->execute();
    if ($pdo->rowCount() > 0) {
        $row = $pdo->fetch();
        return $row["autor"];
    }

    return null;
}

function getImageUsage(PDO $conn, int $imageId): int
{
    $pdo = $conn->prepare("SELECT count(*) as Count FROM article WHERE article.imatge = :imageId");
    $pdo->bindParam(":imageId", $imageId);
    $pdo->execute();
    $row = $pdo->fetch();
    return $row["Count"];
}

function deleteImage(PDO $conn, int $imageId): bool
{
    $pdo = $conn->prepare("DELETE FROM imatge WHERE imatge.id = :idImatge");
    $pdo->bindParam(":idImatge", $imageId);
    $pdo->execute();
    if ($pdo->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function getImageName(PDO $conn, int $imageId): ?string
{
    $pdo = $conn->prepare("SELECT fitxer FROM imatge WHERE imatge.id = :idImatge");
    $pdo->bindParam(":idImatge", $imageId);
    $pdo->execute();
    if ($pdo->rowCount() > 0) {
        $row = $pdo->fetch();
        return $row["fitxer"];
    } else {
        return null;
    }
}

function getImageMeta(PDO $conn, int $imageId): mixed
{
    $pdo = $conn->prepare(("SELECT id, autor, titol, descripcio FROM imatge WHERE imatge.id = :imageId"));
    $pdo->bindParam(":imageId", $imageId);
    $pdo->execute();
    if ($pdo->rowCount() > 0) {
        $row = $pdo->fetch();
        return $row;
    } else {
        return null;
    }
}

function getUserImageFiles(PDO $conn, int $userId): PDOStatement
{
    $pdo = $conn->prepare("SELECT fitxer FROM imatge WHERE autor = :userId");
    $pdo->bindParam(":userId", $userId);
    $pdo->execute();
    return $pdo;
}

function renameImageFile(PDO $conn, string $fileName, string $newFileName): bool
{
    $pdo = $conn->prepare("UPDATE imatge SET fitxer = :newFileName WHERE imatge.fitxer = :fileName");
    $pdo->bindParam(":fileName", $fileName);
    $pdo->bindParam(":newFileName", $newFileName);
    $pdo->execute();
    if ($pdo->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function updateImageMeta(PDO $conn, int $imageId, string $newTitle, string $newDescription): bool
{
    $pdo = $conn->prepare("UPDATE imatge SET titol = :imageTitle , descripcio = :imageDescription WHERE imatge.id = :imageId");
    $pdo->bindParam(":imageTitle", $newTitle);
    $pdo->bindParam(":imageDescription", $newDescription);
    $pdo->bindParam(":imageId", $imageId);
    $pdo->execute();
    if ($pdo->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
