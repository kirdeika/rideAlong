<?php

if(isset($_POST['search-submit'])) {
    require 'dbh.inc.php';

    $travelFrom = $_POST['travel-from'];
    $travelTo = $_POST['travel-to'];
    $travelDate = $_POST['travel-date'];

    $sql = "SELECT * FROM trips WHERE starting_place=? AND destination_place=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $travelFrom, $travelTo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($result)) {
            echo $row['starting_place'] . $row['destination_place'] . $row['travel_time'] . $row['travel_price'];
        }
    }
}