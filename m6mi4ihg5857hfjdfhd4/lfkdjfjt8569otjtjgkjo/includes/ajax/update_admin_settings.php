<?php
    include("../config.php");
    if(!isset($_POST['robloxGroupId']) 
    || !isset($_POST['robloxCookie']) 
    || !isset($_POST['isAdgateAvailable']) 
    || !isset($_POST['isOffertoroAvailable']) 
    || !isset($_POST['isWannadsAvailable']) 
    || !isset($_POST['isOffertoroAltAvailable']) 
    || !isset($_POST['robloxCurrentStock'])){
        echo 1;
        exit();
    }

    $robloxGroupId = $_POST['robloxGroupId'];
    $robloxCookie = $_POST['robloxCookie'];
    $isAdgateAvailable = $_POST['isAdgateAvailable'];
    $isOffertoroAvailable = $_POST['isOffertoroAvailable'];
    $isWannadsAvailable = $_POST['isWannadsAvailable'];
    $isOffertoroAltAvailable = $_POST['isOffertoroAltAvailable'];
    $robloxCurrentStock = $_POST['robloxCurrentStock'];

    $updateQuery = mysqli_query($sqlConnection, "UPDATE config SET robuxGroupId='$robloxGroupId', 
                cookie='$robloxCookie', 
                isAdgateAvailable='$isAdgateAvailable', 
                isOffertoroAvailable='$isOffertoroAvailable', 
                isWannadsAvailable='$isWannadsAvailable', 
                isOffertoroAltAvailable='$isOffertoroAltAvailable', 
                currentRobuxStock='$robloxCurrentStock' WHERE id='1'");
    if($updateQuery) echo 0;
?>