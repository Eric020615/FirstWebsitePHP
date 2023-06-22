<?php
session_start();
$mysqli = require 'database.php';
if(!$_SESSION["username"]){
    header("location:index.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $details = $_POST["details"];
    $edit_date = date("Y-m-d");
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $edit_time = date("h:i:sa");
    $decision = "no";
    foreach($_POST["public"] as $each_check){
        if($each_check!=null){
            $decision = "yes";
        }
    }
    $id = $_SESSION["id"];
    // create the update statement for sql 
    $sql = "UPDATE list SET details='$details', public='$decision', date_edited = '$edit_date', time_edited = '$edit_time' WHERE id='$id'";
    $query = $mysqli -> query($sql);
    header("location: home.php");
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
    <h2>Edit Page</h2>
    <p>Hello <?= $_SESSION["username"] ?></p>
    <a href="logout.php"> Click here to logout </a> <br/>
    <a href="home.php"> Return to home page </a>
    <h2 style="text-align: center;">Currently Selected</h2>
    <table style="border: 1px solid black; width: 100%;">
        <tr>
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Public Post</th>
        </tr>
        <?php
            $id = $_GET["id"];
            $_SESSION["id"] = $id;
            $id_exists=true;
            // write sql statement 
            $sql = sprintf("SELECT * FROM list WHERE id='%s'", $mysqli -> real_escape_string($id));
            // get query
            $query = $mysqli -> query($sql);
            // to know that how many row in query
            $count = $query -> num_rows;
            if($count>0){
                while($row = $query -> fetch_assoc()){
                    echo "<tr>";
                            echo "<td style='text-align:center;'>".$row["id"]."</td>";
                            echo "<td style='text-align:center;'>".$row["details"]."</td>";
                            echo "<td style='text-align:center;'>".$row["date_posted"]." ".$row["time_posted"]."</td>";
                            echo "<td style='text-align:center;'>".$row["date_edited"]." ".$row["time_edited"]."</td>";
                            echo "<td style='text-align:center;'>".$row["public"]."</td>";
                    echo "</tr>";
                }
            }
            else{
                $id_exists = false;
            }
        ?>
    </table>
    <br/>
    <?php if($id_exists):?>
        <form action="edit.php" method="post">
            <input type="text" name="details"><br>
            <input type="checkbox" name="public[]" value="yes"><br>
            <input type="submit" value="Update List">
        </form>
    <?php else:?>
        <h2 style="text-align: center;">There is no data to be edited.</h2>
    <?php endif;?>
</body>
</html>