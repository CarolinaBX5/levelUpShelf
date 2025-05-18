<?php
include "conexion.php";
session_start();
$offset=$_GET['offset']??0;
$categoriaJuego=$pdo->prepare("SELECT games.*, genres.name as genreName FROM games INNER JOIN games_genres USING (id_game) INNER JOIN genres USING (id_genre) WHERE genres.name ilike :genreName LIMIT 120 OFFSET :offset");

$categoriaJuego->execute([
    ":genreName"=>$valor,
    ":offset"=>$offset,
]);

$juegosEncontrados=$categoriaJuego->fetchAll(PDO::FETCH_ASSOC);

include "games.php";

?>