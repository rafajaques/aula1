<?php
    # verifica_login.php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location:/login');
        die;
    }