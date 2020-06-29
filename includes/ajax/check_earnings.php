<?php
    include("../config.php");
    $userId = $_SESSION['userLoggedIn'];
    $newEarningsQuery = mysqli_query($sqlConnection, "SELECT * FROM earnings_history WHERE userId='$userId' AND isUserAlerted='0'") or die(mysqli_error($sqlConnection));
    $newEarningsArray = array();
    if(mysqli_num_rows($newEarningsQuery) > 0){
        $query = mysqli_query($sqlConnection, "UPDATE earnings_history SET isUserAlerted='1' WHERE userId='$userId' AND isUserAlerted='0'");
        while($row = mysqli_fetch_array($newEarningsQuery)){
            $date = date_create($row['earnedDate']);
            $earnedDate = date_format($date,"Y-m-d");

            $newEarningItem = array(
                "offerwallName" => $row['offerwallName'],
                "amountEarned" => $row['amountEarned'],
                "earnedDate" => $earnedDate
            );
            array_push($newEarningsArray, $newEarningItem);
        }
        echo json_encode($newEarningsArray);
    }else{
        echo json_encode($newEarningsArray);
    }
?>