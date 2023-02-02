<?php
    function loginUser($Username, $Password) {
        // CONNECT TO THE DATABASE
        $user = 'user1'; //username is root in xampp (change for servers...)
        $pass = 'Password1'; //password in xampp is blank (change for servers...)
        $db = 'ecm1417db'; //name of the database

        //create database and store in var - if theres an error, then terminate program
        $mydb = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to database");
        echo"CONNECTED TO DB\n"; //outputs this if there is no error
        echo"<br>";

        $sql = "SELECT Password, Name, Surname, ID FROM accounts WHERE Username = '$Username'";
        $result = mysqli_query($mydb, $sql);


        if (mysqli_query($mydb, $sql)) {
            echo "QUERIED DATABASE";
            echo '<br>';
            $success = false;
            while($row = mysqli_fetch_assoc($result)) {
                $hashed_pw = $row["Password"];
                if(password_verify($Password, $hashed_pw)){
                    // PASSWORD AND USER VERIFIED SUCCESSFULLY
                    $success = true;
                    // CREATE SESSION
                    session_start();
                    $_SESSION['Name'] = $row["Name"];
                    $_SESSION['Surname'] = $row["Surname"];
                    $_SESSION['Username'] = $Username;
                    $_SESSION['ID'] = $row["ID"];

                    // REDIRECT USER
                    header("Location:homepage.php");
                }
            }
            if (!($success)){
                header("Location:index.php?error=Invalid Login - Please check Credentials");
            }
        } else {
            echo "Error: " . $sql . "<br>" . $mydb->error;
        }
    }
?>
