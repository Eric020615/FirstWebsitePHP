<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PhP Website</title>
</head>
<body>
    <h2>Registration Page</h2>
    <a href="index.php">Click here to go back.</a><br/><br/>
    <form action="register.php" method="post">
        Enter Username: <input type="text" name="username" required/><br/>
        Enter Password: <input type="text" name="password" required/><br/>
        <input type="submit" value="Register"/>
    </form>
</body>
</html>

<?php
// associative array
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // when we submit the form create a http request which is POST\
    // get the username in the form
    $mysqli = require 'database.php';
    // sql statement
    $sql = "INSERT INTO auth_tb (username, password) VALUES (?,?)";
    // initialise an variable and use to do the prepare statement for mysql
    $stmt = $mysqli -> stmt_init();
    // if stmt prepare the sql statatement sucessfully
    if(!$stmt -> prepare($sql)){
        die("SQL Error:".$mysqli->error);
    };
    // prepare and bind
    $stmt -> bind_param("ss",$username,$password_hash);
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
    if($stmt -> execute()){
        session_start();
        $_SESSION['username'] = $_POST["username"];
        header("Location: home.php");
        exit;
    }
    else{
        if($mysqli->errno===1062){
            echo "Username had been used.";
        }
        else{

        }
    }
}
?>