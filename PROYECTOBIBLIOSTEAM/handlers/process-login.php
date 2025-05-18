<?php
include "../conexion.php";
session_start();


if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['error']=["Method not allowed"];
    header("Location: /PROYECTOBIBLIOSTEAM/login" );
    die;   
}

$user=$_POST['user'] ?? null;
$password=$_POST['password']?? null;


$errores=[];
if(!$user){
    array_push($errores,"The Username Field can´t be empty");
}

if(!$password){
    array_push($errores,"The Password Field can´t be empty");
}

if(count($errores)>0){
    $_SESSION['error']=$errores;
    header("Location: /PROYECTOBIBLIOSTEAM/login");
    die;
}


$consultarUsuarios= $pdo->prepare("SELECT *  FROM users WHERE name = :name limit 1");
$consultarUsuarios->execute([":name"=>$user]);


$result=$consultarUsuarios->fetch(PDO::FETCH_ASSOC);

if(!$result || count($result)==0){
 $_SESSION['error']=["User not found"];

    header("Location: /PROYECTOBIBLIOSTEAM/login" );
    die;
}

if(!password_verify($password, $result['password'])){
    $_SESSION['error']=["Password doesn´t match"];
    header("Location: /PROYECTOBIBLIOSTEAM/login" );
    die;
}

$_SESSION['user']=$result;
unset($_SESSION['error']);

header("Location: /PROYECTOBIBLIOSTEAM/account");
die;


?>