<?php

if(isset($_POST['search-submit'])) {
    require 'dbh.inc.php';

    $travelFrom = $_POST['travel-from'];
    $travelTo = $_POST['travel-to'];
    $travelDate = $_POST['travel-date'];

    header("Location: ../index.php?trip_from=" . $travelFrom . "&trip_to=" . $travelTo . "&trip_date=" . $travelDate);
    exit();
} else {
    header("Location: ../index.php");
    exit();
}