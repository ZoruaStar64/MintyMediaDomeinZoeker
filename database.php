<?php
// Zet hier uw database connectie credentials neer.
$servername = "";
$dbname = "";
$username = "";
$password = "";

try {
    $pdo = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

