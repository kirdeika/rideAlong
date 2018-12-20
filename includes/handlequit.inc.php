<?php

if(isset($_POST['now-trips_quit-trip'])) {
    require 'dbh.inc.php';

    $tripId = $_POST['trip-id'];
    $userId = $_POST['user-id'];

    $sql = "UPDATE passanger SET trip_reserved=NULL WHERE passenger_id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
        header("Location: ../index.php?error=sqlerrorOne");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);

        $sql = "UPDATE passanger SET p_trips_cancelled=p_trips_cancelled + 1 WHERE passenger_id=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
            header("Location: ../index.php?error=sqlerrorOne");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $userId);
            mysqli_stmt_execute($stmt);

            header("Location: ../index.php");
        }


        header("Location: ../index.php");
    }

    exit();
}