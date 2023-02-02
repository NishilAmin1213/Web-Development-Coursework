<?php
// PHP SCRIPT THAT RECEIVES THE FORM SUBMISSIONS
session_start();

// DEFINE CONSTANTS TO USE TO CONNECT TO THE DATABASE
$user = 'user1'; //username is root in xampp (change for servers...)
$pass = 'Password1'; //password in xampp is blank (change for servers...)
$db = 'ecm1417db'; //name of the database

// CONNECT TO DATABASE - IF THERES AN ERROR THEN CLOSE THE PROGRAM
$mydb = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");
// CONNECTED TO DB - THERE IS NO ERROR

// CREATE SQL INSERT STATEMENT AND QUERY IT TO THE DATABASE
$sql = "DELETE FROM visits WHERE ID = $_GET[ID]";

if (mysqli_query($mydb, $sql)) {
    // REDIRECT USER
    header("Location: overview.php");
} else {
    // ERROR IN SQL QUERY
echo "Error: " . $sql . "<br>" . $mydb->error;
}






?>
