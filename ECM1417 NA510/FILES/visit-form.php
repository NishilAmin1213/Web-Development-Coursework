<?php
// PHP SCRIPT THAT RECEIVES THE FORM SUBMISSIONS
session_start();
include 'login-user.php';
// DISPLAY ALL DATA RECEIVED FROM THE TABLE
echo '<pre>'.print_r($_POST,true).'</pre>';

$ID = $_SESSION['ID'];
echo '<br>';
echo $ID;
$Date = $_POST["Date"];
$Time = $_POST["Time"];
$Duration = $_POST['Duration'];
$posX = $_POST["posX"];
$posY= $_POST["posY"];

$valid = true;
if ($posY == Null || $posX == Null) {
    header("Location:addvisit.php?error=Please Select Coordinates");
    $valid = false;
}

if($valid){
    // DEFINE CONSTANTS TO USE TO CONNECT TO THE DATABASE
    $user = 'user1'; //username is root in xampp (change for servers...)
    $pass = 'Password1'; //password in xampp is blank (change for servers...)
    $db = 'ecm1417db'; //name of the database

// CONNECT TO DATABASE - IF THERES AN ERROR THEN CLOSE THE PROGRAM
    $mydb = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");
// CONNECTED TO DB - THERE IS NO ERROR

// CREATE SQL INSERT STATEMENT AND QUERY IT TO THE DATABASE
    $sql = "INSERT INTO visits (Date, Time, Duration, posX, posY, UserID) VALUES ('$Date', '$Time', '$Duration', '$posX', '$posY', '$ID')";

    if (mysqli_query($mydb, $sql)) {
        // REDIRECT USER
        header("Location: homepage.php");
    } else {
        // ERROR IN SQL QUERY
        echo "Error: " . $sql . "<br>" . $mydb->error;
    }
}





?>
