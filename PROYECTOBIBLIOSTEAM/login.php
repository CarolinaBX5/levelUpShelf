<?php

session_start();
if(isset($_SESSION['user'])){
    header("Location: /PROYECTOBIBLIOSTEAM/account");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/login.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
</head>
<body>

<?php
include "navBar.php";
?>

<div class="auth-container">
    <div class="auth-card" id="auth-card">
        <div class="card-face card-front">
            <h2>Login</h2>
            <form action="/PROYECTOBIBLIOSTEAM/handlers/process-login.php" method="post">
                <input type="text" name="user" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required> 
                <button type="submit">Login</button>   
            </form>
            <a class="flip-link" onclick="flipCard()">Don't have an account? Register</a>
        </div>
        
        <!-- Back face (Register) -->
        <div class="card-face card-back">
            <h2>Create Account</h2>
            <form action="/PROYECTOBIBLIOSTEAM/handlers/process-register.php" method="post">
                <input type="text" name="user" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <input type="email" name="email" placeholder="Email" required> 
                <button type="submit">Register</button>   
            </form>
            <a class="flip-link" onclick="flipCard()">Already have an account? Login</a>
        </div>
    </div>
</div>
<div class="errores">
    <?php 
    if(isset($_SESSION['error'])){
        foreach($_SESSION['error'] as $item ){
            echo "<p>$item</p>";
        }
         unset($_SESSION["error"]);
    }
    ?>
</div>


<script src="/PROYECTOBIBLIOSTEAM/public/js/flip.js"></script>
</body>
</html>
