<?php
session_start();
$dsn = "mysql:host=localhost;dbname=login-system";
$user = "root";
$password = "";
try  
{  
      $pdo = new PDO($dsn, $user, $password);  
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      
      // För login
      
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM users WHERE username = :username AND password = :password";  
                $statement = $pdo->prepare($query);  
                $statement->execute(  
                    array(  
                        'username'     =>     $_POST["username"],  
                        'password'     =>     $_POST["password"]  
                    )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                    $_SESSION["username"] = $_POST["username"];  
                    header("location:guestbook.php");  
                }  
                else  
                {  
                    $message = '<label>Fel</label>';  
                }  
           }  
      }  

      // För registrering

      if(isset($_POST["register"]))
      {
          $regUsername = $_POST['regUsername'];
          $regPassword = $_POST['regPassword'];
          $regEmail = $_POST['regEmail'];


          if(empty($_POST["regUsername"]) || empty($_POST["regPassword"]) || empty($_POST["regEmail"]))
          {
              $message = '<label>Alla fält måste fyllas i</label>';
          }
          else
          {


              $sql = "INSERT INTO users (username,password,email) VALUES(:username_IN, :password_IN, :email_IN)";
              $stm = $pdo->prepare($sql);
              $stm->bindParam(':username_IN', $regUsername);
              $stm->bindParam(':password_IN', $regPassword);
              $stm->bindParam(':email_IN', $regEmail);

                if($stm->execute()){
                    echo "Register success";
                }else {
                    echo "Something went wrong try again";
                }
        
          }
      }
}  
catch(PDOException $error)  
{  
    $message = $error->getMessage();  
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="container">  
    <?php  
        if(isset($message))  
        {  
          echo '<label>'.$message.'</label>';  
        }  
    ?>  
        <h3>Login</h3><br />  
            <form method="post">  
                <label>Username:</label>  
                <input type="text" name="username" class="form-control" />    
                <label>Password:</label>  
                <input type="password" name="password" class="form-control" />    
                <input type="submit" name="login" class="btn btn-info" value="Login" />  
            </form>  

        <h3>Register</h3><br />
            <form method="post">
                <label>Username:</label>
                <input type="text" name="regUsername" class="form-control">
                <label>Password:</label>
                <input type="text" name="regPassword" class="form-control">
                <label>Email:</label>
                <input type="text" name="regEmail" class="form-control">
                <input type="submit" name="register" value="Register"> 
            </form>

</div>  
</body>
</html>