<?php
    require 'includes/dbh.inc.php';

    $userId = $_SESSION['userId'];

    $sql = "SELECT driver FROM trips WHERE driver=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
        header("Location: ../index.php?error=sqlerrorOne");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);

        if($resultCheck > 0) {          //Handle existing user trip
            echo "Yra kelione";
            exit();
        } else {
            echo "Nera kelioniu";
        }
    }