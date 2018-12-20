<?php
require 'includes/dbh.inc.php';

$userId = $_SESSION['userId'];

$sql = "SELECT * FROM trips WHERE driver=?";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
    header("Location: ../index.php?error=sqlerrorOne");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {          //Handle existing user trip
        echo "<div class='myaccount_now-trips'>";
            echo "<div class='now-trips_date'>";
                echo "<p>". $row['trip_start_date'] ."</p>";
                echo "<p>". $row['trip_start_time'] ."</p>";
            echo "</div>";
            echo "<div class='now-trips_from-to'>";
                echo "<p>". $row['trip_from'] ."</p>";
                echo "<p>". $row['trip_to'] ."</p>";
            echo "</div>";
            echo "<div class='now-trips_price-seats'>";
                echo "<p>". $row['price'] ."</p>";
                echo "<p>". $row['seats'] ."</p>";
            echo "</div>";
            echo "<div class='now-trips_buttons-delete'>";
                echo "<form action='includes/handledelete.inc.php' method='post'>
                <input type='hidden' name='trip-id' value=". $row['id'] ." />
                <button type='submit' name='now-trips_delete-trip' id='now-trips_delete-trip'>Delete</button>
                </form>";
            echo "</div>";
        echo "</div>";
    } else {
        echo "Nera kelioniu";
    }
}

$sql = "SELECT * FROM trips WHERE id IN (SELECT trip_reserved FROM passanger WHERE passenger_id=?)";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
    header("Location: ../index.php?error=sqlerrorOne");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {          //Handle existing user trip
        echo "<div class='myaccount_now-trips'>";
            echo "<div class='now-trips_date'>";
                echo "<p>". $row['trip_start_date'] ."</p>";
                echo "<p>". $row['trip_start_time'] ."</p>";
            echo "</div>";
            echo "<div class='now-trips_from-to'>";
                echo "<p>". $row['trip_from'] ."</p>";
                echo "<p>". $row['trip_to'] ."</p>";
            echo "</div>";
            echo "<div class='now-trips_price-seats'>";
                echo "<p>". $row['price'] ."</p>";
                echo "<p>". $row['seats'] ."</p>";
            echo "</div>";
            echo "<div class='now-trips_buttons-delete'>";
                echo "<form action='includes/handlequit.inc.php' method='post'>
                <input type='hidden' name='trip-id' value=". $row['id'] ." />
                <input type='hidden' name='user-id' value=".  $userId ." />
                <button type='submit' name='now-trips_quit-trip' id='now-trips_quit-trip'>Quit</button>
                </form>";
                echo "<form action='user.php' method='get'>
                <input type='hidden' name='user' value=". $row['driver'] ." />
                <input type='hidden' name='userid' value=". $userId ." />
                <button type='submit' id='now-trips_quit-trip'>Driver Profile</button>
                </form>";
            echo "</div>";
        echo "</div>";
    } else {
        echo "Nera kelioniu";
    }
    exit();
}