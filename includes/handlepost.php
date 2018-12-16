<?php

if(isset($_POST['post-submit'])) {
    require 'dbh.inc.php';

    $userId = $_SESSION["UserId"];
    $travelFrom = $_POST["traveld-from"];
    $travelTo = $_POST["traveld-to"];
    $travelDate = $_POST["traveld-date"];
    $travelTime = $_POST["traveld-time"];
    $travelPrice = $_POST["traveld-price"];
    $travelSeats = $_POST["traveld-seats"];

    if(empty($travelFrom) || empty($travelTo) || empty($travelDate) || empty($travelTime) || empty($travelPrice) || empty($travelSeats)) {   //Empty field handling
        header("Location: ../index.php?error=emptyFields");
        exit();
    } elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$travelDate)) { //Invalid date format
        header("Location: ../index.php?error=invalidDate");
        exit();
    } elseif(!preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $travelTime)) {                 //Invalid time format handling
        header("Location: ../index.php");
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $travelFrom)) {                                  //Invalid from handling
        header("Location: ../index.php?error=invalidFName");
        exit();
    } elseif(!preg_match("/^[a-zA-Z0-9]*$/", $travelTo)) {                                  //Invalid to handling
        header("Location: ../index.php?error=invalidLName");
        exit();
    } else {
        $sql = "SELECT driver FROM trips WHERE driver=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
            header("Location: ../index.php?error=sqlerrorOne");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);

            if($resultCheck > 0) {          //Handle existing user trip
                header("Location: ../index.php?error=emailAlreadyInUse");
                exit();
            } else {
                $sql = "INSERT INTO trips (trip_start_date, trip_start_time, trip_from, trip_to, price, seats, driver) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                    header("Location: ../index.php?error=sqlerrorTwo");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sssssss", $travelDate, $travelTime, $travelFrom, $travelTo, $travelPrice, $travelSeats, $userId);
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