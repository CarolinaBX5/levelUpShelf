<?php
include "../conexion.php";
session_start();

if(!isset($_SESSION['user'])){
    header('Location: /PROYECTOBIBLIOSTEAM/login');
    die;
}


if($_SERVER['REQUEST_METHOD'] !== 'POST'){

    header('Location: /PROYECTOBIBLIOSTEAM/library');
    die;
    
}
$library=$_POST['library'] ?? null;


if(!$library){
    $_SESSION['error']=['You must write a name for the library.'];
    header('Location: /PROYECTOBIBLIOSTEAM/create-library');
    die;
}

$agregarLibreria=$pdo->prepare('INSERT INTO library(id_user, name, date) values(:id_user, :name, :date)');

$agregarLibreria->execute([
    ":id_user"=>$_SESSION['user']['id_user'],
    ":name"=>$library,
    "date" => date("Y-m-d")
]);

header("Location: /PROYECTOBIBLIOSTEAM/library");
die;




?>