<?php
// Marc Peral
// script que s'encarrega de rebre un webhook de github i actualitzar el repositori local de codi
// lo que permet CD (continuous deployment) amb un push des de github

// importem les variables d'entorn
include("env.php");

// funcio que retorna un missatge i codi de reponsta 400(error)
function returnError(string $msg): void
{
    echo $msg;
    http_response_code(400);
    die();
}

// comprovem si el token es buit, o es diferent al token que tenim guardat en la variable d'entorn 
// retornem erroren cas de ser-ho
if (empty($_GET["token"]) || $_GET["token"] != $webhookToken) {
    returnError("Invalid Token");
}

// si el token es valid, agafem les dades del webhook i comprovem si es buida o no
// en cas de ser buida retornem error
$payload = $_POST;
if (empty($payload["payload"])) {
    returnError("Payload is empty");
}

// comprovem si podem decodificar el payload amb json
// en cas de no poder, o sigui buida, retornem error
$payload = json_decode($payload["payload"]);
if (empty($payload->ref)) {
    returnError("Wrong Payload");
}

// finalment si tot es correcte, agafem el ref del payload i comprovem si
// es diferent a "main" (la branca principal del repositori)
// si no es main, retornem que no es main i que la saltem amb codi 200
// aixo es degut a que nomes volem fer CD de la branca main i no de la resta de branques.
$branch = $payload->ref;
$branch = str_replace("refs/heads/", "", $branch);
if ($branch != "main") {
    echo "This push is not provided to main. Skipping...";
    http_response_code(200);
    die();
}

// si tot es correcte, vol dir que hem de fer un pull del repositori per actualitzar el que tenim al servidor web
$cmd = shell_exec("git pull --rebase");
// mostrem el log del pull i retornem "deploy success"
echo $cmd;
echo 'Deployment sucess';
