<?php
session_start();
if($_SESSION["username"]){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // get the details from associative array in POST
        $details = $_POST['details'];
        $currentDate = date('Y-m-d');
        // set the current timezone to malaysia kuala lumpur
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $currentTime = date('h:i:sa');
        $decision = "no";
        $mysqli = require "database.php";
        // loop through the process for associative
        // array from the checkbox called public
        // foreach(array as value)
        // foreach(array as key=>value)
        foreach($_POST["public"] as $each_check){
            // loop through the public array to
            // check whether checkbox is checked
            if($each_check != null){
                // sets the value
                $decision = "yes";
            }
        }
        $username = $_SESSION["username"];
        $mysqli -> query("INSERT INTO list (username, details, date_posted, time_posted, public) VALUES ('$username','$details','$currentDate', '$currentTime', '$decision')");
        header("location: home.php");
    }
}else{
    header("Location: login.php");
}
?>