<?php
    include("includes/config.php");
    if(isset($_SESSION['rid'])) unset($_SESSION['rid']);
    if(!isset($_SESSION['adminLoggedIn'])){
      header("Location: admin-login.php");
    }
    $userId = $_SESSION['adminLoggedIn'];
	
	$userExistsCheck = mysqli_query($sqlConnection, "SELECT * FROM adminusers WHERE id='$userId'");
	if(mysqli_num_rows($userExistsCheck) == 0){
		session_destroy();
		header("Location: admin-login.php");
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

  <button type="button" style="display: none;" class="btn btn-primary" id="modal-trigger" data-toggle="modal" data-target="#main_modal"></button>

<!-- Modal -->
<div class="modal fade" id="main_modal" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Notification</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <h5 class="modal-body" id="modal-body">
        ...
      </h5>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" style="color: #4caf50" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <div class="bg-success">
  <nav class="navbar navbar-expand-lg bg-success">
  <div class="container">
    <a href="index.php">
      <span class="navbar-brand" style="margin-right: 56px; padding: 0; color: #fff">
        <img src="assets/img/icons/pay-per-click.svg" style="height: 48px;margin-right: 12px;"> TheRobux.com
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle Navigation</span>
    <span class="navbar-toggler-icon"></span>
    <span class="navbar-toggler-icon"></span>
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="admin-dashboard.php"><i class="material-icons nav-menu-icon">assessment</i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-users.php"><i class="material-icons nav-menu-icon">person</i> Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-latest-earnings.php"><i class="material-icons nav-menu-icon">history</i> Earnings History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-latest-withdrawls.php"><i class="material-icons nav-menu-icon">account_balance</i> Withdraw History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin-logout.php"><i class="material-icons nav-menu-icon">logout</i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
<script>
  function showModal(title, body){
    $("#modal-title").html(title);
    $("#modal-body").html(body);
    $("#modal-trigger").click();
  }
</script>