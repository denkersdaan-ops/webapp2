<?php
session_start();
include_once '../dbConection.php';

$stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email and password = :password");
$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

header('Location: ' .(isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
$_SESSION['user_id'] = $user['id'];
exit;
