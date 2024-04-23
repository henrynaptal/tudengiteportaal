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
$postCollection = $myDatabase->posts;

$kasutaja = $_SESSION['kasutaja'];
$kasutajaId = $kasutaja['_id'];

$posts = $postCollection->find(['kasutaja._id' => $kasutajaId], ['sort' => ['timestamp' => -1]]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['like'])) {
        $post_id = $_POST['post_id'];
        $postCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($post_id)],
            ['$inc' => ['likes' => 1]]
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="portfolio.css">
    <title>Minu portfoolio</title>
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

                <div class="portfolio_container">
                    <div class="portfolio_header">
                        <h1>Portfoolio</h1>
                    </div>
                    <a href="add_post.php">Lisan uue projekti</a>
                </div>
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                    <p><?php echo $post['sisu']; ?></p>
                    <p>Autor: <?php echo $post['kasutaja']['eesnimi'] . ' ' . $post['kasutaja']['perekonnanimi']; ?></p>
                    <a href="post.php?id=<?php echo $post['_id']; ?>"><button type="button">Vaata rohkem</button></a>
                        <form>
                            <input type="hidden" name="post_id" value="<?php echo $post['_id']; ?>">
                        </form>
                    <p id="likes_<?php echo $post['_id']; ?>"><?php echo $post['likes']; ?> Likes</p> 
                    </div>
                <?php endforeach; ?>
            </div>  
        </div>

    </body>
</html>