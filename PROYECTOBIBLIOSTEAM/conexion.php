<?php

$servidor='localhost';
$user='alumno';
$password='alumno';
$bd='bdsteam';


    $pdo= new PDO("pgsql:host=$servidor; dbname=$bd", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //PDO::ATTR_ERRMODE : Reporte de errores / PDO::ERRMODE_EXCEPTION : señala el lugar donde está el error
?>