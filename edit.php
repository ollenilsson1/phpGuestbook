<?php
    
include('connect.php');
        
if(isset($_POST['update'])){    
    
    // Ta in alla värden från den raden som editknappen fanns på
    $id = $_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];    
        
    // sql query och förbered för att köra
    $sql = "UPDATE entries set name=:name, email=:email, message=:message WHERE id=:id";
    $query = $pdo->prepare($sql);

    // Gör om :id o.s.v till rätt så det inte går att hacka sig in
    $query->bindparam(':id', $id);
    $query->bindparam(':name', $name);
    $query->bindparam(':email', $email);
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

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $name = $row['name'];
    $email = $row['email'];
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
    
    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr> 
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email;?>"></td>
            </tr>
            <tr> 
                <td>Message</td>
                <td><input type="text" name="message" value="<?php echo $message;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


 
