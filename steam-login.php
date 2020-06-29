<?php
    require_once('includes/config.php');
    include('includes/steamauth/steamauth.php');
    include("includes/classes/Constants.php");
    include("includes/classes/Account.php");

    if(!isset($_SESSION['steamid'])) {
        header("Location: login.php");
    }else{
        include ('includes/steamauth/userInfo.php');
        $sID = $_SESSION['steamid'];
        $username = $_SESSION['steam_personaname'];

        unset($_SESSION['steam_steamid']);
        unset($_SESSION['steam_communityvisibilitystate']);
        unset($_SESSION['steam_profilestate']);
        unset($_SESSION['steam_personaname']);
        unset($_SESSION['steam_lastlogoff']);
        unset($_SESSION['steam_profileurl']);
        unset($_SESSION['steam_avatar']);
        unset($_SESSION['steam_avatarmedium']);
        unset($_SESSION['steam_avatarfull']);
        unset($_SESSION['steam_personastate']);
        unset($_SESSION['steam_realname']);
        unset($_SESSION['steam_primaryclanid']);
        unset($_SESSION['steam_timecreated']);
        unset($_SESSION['steam_uptodate']);

        $account = new Account($sqlConnection);
        $existsCheckQuery = mysqli_query($sqlConnection, "SELECT id FROM users WHERE steam_oauth_id='$sID'");
        if(mysqli_num_rows($existsCheckQuery) > 0){
            $row = mysqli_fetch_array($existsCheckQuery);
            $uid = $row['id'];
			
			/*$currUsernameQuery = mysqli_query($sqlConnection, "SELECT username FROM users WHERE id='$uid'");
			$currUsername = mysqli_fetch_array($currUsernameQuery)['username'];
			if($currUsername == null){
				$updateUsernameQuery = mysqli_query($sqlConnection, "UPDATE users SET username='$username' WHERE id='$uid'");
			}else if($currUsername == "" || empty($currUsername)){
				$updateUsernameQuery = mysqli_query($sqlConnection, "UPDATE users SET username='$username' WHERE id='$uid'");				
			}*/

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
            $registerSuccessful = $account->registerSteam($rID, $sID, $username);
            //echo $registerSuccessful;
            if($registerSuccessful){
                $_SESSION['userLoggedIn'] = $account->getCurrentUserId();
				
				$currUserId = $_SESSION['userLoggedIn'];
				$currentIpAddress = getUserIpAddr();
				$ipUpdateQuery = mysqli_query($sqlConnection, "UPDATE users SET ipAddress='$currentIpAddress' WHERE id='$currUserId'");
				
                if(isset($_SESSION['rid'])) unset($_SESSION['rid']);
                header("Location: earn.php");
            }
        }
    }
?>