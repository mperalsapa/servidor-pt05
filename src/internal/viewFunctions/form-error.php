<?php
// Marc Peral
// script que s'encarrega dels possibles errors (entrada d'usuari) a l'hora de tractar amb formularis



// funcio que permet mostrar una alerta dels tipus admesos per bootstrap, 
// mostra la vista desitjada i agafa les dades necessaries per mostrar la vista
function returnAlert(string $message, string $type, string $vista, ?array $viewData = array()): void
{
    $alertMessage = $message;
    $alertType = $type;
    $alertIcon = "";

    switch ($type) {
        case 'primary':
        case 'info':
            $alertIcon = "<i class=\"bi bi-info-circle\"></i>";
            break;
        case 'success':
            $alertIcon = "<i class=\"bi bi-check-circle\"></i>";
            break;
        case 'warning':
            $alertIcon = "<i class=\"bi bi-exclamation-triangle\"></i>";
            break;
        case 'danger':
            $alertIcon = "<i class=\"bi bi-exclamation-triangle\"></i>";
            break;
    }
    include_once($vista);
    die();
}

// funcio que comprova el si el captcha introduit es correcte (en aquest cas, el captcha es hcaptcha)
function checkCaptcha(string $captchaResponse): bool
{

    $data = array(
        'secret' => "0x6A8238ab6E15bE018e4f6d43DaA1888C30443e0F",
        'response' => $captchaResponse
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    $responseData = json_decode($response);
    if ($responseData->success) {
        return true;
    }
    return false;
}
