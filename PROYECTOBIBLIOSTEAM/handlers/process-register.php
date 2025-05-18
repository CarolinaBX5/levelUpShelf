<?php
include "../conexion.php";
session_start();

if($_SERVER['REQUEST_METHOD'] !=='POST'){
    $_SESSION['error']=["Method not allowed"];
    header("Location: /PROYECTOBIBLIOSTEAM/login" );
    die;
}

$user = trim($_POST['user']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$email = trim($_POST['email']);

$errores = [];

if(empty($user)) {
    array_push($errores, "Username field cannot be empty");
} elseif(strlen($user) < 4) {
    array_push($errores, "Username must be at least 4 characters long");
} elseif(!preg_match('/^[a-zA-Z0-9_]+$/', $user)) {
    array_push($errores, "Username can only contain letters, numbers and underscores");
}


if(empty($email)) {
    array_push($errores, "Email field cannot be empty");
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errores, "Invalid email format");
}


if(empty($password)) {
    array_push($errores, "Password cannot be empty");
} elseif(strlen($password) < 8) {
    array_push($errores, "Password must be at least 8 characters long");
} elseif(!preg_match('/[A-Z]/', $password)) {
    array_push($errores, "Password must contain at least one uppercase letter");
} elseif(!preg_match('/[a-z]/', $password)) {
    array_push($errores, "Password must contain at least one lowercase letter");
} elseif(!preg_match('/[0-9]/', $password)) {
    array_push($errores, "Password must contain at least one number");
}

if($password !== $confirmPassword) {
    array_push($errores, "Passwords do not match");
}

$verificarUsuario = $pdo->prepare("SELECT COUNT(*) FROM users WHERE name = :name OR email = :email");
$verificarUsuario->execute([
    ":name" => $user,
    ":email" => $email
]);

if($verificarUsuario->fetchColumn() > 0) {
    array_push($errores, "Username or email already registered");
}

if(!empty($errores)) {
    $_SESSION['error'] = $errores;
    header("Location: /PROYECTOBIBLIOSTEAM/login");
    die;
}
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$registrarUsuario = $pdo->prepare("INSERT INTO users (name, password, email) values(:name, :password, :email)");

$registrarUsuario->execute([
    ":name" => $user,
    ":password" => $passwordHash,
    ":email" => $email,
]);

$idUsuario=$pdo->lastInsertId();

$datosUsuario=[
    "id_user"=> $idUsuario,
    "id_steam"=>null,
    "name"=>$user,
    "password"=>$passwordHash,
    "email"=>$email,
];

$_SESSION['user']=$datosUsuario;

unset($_SESSION['error']);

header("Location: /PROYECTOBIBLIOSTEAM/account");
die;
?>