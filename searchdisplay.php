<?php

if(isset($_GET['trip_from'])) {
require 'includes/dbh.inc.php';

$trip_from = $_GET['trip_from'];
$trip_to = $_GET['trip_to'];
$trip_date = $_GET['trip_date'];


    $sql = "SELECT * FROM trips WHERE trip_from LIKE '%$trip_from%' AND trip_to LIKE '%$trip_to%' AND trip_start_date LIKE '%$trip_date%'";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
        header("Location: ../index.php?error=sqlerrorOne");
        exit();
    } else {
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $queryResults = mysqli_num_rows($result);

        if($queryResults > 0) {
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            echo '<div class="search-results">';
            while($row = mysqli_fetch_assoc($result)) {          //Handle existing user trip
                echo '
                    <div class="search-results_result">
                        <p>'. $row['trip_start_date'] .'</p>
                        <p>'. $row['trip_from'] .'</p>
                        <p>'. $row['trip_to'] .'</p>
                        <p>'. $row['price'] .'</p>
                        <p>'. $row['seats'] .'</p>
                        <p><a href="'. $link .'&signForTrip= '. $row['id'] .'">Registruotis</a></p>
                    </div>
                ';
            }
            echo '</div>';
        } else {
            echo "Nera kelioniu";
        }
    }
}