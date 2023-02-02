<?php
// PHP SCRIPT THAT RECEIVES THE FORM SUBMISSIONS
include 'login-user.php';

// DISPLAY ALL DATA RECEIVED FROM THE TABLE
echo '<pre>'.print_r($_POST,true).'</pre>';
$Name = $_POST["Name"];
$Surname = $_POST["Surname"];
$Username = $_POST["Username"];
$Password = $_POST["Password"];

// DEFINE CONSTANTS TO USE TO CONNECT TO THE DATABASE
$user = 'user1'; //username is root in xampp (change for servers...)
$pass = 'Password1'; //password in xampp is blank (change for servers...)
$db = 'ecm1417db'; //name of the database


// CONNECT TO DATABASE - IF THERES AN ERROR THEN CLOSE THE PROGRAM
$mydb = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");
echo 'connected to db';
echo '<br>';
// CONNECTED TO DB - THERE IS NO ERROR

// make sure username is unique
$sql = "SELECT * from accounts";
$result = mysqli_query($mydb, $sql);
if (mysqli_query($mydb, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['Username'] == $Username){
            //USERNAME INVALID
            header("Location: registration.php?error=Username Taken - Please try another one");
            die("Error");
        }
    }
}

// CREATE SQL INSERT STATEMENT AND QUERY IT TO THE DATABASE
$HashedPassword = password_hash($Password, PASSWORD_BCRYPT);
$sql = "INSERT INTO accounts (Name, Surname, Username, Password) VALUES ('$Name', '$Surname', '$Username', '$HashedPassword')";

if (mysqli_query($mydb, $sql)) {
    // USER ADDED SUCCESSFULLY
    // CREATE SESSION

    // REDIRECT USER
    loginUser($Username, $Password);
} else {
    // ERROR IN SQL QUERY
    echo "Error: " . $sql . "<br>" . $mydb->error;
}


?>
