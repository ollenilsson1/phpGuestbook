<?php 
    session_start(); 
    $dsn = "mysql:host=localhost;dbname=login-system";
    $user = "root";
    $password = "";
    $pdo = new PDO($dsn, $user, $password);  
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    $pdo_stm = $pdo->prepare("DELETE from entries where id=" . $_GET['id']);
    $pdo_stm->execute();
    header('location:guestbook.php');

?>