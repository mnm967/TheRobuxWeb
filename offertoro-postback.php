<?php 
    include("includes/postback-config.php");

    $validIps = array();
    array_push($validIps, "54.175.173.245");

    if(!in_array($_SERVER['REMOTE_ADDR'], $validIps)){
		exit();
    }

    $userId = $_GET['user_id'];
    $amount = $_GET['amount'];
    $userIpAddress = $_GET['ip_address'];
    $currencyName = $_GET['currency_name'];
    $oid = $_GET['oid'];
    $payout = $_GET['payout'];
    $transactionId = $_GET['id'];
    $sig = $_GET['sig'];

    $mySig = md5("$oid-$userId-42ad92284fc620b49b7969eccecd7b92");
    if($sig != $mySig){
        echo 0;
		exit();
    }

    $newTransQuery = mysqli_query($sqlConnection, "SELECT id FROM earnings_history WHERE transactionId='$transactionId' AND offerwallName='Offertoro'");
    if(mysqli_num_rows($newTransQuery) > 0){
        echo 1;
		exit();
    }

    $userHistoryQuery = mysqli_query($sqlConnection, "INSERT INTO earnings_history (userId, offerId, offerwallName, amountEarned, transactionId, ipAddress) VALUES('$userId', '$oid', 'Offertoro', '$amount', '$transactionId', '$userIpAddress')") or die(mysqli_error($sqlConnection));
    $earnId = mysqli_insert_id($sqlConnection);

    $adminEarningsQuery = mysqli_query($sqlConnection, "INSERT INTO admin_earnings (userId, earnId, offerwallName, amount) VALUES('$userId', '$earnId', 'Offertoro', '$payout')") or die(mysqli_error($sqlConnection));
    
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