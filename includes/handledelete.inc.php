<?php

if(isset($_POST['now-trips_delete-trip'])) {
    require 'dbh.inc.php';

    $tripId = $_POST['trip-id'];

    $sql = "DELETE FROM trips WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
        header("Location: ../index.php?error=sqlerrorOne");
        exit();
    } else {
        echo $tripId;
        mysqli_stmt_bind_param($stmt, "i", $tripId);
        mysqli_stmt_execute($stmt);

        header("Location: ../index.php");
    }

    exit();
}