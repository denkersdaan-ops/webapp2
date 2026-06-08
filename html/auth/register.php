<?php
session_start();
include_once '../dbConection.php';

if (isset($_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['name'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $name = trim($_POST['name']);

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $_SESSION['error'] = "Email is already registered.";
        header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO user (name,email, password) VALUES (:name, :email, :password)");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();


    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
} else {
    $_SESSION['error'] = "Please fill in all fields.";
}
header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
exit;
?>