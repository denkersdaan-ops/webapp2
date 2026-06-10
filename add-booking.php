<?php 
session_start();

include_once 'dbConection.php';

if(isset($_POST['trip_id']) && isset($_POST['user_id']) && isset($_POST['trip_start'])&& isset($_POST['trip_end'])){
    $stmt = $pdo->prepare("INSERT INTO booking (trip_id, user_id, trip_start, trip_end) Value (:trip_id, :user_id, trip_start, trip_end)");
    $stmt->bindParam(':trip_id', $_POST['trip_id'], PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_POST['user_id']);
    $stmt->bindParam(':trip_start', $_POST['trip_start']);
    $stmt->bindParam(':trip_start', $_POST['trip_start']);
}

?>