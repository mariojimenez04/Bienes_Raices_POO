<?php

define('FUNCIONES_URL', __DIR__ . "/funciones/funciones.php");
define('TEMPLATES_URL', __DIR__ . "/templates");
define('CARPETA_IMAGENES', __DIR__ . "../../imagenes/");

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

//Escapar HTML
function s($html) {
    $s = htmlspecialchars($html);

    return $s;
}

function estaAutenticado() {
    session_start();

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
    
    if(!$_SESSION['login']) {
        header('Location: /login.php');
    }
}

function debuguear( $variable ) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}