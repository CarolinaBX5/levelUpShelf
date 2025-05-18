<?php

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

$segments = array_filter(explode('/', $path));

$segments = array_values($segments);

$pagina = $segments[1] ?? null;
$valor= $segments[2] ?? null;

if (!isset($pagina)) {
    $pagina = "/";
}


switch ($pagina) {
    case '/':
        include "home.php";
        break;
        
    case 'home':
        include "home.php";
        break;
        
    case 'login':
        include "login.php";
        break;

    case 'register':
        include "login.php";
        break;

    case 'logout':
        include "logout.php";
        break;

    case 'games':
        if (isset($valor)) {
            include "detalles-juegos.php";
        }else{
            include "catalogo.php";
        }
        break;

    case "admin":
        include 'admin.php';
        break;
    
    case "steam":
        include "steam.php";
        break;
    
    case "category":
        include "gamesCategory.php";
        break;
    
    case "account":
        include "cuentaUsuario.php";
        break;
    case"library":
        include "libreria.php";
        break;

    case "create-library":
        include "crearLibreria.php";
        break;
        
    case"user-library":
        include "userLibrary.php";
        break;

    default:
        include "404.php";
        break;
}
?>
