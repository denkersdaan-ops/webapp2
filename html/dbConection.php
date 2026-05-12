<?php
$host = "db";              // de Docker service-naam!
$dbname = "mydatabase";    // uit jouw docker-compose
$username = "user";        // MYSQL_USER
$password = "password";    // MYSQL_PASSWORD

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo "Database fout: " . $e->getMessage();
}

?>