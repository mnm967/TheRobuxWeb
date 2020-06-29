<?php
    include("includes/config.php");
    if(!isset($_SESSION['adminLoggedIn'])){
        header("Location: admin-login.php");
    }else{
        header("Location: admin-dashboard.php");
    }
?>