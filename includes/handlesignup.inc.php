<?php

if(isset($_POST["signup-submit"])) {
    $username = $_POST["signup-name"];
    $email = $_POST["signup-email"];
    $password = $_POST["signup-password"];
    $passwordRepeat = $_POST["signup-password-repeat"];

    require 'dbh.inc.php';

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {   //Empty field handling
        header("Location: ../signup.php");
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) { //Invalid email AND bad username handling
        header("Location: ../signup.php");
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {                                  //Invalid email handling
        header("Location: ../signup.php");
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {                                  //Invalid username handling
        header("Location: ../signup.php?error=invalidUsername");
        exit();
    } elseif($password !== $passwordRepeat) {                                               //Passwords do not match
        header("Location: ../signup.php");
        exit();
    } else {
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
            header("Location: ../signup.php?error=sqlerrorOne");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if($resultCheck > 0) {          //Handle existing username
                header("Location: ../signup.php");
                exit();
            } else {
                $sql = "INSERT INTO users (username, email, pswrd) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                    header("Location: ../signup.php?error=sqlerrorTwo");
                    exit();
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
} else {
    echo 'YOU ARE NOT ALLOWED HERE';
}