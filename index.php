<?php session_start(); ?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>RideAlong</title>
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

<body>
  <!--[if lte IE 9]>
  <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
<img src="logo.png" alt="log" width="100" height="100" style="padding: 30px 0px;">
<h1>RideAlong</h1>
<?php
  if(!isset($_SESSION['userId'])) {
    require 'login.php';
  } else {

    if(isset($_GET['login'])) {
      if($_GET['login']  == "success")
        echo "You logged in successfully";
    }

    require 'mainpage.php';
  }
?>
<div id="reklamaaaa">
  <div class="reklama-wrapper">
    <p>Your ad can be here!</p>
  </div>
</div>
<div class="footer">
  <p>VGTU, MKDf 16/1 <br>RideAlong</p>
</div>
</body>

</html>