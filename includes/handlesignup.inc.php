<?php

if(isset($_POST["signup-submit"])) {
    $first_name = $_POST["signup-fname"];
    $last_name = $_POST["signup-lname"];
    $email = $_POST["signup-email"];
    $phone = $_POST["signup-phone"];
    $gender = $_POST["signup-gender"];
    $password = $_POST["signup-password"];
    $passwordRepeat = $_POST["signup-password-repeat"];

    require 'dbh.inc.php';

    if(empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($gender) || empty($password) || empty($passwordRepeat)) {   //Empty field handling
        header("Location: ../index.php");
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) { //Invalid email AND bad username handling
        header("Location: ../index.php");
        exit();
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {                                  //Invalid email handling
        header("Location: ../index.php");
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $first_name)) {                                  //Invalid username handling
        header("Location: ../index.php?error=invalidFName");
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $last_name)) {                                  //Invalid username handling
        header("Location: ../index.php?error=invalidLName");
        exit();
    } elseif($password !== $passwordRepeat) {                                               //Passwords do not match
        header("Location: ../index.php");
        exit();
    } else {
        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
            header("Location: ../index.php?error=sqlerrorOne");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if($resultCheck > 0) {          //Handle existing username
                header("Location: ../index.php?error=emailAlreadyInUse");
                exit();
            } else {
                $sql = "INSERT INTO users (f_name, l_name, email, phone, gender, password) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                    header("Location: ../index.php?error=sqlerrorTwo");
                    exit();
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssiss", $first_name, $last_name, $email, $phone, $gender, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    header("Location: ../index.php?signup=success");
                    exit();
                }
                        
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
} else {
    header("Location: ../index.php");
    exit();
}