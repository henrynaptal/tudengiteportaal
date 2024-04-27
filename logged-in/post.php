<?php
require_once __DIR__ . '/../vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$postCollection = $myDatabase->posts;

if (!isset($_GET['id'])) {
    exit('Postituse ID puudub');
}

$post_id = $_GET['id'];
$post = $postCollection->findOne(['_id' => new MongoDB\BSON\ObjectID($post_id)]);

if (!$post) {
    exit('Postitus ei leitud');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="post.css">
    <title>Avalikud projektid</title>
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
                    <a href="edit_profile.php">Muudan andmeid</a>
                    <br>
                    <a href="logout.php">Logi välja</a>
                </div>
            </nav>
        </div>

        <div class="wrapper">
            <aside class="sidebar"></aside>

            <div class="post_container">
                <div class="post_header">
                    <h1>Avalikud projektid</h1>
                </div>

                <p><?php echo $post['sisu']; ?></p>
                <p>Autor: <?php echo $post['kasutaja']['eesnimi'] . ' ' . $post['kasutaja']['perekonnanimi']; ?></p>
                <p><?php echo $post['likes']; ?> Likes</p>


            </div>
        </div>
    </div>

</body>
</html>
