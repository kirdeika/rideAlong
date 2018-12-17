<?php

if(isset($_POST['search-submit'])) {
    require 'dbh.inc.php';

    $travelFrom = $_POST['travel-from'];
    $travelTo = $_POST['travel-to'];
    $travelDate = $_POST['travel-date'];

    $sql = "SELECT * FROM trips WHERE trip_from=? AND trip_to=? ORDER BY trip_start_date";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $travelFrom, $travelTo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)) {
            echo $row['trip_from'] . $row['trip_to'];

            header("Location: ../index.php?trip_from=" . $row['trip_from'] . "&trip_to=" . $row['trip_to']);
        }
    }
}