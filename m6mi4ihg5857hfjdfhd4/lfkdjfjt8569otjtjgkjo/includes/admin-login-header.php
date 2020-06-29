<?php
    include("includes/config.php");
    
    if(isset($_SESSION['adminLoggedIn'])){
      header("Location: admin-dashboard.php");
    }
    ?>
<!doctype html>
<html lang="en">
  <head>
    <title>TheRobux.com</title>
    <link rel="shortcut icon" href="assets/img/icons/dollar.svg" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  </head>
  <body>
  <div class="bg-success">
  <nav class="navbar navbar-expand-lg bg-success">
  <div class="container">
    <a href="index.php">
      <span class="navbar-brand" style="margin-right: 56px; padding: 0;  color: #fff">
        <img src="assets/img/icons/pay-per-click.svg" style="height: 48px;margin-right: 12px;"> TheRobux.com
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon"></span>
    <span class="navbar-toggler-icon"></span>
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="admin-login.php"><i class="material-icons nav-menu-icon">person</i> Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>