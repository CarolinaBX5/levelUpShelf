<?php
include "../conexion.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /PROYECTOBIBLIOSTEAM/games");
    die;
}

if (!isset($_SESSION['user'])){
    header("Location: /PROYECTOBIBLIOSTEAM/login");
    die;
}

$comment = $_POST["review"] ?? null;
$rate = $_POST["gameNote"] ?? null;
$idGame = $_POST["idGame"] ?? null;

if (!$idGame) {
    header("Location: /PROYECTOBIBLIOSTEAM/games");
    die;
}

if (!$comment || !$rate) {
    header("Location: /PROYECTOBIBLIOSTEAM/games/$idGame");
    die;
}

$crearReseña = $pdo->prepare("INSERT INTO reviews (id_game, id_user, comment, rating) values (:id_game,:id_user,:comment, :rating)");
$crearReseña->execute([
    ":id_game" => $idGame,
    ":id_user" => $_SESSION["user"]["id_user"],
    ":comment" => $comment,
    ":rating" => $rate,
]);

header("Location: /PROYECTOBIBLIOSTEAM/games/$idGame");
die;

?>