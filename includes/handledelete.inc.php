<?php

if(isset($_POST['now-trips_delete-trip'])) {
    require 'dbh.inc.php';

    

    header("Location: ../index.php?trip=deleted");
    exit();
}