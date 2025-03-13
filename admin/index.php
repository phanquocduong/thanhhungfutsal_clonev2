<?php
    session_start();
    if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
        header("Location: /thanhhungfutsal_v2");
        exit();
    }
    require_once('main.php');
?>