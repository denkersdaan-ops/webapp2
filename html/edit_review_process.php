<?php 
session_start();
include_once '../dbConection.php';
if (!isset($_SESSION['is_edit_review.php']) || $_SESSION['is_edit_review.pho'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;}
?>