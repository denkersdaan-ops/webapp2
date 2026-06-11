<?php 
session_start();

include_once 'dbConection.php';



if(isset($_POST['trip_id']) && isset($_POST['user_id'])){

    $stmt = $pdo->prepare("SELECT period_start, period_end FROM `trip` where id = :trip_id");
    $stmt->bindParam(":trip_id", $_POST["trip_id"]);
    $stmt->execute();
    $trip = $stmt->fetch();

    $stmt = $pdo->prepare("INSERT INTO booking (trip_id, user_id, trip_start, trip_end) Value (:trip_id, :user_id, :trip_start, :trip_end)");
    $stmt->bindParam(':trip_id', $_POST['trip_id']);
    $stmt->bindParam(':user_id', $_POST['user_id']);
    $stmt->bindParam(':trip_start', $trip['period_start']);
    $stmt->bindParam(':trip_end', $trip['period_end']);
    $stmt->execute();
}

header('location: trip.php?trip=' . $_POST['trip_id']);

?>