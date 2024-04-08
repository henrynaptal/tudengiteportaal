<?php
session_start();
require_once '../DB/config.php'; // Muuda vastavalt oma MongoDB ühendusele

// Kontrollitakse, kas kasutaja on sisse logitud
if (!isset($_SESSION['kasutaja'])) {
    // Kui kasutaja pole sisse logitud, suunatakse ta tagasi sisselogimise lehele
    header('Location: ../login.php');
    exit;
}

// Kui kasutaja on sisse logitud, võetakse tema nimi sessioonimuutujast
$kasutaja = $_SESSION['kasutaja'];

// Näitame postitusi andmebaasist
$postitused = $postitusteKollektsioon->find();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkedIn Style Feed</title>
    <style>
        .post-container {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
        }
        .post-container img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Postitused</h1>
    
    <?php
    foreach ($postitused as $postitus) {
        echo '<div class="post-container">';
        echo '<p>' . $postitus['sisu'] . '</p>';
        if (isset($postitus['pildid']) && is_array($postitus['pildid'])) {
            foreach ($postitus['pildid'] as $pilt) {
                echo '<img src="' . $pilt . '" alt="Postituse pilt">';
            }
        }
        echo '</div>';
    }
    ?>

    <h2>Postituse lisamine</h2>
    <form action="add_post.php" method="POST" enctype="multipart/form-data">
        <textarea name="sisu" placeholder="Sisu..." required></textarea>
        <br>
        <input type="file" name="pildid[]" multiple accept="image/*">
        <br>
        <input type="submit" value="Postita">
    </form>
    <br>
    <?php
        $viimasedPostitused = $postitusteKollektsioon->find([], ['limit' => 5, 'sort' => ['_id' => -1]]);

        echo '<h2>Viimased 5 postitust:</h2>';
        foreach ($viimasedPostitused as $postitus) {
            echo '<div class="post-container">';
            echo '<p>' . $postitus['sisu'] . '</p>';
            if (isset($postitus['pildid']) && is_array($postitus['pildid'])) {
                foreach ($postitus['pildid'] as $pilt) {
                    echo '<img src="' . $pilt . '" alt="Postituse pilt">';
                }    
            }
            echo '</div>';
        }
    ?>
    <a href="profile.php">Profiil</a>
</body>
</html>
