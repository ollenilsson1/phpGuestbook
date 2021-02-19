<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
<div class="wrapper">

<?php
session_start(); 
if(isset($_SESSION["username"]))  
{  
    echo '<h3>Login Successful, Welcome - '.$_SESSION["username"].'</h3>';  
}  
else  
{  
    header("location:login.php");  
} 


?>

<h1 class="header">Guestbook</h1>

<div class="form">
<form method="POST" action="savePosts.php">
<textarea name="message" placeholder="Message.."></textarea>
<input type="submit" value="Post message!">
</form>
</div>
<?php

$dsn = "mysql:host=localhost;dbname=login-system";
$user = "root";
$password = ""; 
$pdo = new PDO($dsn, $user, $password);  
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  


$stm = $pdo->query("SELECT id, username, message FROM entries");



//while loop för att skriva ut alla entries på sidan
while ($row = $stm->fetch()){

?>



<table id="entries" border="0">
<tr>
   <td><?php echo $row['id'];?></td>
</tr>
<tr>
   <td><?php echo $row['username'];?></td>
</tr>
<tr>
   <td><?php echo $row['message'];?></td>
</tr>
<tr>
   <td>
       <a href="editPost.php?id=<?php echo $row['id']; ?>">Edit</a>
       <a href="deletePost.php?id=<?php echo $row['id']; ?>">Delete</a>
   </td>
</tr>
</table>

<!-- stänger while loop -->
<?php
}
echo '<br /><a href="logout.php">Logout</a>';  
?>

</div>
</body>