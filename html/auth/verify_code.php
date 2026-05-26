<?php
session_start();

include_once '../dbConection.php';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $_SESSION['verification_email'] = $email;
    $_SESSION['email_verified'] = true;
} else {
    if(!isset($_SESSION['verification_email'])) {
        $_SESSION['error'] = "Email is required to send verification code.";   
    }
}
if (!isset($_POST['code'])) {
    // If there's no verification code in the session, redirect to the forgot password page
    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
    exit;

}

$code = trim($_POST['code']);
if ($code === '1234') {
    $_SESSION['code_verified'] = true;
} else {
    $_SESSION['error'] = "Invalid verification code.";
}

header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));




?>