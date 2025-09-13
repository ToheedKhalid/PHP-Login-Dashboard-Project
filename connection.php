<?php
error_reporting(0);
session_start();


$host = "localhost";
$dbname = "user_auth";
$username = "root";   // apna mysql username likho
$password = null;       // apna mysql password likho

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
