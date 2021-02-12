<?php 
    include('connect.php');

  /*   $id=$_GET['id'];
    query($dsn,$user,$password, "delete from `entries` where id='$id'");
    header('location:guestbook.php'); */

    $pdo_stm = $pdo->prepare("DELETE from entries where id=" . $_GET['id']);
    $pdo_stm->execute();
    header('location:guestbook.php');

?>