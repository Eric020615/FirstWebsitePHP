<?php
session_start();
$mysqli = require "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PhP Website</title>
</head>
<body>
    <!-- if username (declared && not null), true-->
    <?php if(isset($_SESSION["username"])):?>
        <?php $username = $_SESSION["username"]; ?>
        <h2>Home Page</h2>
        <p>Welcome back! <?= htmlspecialchars($username) ?></p>
        <a href="logout.php"> Click here to logout! </a> <br/><br/>
        <form action="add.php" method="POST">
            <input type="text" name="details" placeholder="Add more to list?"><br/>
            <input type="checkbox" name="public[]" value="yes"><br/>
            <input type="submit" value="Add to list"/>
        </form>
        <h2 style="text-align: center;">My List</h2>
        <!-- border = border-width, border style, border color; -->
        <table style="border: 1px solid black; width: 100%;">
            <tr>
                <th>Id</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Public Post</th>
            </tr>
            <?php
                $username =$_SESSION["username"];
                $query = $mysqli -> query(sprintf("SELECT * FROM list WHERE username='%s'", $mysqli -> real_escape_string($username)));
                // use while loop fetch data in associated array
                // assigned the associated array one by one to $row 
                while($row = $query -> fetch_assoc()){
                    echo "<tr>";
                        echo "<td style='text-align:center;'>".$row["id"]."</td>";
                        echo "<td style='text-align:center;'>".$row["details"]."</td>";
                        echo "<td style='text-align:center;'>".$row["date_posted"]." ".$row["time_posted"]."</td>";
                        echo "<td style='text-align:center;'>".$row["date_edited"]." ".$row["time_edited"]."</td>";
                        echo '<td style="text-align:center;"><a href="edit.php?id='.$row["id"].'">EDIT</a></td>';
                        echo '<td style="text-align:center;"><a href="#" onclick="myFunction('.$row["id"].')">DELETE</a></td>';
                        echo "<td style='text-align:center;'>".$row["public"]."</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    <?php else:?>
        <p>No cookies</p>
        <?php header("Location: login.php");?>
    <?php endif;?>

    <script>
        function myFunction(id){
            let r = confirm("Are you sure you want to delete this record?");
            if(r=true){
                window.location.assign("delete.php?id="+id);
            }
        }
    </script>
</body>
</html>