<?php
include "conexion.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: /PROYECTOBIBLIOSTEAM/login");
    die;
}

$bibliotecasUsuarios=$pdo->prepare("SELECT * FROM library WHERE id_user= :id_user");

$bibliotecasUsuarios->execute([
    ":id_user"=>$_SESSION['user']['id_user'],
]);

$resultLibrary=$bibliotecasUsuarios->fetchAll(PDO::FETCH_ASSOC); 






?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php  echo $_SESSION['user']['name'] . "'s Libraries" ?></title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/library.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">

</head>
<body>
    <?php include "navBar.php"?>
    <div class="container">
        <h1><?php  echo $_SESSION['user']['name'] . "'s Libraries" ?></h1>
       
        <div class="bibliotecas">
            <?php  foreach($resultLibrary as $item){
               echo "<a class='tarjeta' href=/PROYECTOBIBLIOSTEAM/user-library/".$item['id_library']."><div><h2>".$item['name']."</h2></div></a>";
            }   ?>
            
        </div>
    </div>
</body>
</html>
