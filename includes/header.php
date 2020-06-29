<?php
    include("includes/config.php");
    if(isset($_SESSION['rid'])) unset($_SESSION['rid']);
    if(!isset($_SESSION['userLoggedIn'])){
      header("Location: login.php");
      exit();
    }
    $userId = $_SESSION['userLoggedIn'];
	
	$userExistsCheck = mysqli_query($sqlConnection, "SELECT * FROM users WHERE id='$userId'");
	if(mysqli_num_rows($userExistsCheck) == 0){
		session_destroy();
		header("Location: login.php");
	}

    $usernameCheckQuery = mysqli_query($sqlConnection, "SELECT username FROM users WHERE id='$userId'");
    $username = mysqli_fetch_array($usernameCheckQuery)['username'];
    if($username == null){
      header("Location: username.php");
    }else{
      if(empty($username) || $username = ""){
        header("Location: username.php");
      }
    }
	$banCheck = mysqli_query($sqlConnection, "SELECT isBanned FROM users WHERE id='$userId'");
	$isBanned = mysqli_fetch_array($banCheck)['isBanned'];
	if($isBanned == 1){
		header("Location: banned.php");
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>TheRobux.com | Earn Free Robux for Roblox</title>
    <link rel="shortcut icon" href="assets/img/icons/dollar.svg" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="Description" content="TheRobux.com is the best source to earn Robux for Roblox. Completely Free! Sign Up and start earning robux today.">
    <meta property="og:description" content="Best way to earn Free robux for Roblox!">
    <meta name="author" content="TheRobux.com">
    <meta property="og:title" content="TheRobux.com | Earn Free Robux for Roblox">
    <meta property="og:image" content="https://www.therobux.com/assets/img/icons/icon.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="TheRobux.com | Earn Free Robux for Roblox">
    <meta name="twitter:description" content="Gain Free Robux by installing apps and completing surveys">
    <meta name="twitter:image" content="https://www.therobux.com/assets/img/icons/icon.png">
    <meta name="twitter:description" content="Gain Free Robux by installing apps and completing surveys">
    <meta name="twitter:image" content="https://www.therobux.com/assets/img/icons/icon.png">
    <link rel="canonical" href="https://therobux.com/">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />
    <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144395782-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-144395782-1');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-2822139425098818",
          enable_page_level_ads: true
     });
    </script>
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
          <a class="nav-link" href="earn.php"><i class="material-icons nav-menu-icon">monetization_on</i> Earn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="referrals.php"><i class="material-icons nav-menu-icon">people</i> Referrals</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="leaderboard.php"><i class="material-icons nav-menu-icon">format_list_numbered</i> Leaderboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="withdraw.php"><i class="material-icons nav-menu-icon">account_balance</i> Withdraw</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="history.php"><i class="material-icons nav-menu-icon">history</i> History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="help.php"><i class="material-icons nav-menu-icon">help</i> Help</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="material-icons nav-menu-icon">logout</i> Logout</a>
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
  function checkNewEarnings(){
    $.post("includes/ajax/check_earnings.php", function(result){
        var newEarnings = JSON.parse(result);
        if(newEarnings.length > 0){
          var earnText = "";
          for(var i = 0; i < newEarnings.length; i++){
            var item = newEarnings[i];
            if(earnText != "") earnText += "<br>";
            earnText += "Offerwall: "+item.offerwallName + "<br>Amount: R$ " + item.amountEarned+ "<br>Date: " + item.earnedDate+"<br>";
          }
          $("#modal-title").html("You have New Earnings");
          $("#modal-body").html(earnText);
          $("#modal-trigger").click();
        }
    });
  }
  checkNewEarnings();
  setInterval(() => {
    checkNewEarnings();
  }, 60*1000);
</script>