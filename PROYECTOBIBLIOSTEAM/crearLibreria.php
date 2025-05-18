<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /PROYECTOBIBLIOSTEAM/login');
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Library</title>
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/navbar.css">
    <link rel="stylesheet" href="/PROYECTOBIBLIOSTEAM/public/css/account.css">
    <style>
        /* Estilos base */
        :root {
            --primary: #4a6da7;
            --primary-dark: #3a5a8c;
            --secondary: #f8f9fa;
            --text: #333333;
            --border: #e2e8f0;
            --error: #e53e3e;
            --success: #38a169;
        }



        /* Formulario de creación de librería */
        .library-form {
            margin-top: 2rem;
            display: flex;
            gap: 0.5rem;
            max-width: 600px;

        }

        .library-form input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            font-size: 1rem;
            transition: border-color 0.2s ease;

        }

        .library-form input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 109, 167, 0.1);
        }

        .library-form button {
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .library-form button:hover {
            background-color: var(--primary-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 1rem;
            }

            nav {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .library-form {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            nav {
                gap: 1rem;
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>

    <?php
    include "navBar.php";
    ?>
    <div class="container" style="margin-top: 150px;">
        <h1 class="page-title">Create Library</h1>

        <form class="update-form" action="/PROYECTOBIBLIOSTEAM/handlers/process-createLibrary.php" method="post">
            <input type="text" name="library" placeholder="Create library">
            <button type="submit">Create library</button>
        </form>
    </div>
    <div class="errores">
        <?php
    if (isset($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $item) {
            echo "<p>$item</p>";
        }
        unset($_SESSION['error']); 
    }
    ?>
    </div>
</body>

</html>