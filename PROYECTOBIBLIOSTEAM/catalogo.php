<?php
session_start();

include 'conexion.php';

$offset=$_GET['offset']??0;



$sql="SELECT 
    g.id_game,
    g.name,
    g.released,
    g.image,
    g.description,
    CASE 
        WHEN COUNT(r.rating) = 0 THEN '-' 
        ELSE ROUND(AVG(r.rating)::numeric, 1)::text 
    END AS average_rating
FROM 
    games g
LEFT JOIN 
    reviews r ON g.id_game = r.id_game
GROUP BY 
    g.id_game, g.name, g.released, g.image, g.description
LIMIT 120 OFFSET :offset";

$consularjuegos = $pdo->prepare($sql);
$consularjuegos->execute([":offset"=>$offset]);
$juegosEncontrados = $consularjuegos->fetchAll(PDO::FETCH_ASSOC);

include "games.php";
?>