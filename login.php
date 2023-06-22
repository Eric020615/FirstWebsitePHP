<?php
// set variable at the global scope
$account_valid = true; 
$password_valid = true;
if($_SERVER["REQUEST_METHOD"]==="POST"){
    // import object from mysql
    $mysqli = require 'database.php';
    // write sql statement
    $sql = sprintf("SELECT * FROM auth_tb WHERE username = '%s'", $mysqli -> real_escape_string($_POST["username"]));
    // get the query based on the sql statement
    // query(sqlstatement) return a query object
    $query = $mysqli -> query($sql);
    // fetch all the queries as associative array
    $user = $query -> fetch_assoc();
    // $user == Array ( [id] => 32 [username] => JJJ [password] => $2y$10$.bOZNiDmjNd5pjoADYMR9eYu3PrbthaXJSGaEsubK/BEQFCYVMyZu )
    if($user){
        if(password_verify($_POST["password"],$user["password"])){
            // print msg and end the script
            // die("login successful");
            session_start();
            // when we start session and load login page and the session may be started alr
            session_regenerate_id();
            // store user id in the superglobal variable in the associated array form
            // Array()
            // Array([user_id]=>8)
            $_SESSION["username"] = $user["username"];
            header("Location: home.php");
            exit;
        }
        else{
            $password_valid = false;
        }
    }
    else{
        $account_valid = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PhP Website</title>
</head>
<body>
    <h2>Login Page</h2>
    <a href="index.php">Click here to go back.</a><br/><br/>
    <form method="post">
        Enter Username: <input type="text" name="username" required/><br/>
        <?php if(!$account_valid):?>
            <div>Account not exists.</div>
        <?php endif; ?>
        Enter Password: <input type="text" name="password" required/><br/>
        <?php if(!$password_valid):?>
            <div>Password wrong.</div>
        <?php endif; ?>
        <input type="submit" value="Login"/>
    </form>
</body>
</html>