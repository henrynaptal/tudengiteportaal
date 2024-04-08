<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

// Kontrollitakse, kas kasutaja on sisse logitud
if (!isset($_SESSION['kasutaja'])) {
    // Kui kasutaja pole sisse logitud, suunatakse ta tagasi login lehele
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTI tudengite portaal</title>
</head>
<body>
    <a href="logout.php">Logi välja</a>
</body>
</html>
