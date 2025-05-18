<?php
include "conexion.php";
session_start();

if(!is_numeric($valor)){
    header("Location: /PROYECTOBIBLIOSTEAM/games");
    die;
}

// Obtener información del juego
$consultarID = $pdo->prepare("SELECT * FROM games WHERE id_game = :id_game");
$consultarID->execute([":id_game" => $valor]);
$result = $consultarID->fetch(PDO::FETCH_ASSOC);

if (!$result || empty($result)) {
    header("Location: /PROYECTOBIBLIOSTEAM/games");
    die;
}

// Plataformas del juego
$juegosPlataformas = $pdo->prepare("
    SELECT platforms.name, games_platforms.id_game 
    FROM games_platforms 
    INNER JOIN platforms USING (id_platform) 
    WHERE games_platforms.id_game = :valor
    ORDER BY platforms.name ASC
");
$juegosPlataformas->execute([":valor" => $valor]);
$resultPlatform = $juegosPlataformas->fetchAll(PDO::FETCH_ASSOC);

// Géneros del juego
$juegosGeneros = $pdo->prepare("
    SELECT genres.name, games_genres.id_game 
    FROM games_genres 
    INNER JOIN genres USING(id_genre) 
    WHERE games_genres.id_game = :valor
    ORDER BY genres.name ASC
");
$juegosGeneros->execute([":valor" => $valor]);
$resultGenres = $juegosGeneros->fetchAll(PDO::FETCH_ASSOC);

// Reseñas
$userReview = null;
$reseñasGlobales = null;

if (isset($_SESSION["user"])) {
    // Reseña del usuario actual
    $reseñaXjuego = $pdo->prepare("
        SELECT reviews.* 
        FROM reviews 
        WHERE reviews.id_game = :id_game AND reviews.id_user = :id_user
    ");
    $reseñaXjuego->execute([
        ":id_game" => $valor,
        ":id_user" => $_SESSION["user"]["id_user"],
    ]);
    $userReview = $reseñaXjuego->fetch(PDO::FETCH_ASSOC);

    // Otras reseñas
    $reseñasGlobales = $pdo->prepare("
        SELECT reviews.*, users.name  
        FROM reviews 
        INNER JOIN users USING(id_user) 
        WHERE reviews.id_game = :id_game AND reviews.id_user != :id_user
    ");
    $reseñasGlobales->execute([
        ":id_game" => $valor,
        ":id_user" => $_SESSION["user"]["id_user"],
    ]);
} else {
    $reseñasGlobales = $pdo->prepare("
        SELECT reviews.*, users.name  
        FROM reviews 
        INNER JOIN users USING(id_user) 
        WHERE reviews.id_game = :id_game
    ");
    $reseñasGlobales->execute([":id_game" => $valor]);
}

$allReview = $reseñasGlobales->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $result['name'] ?></title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/gameInfo.css">
</head>
<body>
    <?php include 'navBar.php' ?>
    <div class="container">
        <header>
            <h1 id="game-title"><?= $result['name'] ?></h1>
        </header>

        <div class="game-container">
            <div class="game-image">
                <img id="game-img" src="<?= $result['image'] ?>" alt="Imagen del juego" />
                
                <div class="game-form">
                    <?php
                if (!isset($_SESSION["user"])) {
                    echo "<p>You have to login first</p>";
                } else {
                    $bibliotecasUsuarios = $pdo->prepare("
    SELECT * 
    FROM library 
    WHERE id_user = :id_user 
      AND id_library NOT IN (
        SELECT id_library 
        FROM library_game 
        WHERE id_game = :id_game
    )
");
                    $bibliotecasUsuarios->execute([":id_user" => $_SESSION['user']['id_user'],":id_game"=>$valor]);
                    $resultLibrary = $bibliotecasUsuarios->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (empty($resultLibrary)) {
                        echo "<p>You don’t have libraries</p>";
                    } else {
                        echo "<div class='game-form'>";
                            echo '<form action="/PROYECTOBIBLIOSTEAM/handlers/process-addJuegos.php" method="post">';
                                echo '<label for="game-library">Add to library</label>';
                                echo '<select name="game-library" id="game-library">';
                                foreach ($resultLibrary as $item) {
                                    echo '<option value="' . $item['id_library'] . '">' . $item['name'] . '</option>';
                                }
                                echo '</select>';
                                echo '<input type="hidden" name="gameToAdd" value="' . $valor . '">';
                                echo '<button type="submit">Add</button>';
                            echo '</form>';
                        echo "</div>";
                    }
                }
                ?>
                </div>
            </div>

        <div class="game-details">
            <div class="description" id="game-description">
                <?= $result['description'] ?>
            </div>

            <div class="info-section">
                <h3>Platforms</h3>
                <div class="tags platforms" id="platforms">
                    <?php foreach ($resultPlatform as $item): ?>
                        <span class="tag"><?= $item['name'] ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="info-section">
                <h3>Genres</h3>
                <div class="tags genres" id="genres">
                    <?php foreach ($resultGenres as $item): ?>
                        <span class="tag"><?= $item['name'] ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="reviews-section">
        <?php if (isset($_SESSION['user'])): ?>
            <?php if (!empty($userReview)): ?>
                <div class="user-review">
                    <h3>Your review</h3>
                    <div class="review-content">
                        <div class="review-header">
                            <div class="user-info">
                                <div class="user-details">
                                    <span class="username"><?= $_SESSION['user']['name'] ?></span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="rating-value"><?= $userReview['rating'] ?></span>
                            </div>
                        </div>
                        <p class="review-text"><?= $userReview['comment'] ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="review-form">
                <form action="/PROYECTOBIBLIOSTEAM/handlers/process-reviews.php" method="post">
                    <input type="text" name="review" placeholder="Write your review" />
                    <input type="number" name="gameNote" placeholder="Rate this game" min="1" max="10" />
                    <input type="hidden" name="idGame" value="<?= $valor ?>" />
                    <button type="submit">Publish</button>
                </form>
            </div>
        <?php endif; ?>
        <?php endif; ?>

        <?php if (!empty($allReview)): ?>
            <h3 class="title-other-reviews">Other reviews</h3>
            <div class="other-reviews">
                <?php foreach ($allReview as $item): ?>
                    <div class="review-item">
                        <div class="review-header">
                            <div class="user-info">
                                <div class="user-details">
                                    <span class="username"><?= $item['name'] ?></span>
                                </div>
                            </div>
                            <div class="rating">
                                <span class="rating-value"><?= $item['rating'] ?></span>
                            </div>
                        </div>
                        <p class="review-text"><?= $item['comment'] ?></p>
                    </div>
                <?php endforeach; ?>
                
            </div>
        <?php else: ?>
            <p>There aren't any reviews yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>