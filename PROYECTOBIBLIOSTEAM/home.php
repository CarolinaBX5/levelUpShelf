<?php

include "conexion.php";
session_start();

$login=isset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LevelUP Shelf - Online Game Library</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.5;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        /* Header and Navbar */
        header {
            border-bottom: 1px solid #e5e7eb;
        }
        
        .search-container {
            position: relative;
            padding: 0.5rem 0;
        }
        
        .search-input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }
        
        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        /* Hero Section */
        .hero {
            padding: 3rem 0;
            background: linear-gradient(to right, #8b5cf6, #6366f1);
            color: white;
            text-align: center;
        }
        
        .hero-content {
            max-width: 48rem;
            margin: 0 auto;
        }
        
        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
        }
        
        @media (min-width: 640px) {
            .hero-title {
                font-size: 3rem;
            }
        }
        
        @media (min-width: 768px) {
            .hero-title {
                font-size: 3.75rem;
            }
        }
        
        .hero-subtitle {
            margin-top: 1.5rem;
            font-size: 1.25rem;
        }
        
        .hero-buttons {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-align: center;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background-color: white;
            color: #6366f1;
        }
        
        .btn-primary:hover {
            background-color: #f9fafb;
        }
        
        .btn-outline {
            border: 1px solid white;
            color: white;
        }
        
        .btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Section Styles */
        .section {
            padding: 4rem 0;
        }
        
        .section-title {
            font-size: 1.875rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
        }
        
        /* Featured Games */
        .games-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        @media (min-width: 640px) {
            .games-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .games-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .game-card {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        .game-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .game-image {
            aspect-ratio: 3/4;
            background-color: #e5e7eb;
        }
        
        .game-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .game-details {
            padding: 1rem;
        }
        
        .game-title {
            font-size: 1.125rem;
            font-weight: 600;
        }
        
        .game-category {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        
        .game-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.75rem;
        }
        
        .game-price {
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .btn-play {
            background-color: #4f46e5;
            color: white;
            border-radius: 0.375rem;
        }
        
        .btn-play:hover {
            background-color: #4338ca;
        }
        
        .view-all {
            margin-top: 3rem;
            text-align: center;
        }
        
        /* Categories */
        .bg-gray {
            background-color: #f9fafb;
        }
        
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        @media (min-width: 768px) {
            .categories-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        .category-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: box-shadow 0.3s;
        }
        
        .category-card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .category-title {
            font-size: 1.125rem;
            font-weight: 500;
        }
        
        .category-count {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.25rem;
        }
        
        /* Community Section */
        .community {
            background-color: #4f46e5;
            color: white;
            padding: 4rem 0;
            text-align: center;
        }
        
        .community-content {
            max-width: 48rem;
            margin: 0 auto;
        }
        
        .community-title {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .community-text {
            font-size: 1.125rem;
            margin-bottom: 2rem;
        }
        
        /* Footer */
        footer {
            background-color: #111827;
            color: #9ca3af;
            padding: 3rem 0;
            margin-top: auto;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
                justify-items: center;
            }
        }
        
        .footer-title {
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 1rem;
        }
        
        .footer-text {
            font-size: 0.875rem;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-link {
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        
        .footer-link a:hover {
            color: white;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
        }
        
        .footer-bottom {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            text-align: center;
            font-size: 0.875rem;
        }

        .game-details{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .game-details a{
            width: 75%;
        }
    </style>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
</head>
<body>
<?php include "navBar.php";
?>
        
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Your Digital Game Library</h1>
                <p class="hero-subtitle">Discover, play and collect the best online games in one place</p>
                <div class="hero-buttons">
                    <a href="games" class="btn btn-primary">
                        Browse Games
                    </a>
                    <?php
                    if(!$login){
                        echo '<a href="/PROYECTOBIBLIOSTEAM/login" class="btn btn-outline">
                        Sign Up Free
                    </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Games -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Featured Games</h2>
            <div class="games-grid">
                <?php
                
                $juegosHome=$pdo->prepare("SELECT * FROM games ORDER BY RANDOM() LIMIT 4");
                $juegosHome->execute();

                $resultJuegos=$juegosHome->fetchAll(PDO::FETCH_ASSOC);

                $randomGames=[];

                for($i=0; $i< count(value: $resultJuegos); $i++ ){
                    $randomGames[]=$resultJuegos[$i];
                }

                foreach ($randomGames as $item) {
                    echo '
                    <div class="game-card">
                        <div class="game-image">
                    <img src="' . $item['image'] . '" alt="' . $item['name'] . '">                       
                     </div>
                        <div class="game-details">
                            <h3 class="game-title">' . $item['name'] . '</h3>
                            <a href="/PROYECTOBIBLIOSTEAM/games/'.$item['id_game'].'" class="btn btn-sm btn-play" >View Game</a>
                        </div>
                    </div>';
                }
                ?>
            </div>
            <div class="view-all">
                <a href="games" class="btn btn-outline" style="border-color: #d1d5db; color: #4b5563;">
                    View All Games
                </a>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section bg-gray">
        <div class="container">
            <h2 class="section-title">Browse by Category</h2>
            <div class="categories-grid">
                <?php
                
                $categoryGame=$pdo->prepare("SELECT name, count(games_genres.*) as total FROM genres inner join games_genres using (id_genre) group by name");
                $categoryGame->execute();

                $resultCategories=$categoryGame->fetchAll(PDO::FETCH_ASSOC);


                foreach ($resultCategories as $item) {
                    echo '
                    <a href="/PROYECTOBIBLIOSTEAM/category/' . strtolower($item['name']) . '" class="category-card">
                        <h3 class="category-title">' . $item['name'] . '</h3>
                        <p class="category-count">'.$item["total"].'</p>
                    </a>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Join Community -->
<?php
if(!$login){
    echo '    <section class="community">
        <div class="container">
            <div class="community-content">
                <h2 class="community-title">Join Our Gaming Community</h2>
                <p class="community-text">
                    Connect with other gamers, share your achievements, and discover new games together.
                </p>
                <a href="/PROYECTOBIBLIOSTEAM/login" class="btn btn-primary">
                    Sign Up Now
                </a>
            </div>
        </div>
    </section>';
}
?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h3 class="footer-title">LevelUP Shelf</h3>
                    <p class="footer-text">Your ultimate destination for online gaming entertainment and community.</p>
                </div>
                <div>
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="about.php">About Us</a></li>
                        <li class="footer-link"><a href="contact.php">Contact</a></li>
                        <li class="footer-link"><a href="faq.php">FAQ</a></li>
                        <li class="footer-link"><a href="privacy.php">Privacy Policy</a></li>
                    </ul>
                </div>
            
                <div>
                    <h4 class="footer-title">Connect With Us</h4>
                    <div class="social-links">
                        <a href="#" class="footer-link">Twitter</a>
                        <a href="#" class="footer-link">Discord</a>
                        <a href="#" class="footer-link">Instagram</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> LevelUP Shelf. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // You can add JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded');
        });
    </script>
</body>
</html>