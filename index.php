<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PhP Website</title>
</head>
<body>
    <?php
        echo "<p>Hello World!</p>";
    ?>  
    <a href="login.php"> Click here to login </a> <br/>
    <a href="register.php"> Click here to register </a>
    <table style="border:1px solid black; width:100%";>
        <tr>
            <th style="text-align: center;">id</th>
            <th style="text-align: center;">Details</th>
            <th style="text-align: center;">Post Time</th>
            <th style="text-align: center;">Edit Time</th>
        </tr>
        <?php
            $mysqli = require 'database.php';
            $sql = "SELECT * FROM list WHERE public='yes'";
            $query = $mysqli -> query($sql);
            while($row = $query -> fetch_assoc()){
                echo '<tr>';
                echo '<th style="text-align: center;">'.$row["id"].'</th>';
                echo '<th style="text-align: center;">'.$row["details"].'</th>';
                echo '<th style="text-align: center;">'.$row["date_posted"].' '.$row["time_posted"].'</th>';
                echo '<th style="text-align: center;">'.$row["date_edited"].' '.$row["time_edited"].'</th>';
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>