<?php include("includes/header.php")?>
<?php 
    $availabilityQuery = mysqli_query($sqlConnection, "SELECT * FROM config WHERE id='1'");
    $row = mysqli_fetch_array($availabilityQuery);
    $isAdgateAvailable = $row['isAdgateAvailable'] == 1;
    $isOffertoroAvailable = $row['isOffertoroAvailable'] == 1;
    $isWannadsAvailable = $row['isWannadsAvailable'] == 1;
    $isOffertoroAltAvailable = $row['isOffertoroAltAvailable'] == 1;
?>
<div style="min-height: 85vh;">
<div class="row" style="margin-left: 20px; margin-right: 20px; padding-left: 15px; padding-right: 15px;">
    <div class="card card-nav-tabs text-center" style="background: #F44336 !important; margin-bottom: 0; padding-bottom: 18px">
        <div class="card-body">
            <div class="col-md-12">
                <h3 class="card-text" style="color: #fff; width: 100%; text-align: center; line-height: 1em;">
                    We highly recommend using your mobile device to ensure offers work properly.
                </h3>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px; padding-left: 15px; padding-right: 15px;">
    <a style="width: 100%" href="https://discord.gg/6szyDGH" target="_blank">
        <div class="card card-nav-tabs text-center grow" style="background: #7289da !important; margin-bottom: 0; padding-bottom: 18px">
            <div class="card-body">
                <div class="col-md-12">
                    <h3 class="card-text" style="color: #fff; width: 100%; text-align: center; line-height: 1em;">
                        <img src="assets/img/icons/discord.png" height="32px" width="32px" style="margin-right: 8px"> Join Our Discord Server
                    </h3>
                </div>
            </div>
        </div>
    </a>
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px; padding-left: 15px; padding-right: 15px;">
<div class="card card-nav-tabs text-center" style="background: #4caf50 !important; margin-bottom: 0; padding-bottom: 16px">
    <div class="card-body">
    <div class="col-md-12">
        <h3 class="card-title" style="color: #fff; width: 100%; text-align: center;">My Username</h3>
        <h4 class="card-text" style="color: #fff; width: 100%; text-align: center;">
        <?php $uid = $_SESSION['userLoggedIn']; 
            $usernameQuery = mysqli_query($sqlConnection, "SELECT username FROM users WHERE id='$uid'");
            $username = mysqli_fetch_array($usernameQuery)['username'];
            echo $username;
            ?></h4>
    </div>
    </div>
</div>
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px;">
    <div class="col-md-6">
        <div class="card" style="background: #4caf50 !important; margin-bottom: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: white; font-family: 'Roboto'">R$ Earned By Users:</h3>
                <h4 class="card-subtitle mb-2" style="color: white;"><?php
                    $totalQuery = mysqli_query($sqlConnection, "SELECT SUM(totalPointsEarned) as amountEarned FROM users");
                    $amountEarned = mysqli_fetch_array($totalQuery)['amountEarned'];
                    if($amountEarned < 99999999) echo "R$ ".number_format($amountEarned, 0, ".", " ");
                    else echo "R$ 99 999 999+";
                ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="background: #4caf50 !important; margin-bottom: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: white;">R$ Stock:</h3>
                <h4 class="card-subtitle mb-2" style="color: white;"><?php
                    $stockQuery = mysqli_query($sqlConnection, "SELECT currentRobuxStock FROM config WHERE id='1'");
                    $currStock = mysqli_fetch_array($stockQuery)['currentRobuxStock'];
                    if($currStock < 99999999) echo "R$ " . number_format($currStock, 0, ".", " ");
                    else echo "R$ 99 999 999+";
                ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-left: 20px; margin-right: 20px;">
    <div class="col-md-6">
        <div class="card"style="background: #FF5722 !important; margin-bottom: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: white;">Adgate Media</h3>
                <h4 class="card-text" style="color: white;">Complete Offers and Surveys to Earn RBX. Note: After completing an offer, it may take couple of minutes to receive your points</h4>
                <a href="http://wall.adgaterewards.com/nqqcqw/<?php echo $_SESSION['userLoggedIn'];?>" target="_blank" class="btn btn-primary" style="<?php if(!$isAdgateAvailable) echo 'display: none;';?> background: #F4511E !important" >OPEN OFFERWALL</a>
                <button class="btn btn-primary" style="<?php if($isAdgateAvailable) echo 'display: none;';?> background: #F4511E !important" >UNAVAILABLE</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card"style="background: #2196F3 !important; margin-bottom: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: white;">Offertoro</h3>
                <h4 class="card-text" style="color: white;">Complete Offers and Surveys to Earn RBX. Note: After completing an offer, it may take couple of minutes to receive your points</h4>
                <a href="https://www.offertoro.com/ifr/show/20948/<?php echo $_SESSION['userLoggedIn'];?>/8109" target="_blank" class="btn btn-primary" style="<?php if(!$isOffertoroAvailable) echo 'display: none;';?> background: #1E88E5 !important" >OPEN OFFERWALL</a>
                <button class="btn btn-primary" style="<?php if($isOffertoroAvailable) echo 'display: none;';?> background: #1E88E5 !important" >UNAVAILABLE</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card"style="background: #9C27B0 !important; margin-bottom: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: white;">Wannads</h3>
                <h4 class="card-text" style="color: white;">Complete Offers and Surveys to Earn RBX. Note: After completing an offer, it may take couple of minutes to receive your points</h4>
                <a href="https://wall.wannads.com/wall?apiKey=5d2f5de073f01264092532&userId=<?php echo $_SESSION['userLoggedIn'];?>" target="_blank" class="btn btn-primary" style="<?php if(!$isWannadsAvailable) echo 'display: none;';?> background: #8E24AA !important" >OPEN OFFERWALL</a>
                <button class="btn btn-primary" style="<?php if($isWannadsAvailable) echo 'display: none;';?> background: #8E24AA !important" >UNAVAILABLE</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card"style="background: #F44336 !important; margin-bottom: 0;">
            <div class="card-body">
                <h3 class="card-title" style="color: white;">Offertoro 2</h3>
                <h4 class="card-text" style="color: white;">Complete Offers and Surveys to Earn RBX. Note: After completing an offer, it may take couple of minutes to receive your points</h4>
                <a href="http://www.offertoro.com/click_track/api?offer_id=19423936&pub_id=20948&pub_app_id=8109&USER_ID=<?php echo $_SESSION['userLoggedIn'];?>" target="_blank" class="btn btn-primary" style="<?php if(!$isOffertoroAltAvailable) echo 'display: none;';?>background: #E53935 !important" >OPEN OFFERWALL</a>
                <button class="btn btn-primary" style="<?php if($isOffertoroAltAvailable) echo 'display: none;';?> background: #E53935 !important" >UNAVAILABLE</button>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("includes/footer.php")?>