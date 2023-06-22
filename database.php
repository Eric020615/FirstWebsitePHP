<?php
$host = "localhost";
$db_name = "demo_db";
$username = "root";
$password = "";
// https://www.tutorialrepublic.com/php-tutorial/php-mysql-connect.php
// MySqli, Object Oriented Way
// create connection
$mysqli = new mysqli(hostname:$host, username:$username, password:$password, database: $db_name);
// access the variable of mysqli
// check connection
if($mysqli -> connect_errno){
    die("connection error".$mysqli -> connect_error);
}
// export objects
return $mysqli;
?>