<?php
    $db_host = 'localhost';
    $db_name = 'spacjaro';
    $db_user = 'spacjaro';
    $db_password = 'webove aplikace';

    $dsn = "mysql:host=$db_host;dbname=$db_name";

    try {
        $pdo = new PDO($dsn, $db_user, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // TODO: Add an error page - header("Location: ./error.php");
        die('Connection failed: ' . $e->getMessage());
    }
?>
