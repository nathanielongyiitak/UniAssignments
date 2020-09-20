<?php 

$hostname = 'localhost';
$dbname = 'online_activity_registration_system';
$uname = 'root';
$pw = '';

try {

    $pdo = new PDO("mysql:host={$hostname};dbname={$dbname}", $uname, $pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // echo "Database connected successfully";
    
} catch (PDOException $ex) {

    die($ex->getMessage()());
    
}