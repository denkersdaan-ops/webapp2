<?php
    session_start();

    include_once 'dbConection.php';

    if(isset($_POST['trip_id']) && isset($_POST['user_id']) && isset($_POST['review'])&& isset($_POST['rate'])){
        $stmt = $pdo->prepare("INSERT INTO review (trip_id, user_id, rating , comment, post_date) Value (:trip_id, :user_id, :rating ,:comment, :post_date)");
        $stmt->bindParam(':trip_id', $_POST['trip_id'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_POST['user_id']);
        $stmt->bindParam(':comment', $_POST['review']);
        $stmt->bindparam(':rating', $_POST['rate']);
        $date = gmdate('Y-m-d', time());
        $stmt->bindParam(':post_date', $date);
        $stmt->execute();
    }

    if(isset($_POST['trip_id'])){
        header('location: trip.php?trip=' . $_POST['trip_id']);
    }else{
        header('location: index.php');
    }
    exit;
?>