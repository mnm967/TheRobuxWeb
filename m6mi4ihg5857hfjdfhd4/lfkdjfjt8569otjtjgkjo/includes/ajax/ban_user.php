<?php
    include("../config.php");
    if(!isset($_POST['userId']) || !isset($_POST['banReason']) || !isset($_POST['userIsBanned'])){
        echo 1;
        exit();
    }

    $userId = $_POST['userId'];
    $banReason = $_POST['banReason'];
    $userIsBanned = $_POST['userIsBanned'];

    $updateQuery = mysqli_query($sqlConnection, "UPDATE users SET isBanned='$userIsBanned', bannedReason='$banReason'WHERE id='$userId'");
    if($updateQuery) echo 0;
?>