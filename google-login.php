<?php
    require_once('includes/config.php');
    require_once('includes/google-api-config.php');
    include("includes/classes/Constants.php");
    include("includes/classes/Account.php");

    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
        
        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
        $oauth_id =  $google_account_info->id;

        $client->revokeToken();

        $account = new Account($sqlConnection);
        $idCheckQuery = mysqli_query($sqlConnection, "SELECT id FROM users WHERE google_oauth_id='$oauth_id'");
        if(mysqli_num_rows($idCheckQuery) > 0){
            $row = mysqli_fetch_array($idCheckQuery);
            $uid = $row['id'];

            $_SESSION['userLoggedIn'] = $uid;
			
			$currUserId = $_SESSION['userLoggedIn'];
			$currentIpAddress = getUserIpAddr();
			$ipUpdateQuery = mysqli_query($sqlConnection, "UPDATE users SET ipAddress='$currentIpAddress' WHERE id='$currUserId'");
			
            header("Location: earn.php");
        }else{
            $emailCheckQuery = mysqli_query($sqlConnection, "SELECT id FROM users WHERE email='$email'");
            if(mysqli_num_rows($emailCheckQuery) > 0){
                $row = mysqli_fetch_array($emailCheckQuery);
                $uid = $row['id'];
				$userUpdateQuery = mysqli_query($sqlConnection, "UPDATE users SET google_oauth_id='$oauth_id', isGoogleConnected=1 WHERE id='$uid'");

                $_SESSION['userLoggedIn'] = $uid;
				
				$currUserId = $_SESSION['userLoggedIn'];
				$currentIpAddress = getUserIpAddr();
				$ipUpdateQuery = mysqli_query($sqlConnection, "UPDATE users SET ipAddress='$currentIpAddress' WHERE id='$currUserId'");
				
                header("Location: earn.php");
            }else{
                if(isset($_SESSION['rid'])){
                    $rID = $_SESSION['rid'];
                }else{
                    $rID = -1;
                }
                $registerSuccessful = $account->registerGoogle($rID, $oauth_id, $email);
                //echo $registerSuccessful;
                if($registerSuccessful){
                    $_SESSION['userLoggedIn'] = $account->getCurrentUserId();
					
					$currUserId = $_SESSION['userLoggedIn'];
					$currentIpAddress = getUserIpAddr();
					$ipUpdateQuery = mysqli_query($sqlConnection, "UPDATE users SET ipAddress='$currentIpAddress' WHERE id='$currUserId'");
					
                    if(isset($_SESSION['rid'])) unset($_SESSION['rid']);
                    header("Location: username.php");
                }
            }
        }
    }else{
        header("Location: login.php");
    }
?>