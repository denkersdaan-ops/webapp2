<?php
session_start();
include_once '../dbConection.php';

if((!isset($_SESSION['email_verified']) || !$_SESSION['email_verified']) && (!isset($_SESSION['code_verified']) || !$_SESSION['code_verified'])) {
    $_SESSION['error'] = "Please verify your email before resetting your password.";
    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
    exit;
}

if (isset($_POST['new_password'], $_POST['confirm_new_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_new_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
        exit;
    }

    $email = $_SESSION['verification_email'] ?? null;
    if (!$email) {
        $_SESSION['error'] = "No email found for password reset.";
        header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
        exit;
    }

    $stmt = $pdo->prepare("UPDATE user SET password = :password WHERE email = :email");
    $stmt->bindParam(':password', $newPassword, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Clear verification session variables after successful password reset
    unset($_SESSION['verification_email']);
    unset($_SESSION['email_verified']);
    unset($_SESSION['code_verified']);

    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
    exit;

} else {
    $_SESSION['error'] = "Please fill in all fields.";
    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
    exit;
}


?>