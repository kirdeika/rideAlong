<?php
    session_start();
    if(isset($_GET['user'])) {
        require 'includes/dbh.inc.php';

        $userProfileId = $_GET['user'];
        $userId = $_SESSION['userId'];

        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $userProfileId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)) {
                echo "
                    <p>First Name: ". $row['f_name'] ."</p>
                    <p>Last Name: ". $row['l_name'] ."</p>
                    <p>E-mail: ". $row['email'] ."</p>
                    <p>Phone: ". $row['phone'] ."</p>
                    <p>Gender: ". $row['gender'] ."</p>
                ";
                if($userId != $userProfileId) {
                    echo "<a href='#'>Vote up</a>";
                    echo "<a href='#'>Vote down</a>";
                }
            }
        }
    }