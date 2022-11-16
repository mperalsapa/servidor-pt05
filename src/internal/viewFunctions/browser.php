<?php
// Marc Peral
// script que s'encarrega de simples funcions relacionades amb el explorador web

// funcio basica per redirigir el client a una URL especificada sobre la url base del lloc
function redirectClient(string $url): void
{
    include("env.php");

    $redirect = $baseUrl . $url;
    $redirect = str_replace("//", "/", $redirect);

    header("Location: " . $redirect);
    die();
}

// aquesta funcio retorna el contingut que hi ha despres de la url base. Per exemple, si la url base es /blog/ i estem 
// visitant /blog/canviar-email ens retornara /canviar-email
function getPathOverBase(bool $startingSlash = null): string
{
    include("env.php");
    $parsedUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (is_null($startingSlash) || $startingSlash) {
        $parsedUri = "/" . str_replace($baseUrl, "", $parsedUri);
    } else {
        $parsedUri = str_replace($baseUrl, "", $parsedUri);
    }
    return $parsedUri;
}
