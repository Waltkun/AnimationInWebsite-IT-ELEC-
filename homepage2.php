<?php
session_start();
include("connect2.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style2.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center;padding:15%;">
        <p style="font-size: 50px; font-weight:bold">
            Hello Welcome
        <?php
            if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];

                $query = mysqli_query($conn, "SELECT users.* FROM users WHERE email='$email'");
                while($row=mysqli_fetch_array($query)){
                    echo $row['firstName'].' '.$row['lastName'];

                }
            }
            ?>
            :3
        </p>
        
        
        <p class="logout">
            <a href="logout2.php">Logout</a>
        </p>

    </div>
</body>
</html>
