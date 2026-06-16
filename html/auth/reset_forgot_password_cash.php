<?php
    session_start();

    unset($_SESSION['verification_email']);
    unset($_SESSION['email_verified']);
    unset($_SESSION['code_verified']);

    header('Location: ' .(isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
?>