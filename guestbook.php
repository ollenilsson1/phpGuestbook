<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="wrapper">
<h1 class="header">Guestbook</h1>



<div class="form">
<form method="POST" action="savePosts.php">
<input type="text" placeholder="Your name..." name="name" /><br />
<input type="text" placeholder="Your email adress.." name="email" /><br />
<textarea name="message" placeholder="Message.."></textarea>
<input type="submit" value="Post message!">
</form>
</div>

<?php

include('connect.php');

$stm = $pdo->query("SELECT id, name, email, message FROM entries");

//while loop för att skriva ut alla entries på sidan
while ($row = $stm->fetch()){

?>


<table id="entries" border="0">
<tr>
   <td><?php echo $row['id'];?></td>
</tr>
<tr>
   <td><?php echo $row['name'];?></td>
</tr>
<tr>
   <td><?php echo $row['email'];?></td>
</tr>
<tr>
   <td><?php echo $row['message'];?></td>
</tr>
<tr>
   <td>
       <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
       <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
   </td>
</tr>
</table>

<!-- stänger while loop -->
<?php
}
?>

</div>
</body>