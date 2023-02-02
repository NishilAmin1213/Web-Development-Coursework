<?php
    session_start();

// DEFINE CONSTANTS TO USE TO CONNECT TO THE DATABASE
$user = 'user1'; //username is root in xampp (change for servers...)
$pass = 'Password1'; //password in xampp is blank (change for servers...)
$db = 'ecm1417db'; //name of the database

    $ID = $_SESSION['ID'];

    //create database and store in var - if theres an error, then terminate program
    $mydb = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");

    $sql = "SELECT Date, Time, Duration, posX, posY FROM visits WHERE UserID = '$ID'";
    $result = mysqli_query($mydb, $sql);

    if (mysqli_query($mydb, $sql)) {
        while($row = mysqli_fetch_assoc($result)) {
            // ITERATE OVER EACH ROW AND DISPLAY STUFF TO THE PAGE

            echo '<tr><td>',$row['Date'],'</td><td>',$row['Time'],'</td><td>',$row['Duration'],'</td><td>',$row['posX'],'</td><td>',$row['posY'],'</td></tr>';
        }
    } else {
        echo "Error: " . $sql . "<br>" . $mydb->error;
    }

?>
