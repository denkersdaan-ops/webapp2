<?php
session_start();
session_unset();
session_destroy(); 

header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
exit;
?>
