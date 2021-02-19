<?php
session_start(); 
$dsn = "mysql:host=localhost;dbname=login-system";
$user = "root";
$password = "";
$pdo = new PDO($dsn, $user, $password);  
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  


$username = $_SESSION['username'];
$message = $_POST['message'];

$sql = "INSERT INTO entries (username, message) VALUES(:username_IN, :message_IN)";
$stm = $pdo->prepare($sql);
$stm->bindParam(':username_IN', $username);
$stm->bindParam(':message_IN', $message);

if($stm->execute()) {
    header("location:guestbook.php");
}else {
    echo "Something went wrong... try again";
}



?>