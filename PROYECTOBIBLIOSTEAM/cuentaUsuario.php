<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: /PROYECTOBIBLIOSTEAM/login");
    die;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/account.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
</head>

<body>
    <?php include "navBar.php"; ?>
    <div class="container">
        <h1 class="page-title">My Account</h1>
        <form class="update-form" action="/PROYECTOBIBLIOSTEAM/handlers/process-updateUser.php" method="post">
            <input type="text" name="NewUsername" placeholder=<?php echo $_SESSION['user']['name'] ?>>
            <input type="password" name="NewPassword" placeholder="New Password">
            <input type="password" name="ConfirmNewPassword" placeholder=" Confirm New Password">
            <input type="email" name="NewEmail" placeholder=<?php echo $_SESSION['user']['email'] ?>>
            <input type="text" name="idSteam" placeholder="ID de Steam">
            <button type="submit">Save Changes</button>
        </form>


    </div>
    <div class="errores">
        <?php
        if (isset($_SESSION['error'])) {
            foreach ($_SESSION['error'] as $item) {
                echo "<p>$item</p>";
            }
        }

        unset($_SESSION['error']);

        ?>
    </div>
</body>

</html>