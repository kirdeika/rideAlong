<?php

if(isset($_GET['signForTrip'])) {
    require 'includes/dbh.inc.php';

    $tripId = $_GET['signForTrip'];
    $userId = $_SESSION['userId'];

    $sql = "SELECT * FROM passanger WHERE passenger_id=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
        header("Location: ../index.php?error=sqlerrorOne");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $queryResults = mysqli_num_rows($result);

        if($queryResults > 0) {
            echo 'You already have trip registered!';
        } else {
            $sql = "SELECT * FROM trips WHERE id=?";
            $stmt = mysqli_stmt_init($conn);
        
            if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                header("Location: ../index.php?error=sqlerrorOne");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "i", $tripId);
                mysqli_stmt_execute($stmt);
                
                $result = mysqli_stmt_get_result($stmt);
                $queryResults = mysqli_num_rows($result);
        
                if($queryResults > 0) {
                    while($row = mysqli_fetch_assoc($result)) {          //Handle existing user trip
                        if($row['driver'] != $_SESSION['userId']) {
                            $sql = "UPDATE passanger SET trip_reserved=? WHERE passenger_id=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                                header("Location: ../signup.php?error=sqlerrorTwo");
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "ii", $tripId, $userId);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                echo 'success';
                            }
                        } else {
                            echo 'Negalite registruotis i savo kelione!';
                        }
                    }
                } else {
                    echo "Nera kelioniu";
                }
            }
        }
    }
}