<?php
include "../conexion.php";

session_start();

if(!isset($_SESSION['user'])){
    header('/PROYECTOBIBLIOSTEAM/login');
    die;
}
if($_SERVER['REQUEST_METHOD']!=='POST'){
    header("Location: /PROYECTOBIBLIOSTEAM/games");
    die;
}

$idGame=$_POST['gameToAdd'] ?? null;


$idLibrary=$_POST['game-library'] ?? null;

if (!$idGame || !$idLibrary) {
    header('Location: /PROYECTOBIBLIOSTEAM/games');
}

$agregarJuegos=$pdo->prepare("INSERT INTO library_game(id_library, id_game) values (:id_library, :id_game)");

$agregarJuegos->execute([
    ":id_library" => $idLibrary,
    ":id_game"=> $idGame,
]);

    header("Location: /PROYECTOBIBLIOSTEAM/games/$idGame");
    die;



?>