<?php

session_start();

$dsn  = 'mysql:host=localhost;dbname=webapi';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
	$dsn, 
	$user, 
	$pass,
	array(
	    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_EMULATE_PREPARES => false,
        )
    );
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

function insert() {
    global $pdo;
    $reserve_code = 111111;
    
    $sql = 'INSERT INTO reserved (name, email, reserve_code) VALUES (:name, :email, :reserve_code)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_SESSION['name'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->bindParam(':reserve_code', $reserve_code, PDO::PARAM_INT);
    
    session_destroy();
    
    $stmt->execute();
    
    return $reserve_code;
}