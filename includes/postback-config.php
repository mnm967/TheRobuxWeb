<?php
    ob_start();
    session_start();

    $sqlConnection = mysqli_connect("premium75.web-hosting.com", "therzdph_therobuxuser", "therobuxuser123", "therzdph_therobux");
    //$sqlConnection = mysqli_connect("localhost", "root", "", "withdraw-gg");
    if(mysqli_connect_errno()){
        echo "Failed to Connect to Server: ".mysqli_connect_errno();
    }
?>