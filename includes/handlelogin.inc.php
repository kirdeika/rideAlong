<?php

if(isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $username = $_POST['login-name'];
    $password = $_POST['login-password'];

    if(empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                $passCheck = password_verify($password, $row['pswrd']);

                if(!$passCheck) {
                    header("Location: ../index.php?error=incorrectpass");
                    exit();
                } elseif($passCheck) {  //Login success
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userUsername'] = $row['username'];

                    header("Location: ../index.php?login=success");
                    exit();

                } else {    //In case verify function fails, we fall back not logging in
                    header("Location: ../index.php?error=incorrectpass");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nosuchuser");
                exit();
            }
        }
    }
}