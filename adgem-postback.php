<?php 
    include("includes/postback-config.php");

    $validIps = array();
    array_push($validIps, "INSERT_ADGEM_STATIC_IP_ADDRESS");

    /*if(!in_array($_SERVER['REMOTE_ADDR'], $validIps)){
        echo 0;
    }*/

    $userId = $_GET['player_id'];
    $amount = $_GET['amount'];
    $userIpAddress = $_GET['ip'];
    $oid = $_GET['campaign_id'];
    $payout = $_GET['payout'];
    $transactionId = $_GET['transaction_id'];

    $newTransQuery = mysqli_query($sqlConnection, "SELECT id FROM earnings_history WHERE transactionId='$transactionId' AND offerwallName='Wannads'");
    if(mysqli_num_rows($newTransQuery) > 0){
        echo 1;
		exit();
    }

    $userHistoryQuery = mysqli_query($sqlConnection, "INSERT INTO earnings_history (userId, offerId, offerwallName, amountEarned, transactionId, ipAddress) VALUES('$userId', '$oid', 'Wannads', '$amount', '$transactionId', '$userIpAddress')") or die(mysqli_error($sqlConnection));
    $earnId = mysqli_insert_id($sqlConnection);

    $adminEarningsQuery = mysqli_query($sqlConnection, "INSERT INTO admin_earnings (userId, earnId, offerwallName, amount) VALUES('$userId', '$earnId', 'Wannads', '$payout')") or die(mysqli_error($sqlConnection));
    
    $updateUser = mysqli_query($sqlConnection, "UPDATE users SET totalPointsEarned = totalPointsEarned + $amount, currentPoints = currentPoints+$amount, totalOffersCompleted = totalOffersCompleted + 1 WHERE id='$userId'") or die(mysqli_error($sqlConnection));

    $referralQuery = mysqli_query($sqlConnection, "SELECT * FROM referrals WHERE referredUserId='$userId' AND isPaid=0");
    if(mysqli_num_rows($referralQuery) > 0){
        $row = mysqli_fetch_array($referralQuery);
        $referId = $row['id'];
        $referrerUserId = $row['referrerUserId'];

        $referPayQuery = mysqli_query($sqlConnection, "INSERT INTO earnings_history (userId, offerId, offerwallName, transactionId, amountEarned, ipAddress) VALUES('$referrerUserId', '0', 'Referral', 'transactionId', 10, '$userIpAddress')") or die(mysqli_error($sqlConnection));
        $referralUpdate = mysqli_query($sqlConnection, "UPDATE referrals SET isPaid=1 WHERE id='$referId'") or die(mysqli_error($sqlConnection));
        $updateUserCount = mysqli_query($sqlConnection, "UPDATE users SET referralCount = referralCount + 1, currentPoints = currentPoints + 10, totalPointsEarned = totalPointsEarned + 10 WHERE id='$referrerUserId'") or die(mysqli_error($sqlConnection));
    }
    echo 1;
?>