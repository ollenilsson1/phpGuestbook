<?php
session_start(); 
$dsn = "mysql:host=localhost;dbname=login-system";
$user = "root";
$password = "";
$pdo = new PDO($dsn, $user, $password);  
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

?>

<?php
    
if(isset($_POST['update'])){    
    
    // Ta in alla värden från den raden som editknappen fanns på
    $id = $_POST['id'];
    $name=$_POST['username'];
    $message=$_POST['message'];    
        
    // sql query och förbered för att köra
    $sql = "UPDATE entries set username=:username, message=:message WHERE id=:id";
    $query = $pdo->prepare($sql);

    // Gör om :id o.s.v till rätt så det inte går att hacka sig in   (kanske borde byte till :name_IN :email_IN o.s.v.)
    $query->bindparam(':id', $id);               
    $query->bindparam(':username', $name);
    $query->bindparam(':message', $message);

    //Kör query
    $query->execute();

    header("location: guestbook.php");
    }

?>

<?php

//Hämta id från url
$id = $_GET['id'];

//Välj data från rätt id
$sql = "SELECT * FROM entries WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))     // Fetch_assoc returnerar en array med all data från entries med rätt id
{
    $username = $row['username'];                               //sparar all data från arrayen i nya variabler
    $message = $row['message'];                        
}

?>

<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <a href="guestbook.php">Back to guestbook</a>
    <br/><br/>
    <form name="form1" method="post" action="editPost.php">
        <table border="0">
            <tr> 
                <td>Message</td>
                <td><input type="text" name="message" value="<?php echo $message;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>                  <!-- hidden och get id för att hålla koll på vilket id i entries som ska redigeras. -->
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>