<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function iniciarSession() {
    if(!isset($_SESSION)){
        session_start();
    }  
}

//  Funcion que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION)) {
        session_start();
    } elseif(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}