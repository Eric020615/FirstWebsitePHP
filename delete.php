<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $mysqli = require 'database.php';
    $id = $_GET["id"];
    $sql = "DELETE FROM list WHERE id='$id'";
    $query = $mysqli -> query($sql);
    // similar to window.location.assign("home.php");
    header("location:home.php");
}
?>