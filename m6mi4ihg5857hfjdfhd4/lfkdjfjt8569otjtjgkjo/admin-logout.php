<?php
    include("includes/config.php");
    session_destroy();
    header("Location: admin-login.php");
?>