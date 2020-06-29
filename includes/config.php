<?php
    if(session_status() == PHP_SESSION_NONE){
        ob_start();
        session_start();
    }

    /*$protocol = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    if (substr($_SERVER['HTTP_HOST'], 0, 4) !== 'www.') {
        header('Location: '.$protocol.'www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit;
    }

    if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
        $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $location);
        exit;
    }*/
	
	function getUserIpAddr(){
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			//ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//ip pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

    //$sqlConnection = mysqli_connect("premium75.web-hosting.com", "therzdph_therobuxuser", "therobuxuser123", "therzdph_therobux");
    $sqlConnection = mysqli_connect("localhost", "root", "", "therobux");
    if(mysqli_connect_errno()){
        echo "Failed to Connect to Server: ".mysqli_connect_errno();
    }
?>