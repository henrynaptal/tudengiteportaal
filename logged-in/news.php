<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
if (!isset($_SESSION['kasutaja'])) {
    header('Location: ../login.php');
    exit;
}

$kasutaja = $_SESSION['kasutaja'];

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$uudisteKollektsioon = $myDatabase->news;

$uudised = $uudisteKollektsioon->find([], ['sort' => ['timestamp' => -1]]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d90f70bb05.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="news.css">
    <title>Uudised</title>
</head>
    <body>
        <div class="container">

            <div class="header">
                <nav class="navbar">
                    <ul>
                        <a href="home.php"><img src="https://www.tlu.ee/sites/default/files/2018-05/DTI-est_2.svg" class ="logo" alt="Tallinna Ülikool"></a>
                        <li><a href="posts.php">Projektid</a></li>
                        <li><a href="news.php">Uudised</a></li>
                        <li><a href="schedule.php">Tunniplaan</a></li>
                        <li><a href="portfolio.php">Minu portfoolio</a></li>
                    </ul>

                    <div class="username">
                        <p><?php echo $kasutaja->offsetGet('eesnimi') . " " . $kasutaja->offsetGet('perekonnanimi');?></p>
                        <div class="icons">
                            <div class="data">
                                <a href="edit_profile.php"><i class="fa-solid fa-gear" style="color: #6bcaba;"></i></a>
                            </div>

                            <div class="out">
                                <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #6bcaba;"></i></a>
                            </div>
                        </div>
                        
                    </div>
                </nav>

            </div>


            <div class="wrapper">
                <aside class="sidebar"></aside>

                <div class="news_container">
                    <div class="news_header">
                        <h1>Uudised</h1>
                    </div>

                    <?php foreach ($uudised as $uudis): ?>
                        <div class="news">
                            <h2><?php echo $uudis['title']; ?></h2>
                            <p><?php echo date('d.m.Y H:i', $uudis['timestamp']->toDateTime()->getTimestamp()); ?></p>
                            <p><?php echo $uudis['content']; ?></p>
                            <div class="author">
                                <p>Autor: <?php echo $uudis['author']; ?></p>
                            </div>
                            
                            
                        </div>
                    <?php endforeach; ?>

                    

                </div>
            </div>
        </div>

    </body>
</html>