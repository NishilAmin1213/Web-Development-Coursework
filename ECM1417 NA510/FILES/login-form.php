<?php
// PHP SCRIPT THAT RECEIVES THE FORM SUBMISSIONS

include 'login-user.php';
// DISPLAY ALL DATA RECEIVED FROM THE TABLE
echo '<pre>'.print_r($_POST,true).'</pre>';

$Username = $_POST["Username"];
$Password = $_POST["Password"];
loginUser($Username, $Password);
?>