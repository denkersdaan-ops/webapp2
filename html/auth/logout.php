<?php
session_start();
session_unset();
session_destroy(); 

header('Location: ' . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php'));

exit;
?>
