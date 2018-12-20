<head>
<title>RideAlong | User</title>
<meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Cache-control" content="no-cache">

  <!-- <link rel="manifest" href="site.webmanifest"> -->
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css"> -->
  <link rel="stylesheet" href="css/mainas.css">
</head>
<body><div class="profile-wrapper">
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

                $sql = "SELECT driver_rating, trips_cancelled, p_trips_cancelled, passenger_rating FROM driver, passanger WHERE driver_id=? AND passenger_id=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../login.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ii", $userProfileId, $userProfileId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if($row = mysqli_fetch_assoc($result)) {
                        echo "<p>Driver rating: ". $row['driver_rating'] ."</p>";
                        echo "<p>Passenger rating: ". $row['passenger_rating'] ."</p>";
                        echo "<p>Drives cancelled: ". $row['trips_cancelled'] ."</p>";
                        echo "<p>Trip registrations cancelled: ". $row['p_trips_cancelled'] ."</p>";
                    }
                }

                if($userId != $userProfileId) {
                    echo "<form action='' method='get'>
                        <label for='votepassenger'>Passenger</label><br />
                        <input type='hidden' name='user' value='". $userProfileId ."'/>Up
                        <input type='radio' name='votepassenger' value='up'/>Up
                        <input type='radio' name='votepassenger' value='down'/>Down
                        <button type='submit'>Vote</button>
                    </form>";
                    echo "<form action='' method='get'>
                        <label for='votedriver'>Driver</label>
                        <input type='hidden' name='user' value='". $userProfileId ."'/>Up
                        <input type='radio' name='votedriver' value='up'/>Up
                        <input type='radio' name='votedriver' value='down'/>Down
                        <button type='submit'>Vote</button>
                    </form>";
                }
            }
        }

        if(isset($_GET['votepassenger'])) {
            $votepassenger = $_GET['votepassenger'];
            if($votepassenger == 'up') {
                $sql = "UPDATE passanger SET passenger_rating=passenger_rating + 1 WHERE passenger_id=?";
            } elseif($votepassenger == 'down') {
                $sql = "UPDATE passanger SET passenger_rating=passenger_rating - 1 WHERE passenger_id=?";
            }

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                header("Location: ../signup.php?error=sqlerrorTwo");
                exit();
            } else {
                
                mysqli_stmt_bind_param($stmt, "i", $userProfileId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
        }
        if(isset($_GET['votedriver'])) {
            $votepassenger = $_GET['votedriver'];
            if($votepassenger == 'up') {
                $sql = "UPDATE driver SET driver_rating=driver_rating + 1 WHERE driver_id=?";
            } elseif($votepassenger == 'down') {
                $sql = "UPDATE driver SET driver_rating=driver_rating - 1 WHERE driver_id=?";
            }

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {         //Handle sql error
                header("Location: ../signup.php?error=sqlerrorTwo");
                exit();
            } else {
                
                mysqli_stmt_bind_param($stmt, "i", $userProfileId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
            }
        }
    }
    ?>
</div>
<div><a href="." style="text-decoration: none;"><button>Go back</button></a></div>
</body>