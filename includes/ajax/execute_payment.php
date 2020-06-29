<?php 
	include("../config.php");
	
	if(!isset($_POST['userId']) || !isset($_POST['amount']) || !isset($_POST['robloxUsername'])){
		echo 2;
		exit();
	}
	
	$userId = $_POST['userId'];
	$amount = $_POST['amount'];
    $robloxUsername = $_POST['robloxUsername'];
	
	$checkAmountQuery = mysqli_query($sqlConnection, "SELECT currentRobuxStock FROM config WHERE id='1'");
	$currStock = mysqli_fetch_array($checkAmountQuery)['currentRobuxStock'];
	if($amount > $currStock){
		echo 6;
		exit();
	}

	$checkAmountQuery = mysqli_query($sqlConnection, "SELECT currentPoints FROM users WHERE id='$userId'");
	$currentUserAmount = mysqli_fetch_array($checkAmountQuery)['currentPoints'];
	if($amount > $currentUserAmount){
		echo 5;
		exit();
	}
	
	$result = file_get_contents("https://api.roblox.com/users/get-by-username?username=$robloxUsername");
	$jsonResult = json_decode($result, true);
	if(isset($jsonResult["success"])){
		if($jsonResult["success"] == false){
			echo 1;
			exit();
		}
	}else{
		$robloxUserId = $jsonResult['Id'];
	}

	// DB Queries
	$groupIdQuery = "SELECT * FROM config WHERE id = '1'";

	// Fetch Results
	$result = mysqli_query($sqlConnection, $groupIdQuery);

	// Fetch Array for Row Variables
	while($row = mysqli_fetch_array($result)){
		$groupId = $row['robuxGroupId'];
		$cookie = $row['cookie'];
	}
	
	$userInGroupResult = file_get_contents("https://assetgame.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=IsInGroup&playerid=$robloxUserId&groupid=$groupId");
	if($userInGroupResult == "<Value Type=\"boolean\">false</Value>"){
		echo 4;
		exit();
	}

	//                                         //
	//-----------! API STARTS HERE !-----------//
	//                                         //

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://www.roblox.com/my/groupadmin.aspx?gid=$groupId");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Cookie: .ROBLOSECURITY='. $cookie,
		'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'
	));

	$response = curl_exec($ch);
	curl_close($ch);

	$a = explode("Roblox.XsrfToken.setToken('", $response)[1];
	$access_token = explode("'", $a)[0];

	// Send request to Roblox with access token
	$ch2 = curl_init();

	curl_setopt($ch2, CURLOPT_URL, "https://www.roblox.com/groups/$groupId/one-time-payout/false");
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch2, CURLOPT_POST, 1);
	curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
		'Cookie: .ROBLOSECURITY='. $cookie,
		'X-CSRF-TOKEN: '. $access_token,
		'Referer: https://www.roblox.com/my/groupadmin.aspx?gid='. $groupId,
		'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36'
	));

	curl_setopt($ch2, CURLOPT_POSTFIELDS, 'percentages={"'. $robloxUserId .'":"'. $amount .'"}');

	$response2 = curl_exec($ch2);
	curl_close($ch2);

	$userQuery = mysqli_query($sqlConnection, "UPDATE users SET currentPoints=currentPoints-$amount WHERE id='$userId'");
	$configQuery = mysqli_query($sqlConnection, "UPDATE config SET currentRobuxStock=currentRobuxStock-$amount WHERE id='1'");
	$withdrawQuery = mysqli_query($sqlConnection, "INSERT INTO withdrawls(userId, robuxUsername, amount) VALUES ('$userId','$robloxUsername','$amount')");

	echo 0;
?>