<?php
// Set the HTTP response code to 404
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over - Level 404 Not Found</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            background-color: #0f0f1b;
            color: #ffffff;
            font-family: 'Press Start 2P', cursive;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        
        .container {
            max-width: 800px;
            padding: 20px;
        }
        
        .error-code {
            font-size: 120px;
            color: #ff3860;
            text-shadow: 0 0 10px #ff3860, 0 0 20px #ff3860;
            margin: 0;
            animation: glitch 1s infinite;
        }
        
        .game-over {
            font-size: 48px;
            margin: 20px 0;
            color: #ffdd57;
            text-shadow: 4px 4px 0px #ff3860;
        }
        
        .message {
            font-size: 18px;
            margin: 20px 0;
            line-height: 1.6;
        }
        
        .continue {
            margin-top: 40px;
            animation: blink 1.5s infinite;
        }
        
        .btn {
            background-color: #ff3860;
            color: white;
            border: none;
            padding: 15px 30px;
            font-family: 'Press Start 2P', cursive;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 0 #b5002d;
            position: relative;
            top: 0;
            transition: top 0.1s, box-shadow 0.1s;
        }
        
        .btn:hover {
            top: 2px;
            box-shadow: 0 2px 0 #b5002d;
        }
        
        .btn:active {
            top: 4px;
            box-shadow: 0 0 0 #b5002d;
        }
        
        .pixel-art {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .pixel {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }
        
        @keyframes glitch {
            0% {
                text-shadow: 0 0 10px #ff3860, 0 0 20px #ff3860;
                transform: translateX(0);
            }
            25% {
                text-shadow: 0 0 10px #4d79ff, 0 0 20px #4d79ff;
                transform: translateX(-2px);
            }
            50% {
                text-shadow: 0 0 10px #ff3860, 0 0 20px #ff3860;
                transform: translateX(0);
            }
            75% {
                text-shadow: 0 0 10px #4d79ff, 0 0 20px #4d79ff;
                transform: translateX(2px);
            }
            100% {
                text-shadow: 0 0 10px #ff3860, 0 0 20px #ff3860;
                transform: translateX(0);
            }
        }
        
        @keyframes blink {
            0%, 49% {
                opacity: 1;
            }
            50%, 100% {
                opacity: 0;
            }
        }
        
        /* Create pixel art background */
        <?php
        for ($i = 0; $i < 100; $i++) {
            $x = rand(0, 100);
            $y = rand(0, 100);
            echo ".pixel:nth-child($i) { left: {$x}%; top: {$y}%; }\n";
        }
        ?>
    </style>
</head>
<body>
    <div class="pixel-art">
        <?php for ($i = 0; $i < 100; $i++): ?>
            <div class="pixel"></div>
        <?php endfor; ?>
    </div>
    
    <div class="container">
        <h1 class="error-code">404</h1>
        <h2 class="game-over">GAME OVER</h2>
        <p class="message">PLAYER 1 HAS ENCOUNTERED AN ERROR.<br>THE LEVEL YOU ARE LOOKING FOR DOES NOT EXIST.</p>
        <div class="continue">
            <a href="/PROYECTOBIBLIOSTEAM/home" class="btn">CONTINUE → HOME</a>
        </div>
    </div>
    
    <script>
        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Create random pixel movement
            const pixels = document.querySelectorAll('.pixel');
            pixels.forEach(pixel => {
                setInterval(() => {
                    const x = Math.random() * 100;
                    const y = Math.random() * 100;
                    pixel.style.left = `${x}%`;
                    pixel.style.top = `${y}%`;
                }, Math.random() * 10000 + 5000);
            });
            
            // Add keyboard controls for fun
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    window.location.href = '/';
                }
            });
        });
    </script>
</body>
</html>