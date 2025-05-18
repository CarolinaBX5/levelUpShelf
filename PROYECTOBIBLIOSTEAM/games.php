<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/estilos.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/search.css">

</head>

<body>
    <?php include "navBar.php"; ?>
    <div class="container">

        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search..." id="buscador">
            <button type="submit" class="search-button">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>
        <div class="games-grid" id="catalogo">

            <?php
            //bucle para mostrar los juegos en contenedores
            foreach ($juegosEncontrados as $fila) {
                echo '<div class="game-card">';
                echo "<img src=" . $fila["image"] . ">";
                echo '<div class="game-content">';
                echo "<div class='basic-info'>";
                echo '<h2 class="game-title">' . $fila["name"] . '</h2>';
                echo '<div class="game-info">';
                if (isset($fila['average_rating'])){
                    echo "<div><b>Rating:  </b>" . $fila['average_rating'] . "/10</div>";
                }
                echo "<p class='description'>" . $fila["description"] . "</p>";
                echo '</div>';
                echo "</div>";
                echo "<a class='game-button' href='/PROYECTOBIBLIOSTEAM/games/" . $fila['id_game'] . "'>Show details</a>";
                echo '</div>';
                echo '</div>';
            }
            echo "</div>";

            ?>

        </div>
    </div>

    <div class="loadBlock">
        <div class="paginacion">
            <form method="GET">
                <input type="hidden" name="offset" value="<?= max(0, min($offset - 120, 2000 - 1)); ?>">
                <button type="submit" class="pagina">-</button>
            </form>
            <div id="paginacion">
            </div>
            <form method="GET">
                <input type="hidden" name="offset" value="<?= $offset + 120 ?>">
                <button type="submit" class="pagina">+</button>
            </form>
        </div>
    </div>


</body>

<script src="/PROYECTOBIBLIOSTEAM/public/js/buscador.js"></script>
<script src="/PROYECTOBIBLIOSTEAM/public/js/paginador.js"></script>

</html>