<?php

include('connect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO entries (name, email, message) VALUES(:name_IN, :email_IN, :message_IN)";
$stm = $pdo->prepare($sql);
$stm->bindParam(':name_IN', $name);
$stm->bindParam(':email_IN', $email);
$stm->bindParam(':message_IN', $message);

if($stm->execute()) {
    header("location:guestbook.php");
}else {
    echo "Something went wrong... try again";
}



?>