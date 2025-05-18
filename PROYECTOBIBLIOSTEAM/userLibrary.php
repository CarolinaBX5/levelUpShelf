<?php
include "conexion.php";
session_start();
$offset=0;


$juegosXLibreria=$pdo->prepare("SELECT games.*, library_game.id_library, library.id_user FROM games INNER JOIN library_game USING(id_game)INNER JOIN library using (id_library) WHERE id_library=:id_library AND library.id_user=:id_user");
$juegosXLibreria->execute([
    ":id_library"=>$valor,
    ":id_user"=>$_SESSION['user']['id_user'],
]);

$juegosEncontrados=$juegosXLibreria->fetchAll(PDO::FETCH_ASSOC);

include "games.php";
?>