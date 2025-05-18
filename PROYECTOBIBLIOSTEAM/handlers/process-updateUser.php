<?php
include "../conexion.php";
session_start();


if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['error']="Method not allowed";
    header("Location: /PROYECTOBIBLIOSTEAM/account" );
    die;   
}

$errores=[];

$user = trim($_POST['NewUsername']) ?? $_SESSION["user"]["name"];
$password = $_POST['NewPassword'] ?? $_SESSION["user"]["password"];
$confirmPassword = $_POST['ConfirmNewPassword'] ?? $_SESSION["user"]["password"];
$email = trim($_POST['NewEmail'])?? $_SESSION["user"]["email"];
$idSteam = $_POST["idSteam"] ?? $_SESSION["user"]["id_steam"]; 


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

if(!empty($errores)){
    $_SESSION['error'] = $errores;
    header("Location: /PROYECTOBIBLIOSTEAM/account");
    die;
}

$password = password_hash($password, PASSWORD_DEFAULT);

$updateUser=$pdo->prepare("UPDATE users SET name= :name, password= :password, email= :email, id_steam= :id_steam WHERE id_user=:id_user");
 $updateUser->execute([
     ":name"=>$user,
     ":password"=>$password,
     ":email"=>$email,
     ":id_steam"=>$idSteam,
     ":id_user"=>$_SESSION['user']['id_user'],
 ]);


 $resultNewData=[
     "name"=>$user,
     "password"=>$password,
     "email"=>$email,
     "id_steam"=>$idSteam,
     "id_user"=>$_SESSION['user']['id_user'],
 ];


$_SESSION['user']=$resultNewData;

 header('Location: /PROYECTOBIBLIOSTEAM/account');
die;


?>