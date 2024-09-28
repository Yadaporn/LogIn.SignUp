<?php
    session_start();
    unset($_SESSION['nowlogin']);
    header('location: login_p.php');
?>