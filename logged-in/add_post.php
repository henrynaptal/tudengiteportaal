<?php
session_start();
require_once '../DB/config.php'; // Muuda vastavalt oma MongoDB ühendusele

// Kontrollitakse, kas kasutaja on sisse logitud
if (!isset($_SESSION['kasutaja'])) {
    // Kui kasutaja pole sisse logitud, suunatakse ta tagasi sisselogimise lehele
    header('Location: /../login.php');
    exit;
}

// Kui kasutaja on sisse logitud, võtame tema nime ja ID sessioonimuutujast
$kasutaja_nimi = $_SESSION['kasutaja']['nimi'];
$kasutaja_id = $_SESSION['kasutaja']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sisu = $_POST['sisu'];

    // Salvestame postituse andmebaasi koos kasutaja ID-ga
    $postitus = [
        'kasutaja_id' => $kasutaja_id,
        'kasutaja_nimi' => $kasutaja_nimi,
        'sisu' => $sisu,
        'pildid' => []
    ];

    // Käsitleme üleslaetud pilte
    if (!empty($_FILES['pildid']['name'][0])) {
        $uploadDir = 'uploads/';
        $uploadedFiles = [];
        foreach ($_FILES['pildid']['name'] as $key => $fileName) {
            $tmpName = $_FILES['pildid']['tmp_name'][$key];
            $targetFilePath = $uploadDir . basename($fileName);
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $uploadedFiles[] = $targetFilePath;
            }
        }
        $postitus['pildid'] = $uploadedFiles;
    }

    // Salvestame postituse andmebaasi
    $postitusteKollektsioon->insertOne($postitus);

    // Suuname kasutaja tagasi avalehele
    header('Location: index.php');
    exit;
}
?>
