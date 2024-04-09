<?php

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

// Kontrollitakse, kas kasutaja on sisse logitud
if (!isset($_SESSION['kasutaja'])) {
    // Kui kasutaja pole sisse logitud, suunatakse ta tagasi login lehele
    header('Location: ../login.php');
    exit;
}

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$postCollection = $myDatabase->posts;

$posts = $postCollection->find([], ['sort' => ['timestamp' => -1]]); // Sorteerime postitused ajatempli järgi vastupidises järjekorras

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['like'])) {
        $post_id = $_POST['post_id'];
        $postCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectID($post_id)],
            ['$inc' => ['likes' => 1]] // Suurendame "likes" väärtust 1 võrra
        );
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postituste leht</title>
</head>
<body>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?php echo $post['sisu']; ?></p>
            <p>Autor: <?php echo $post['kasutaja']['eesnimi'] . ' ' . $post['kasutaja']['perekonnanimi']; ?></p>
            <form action="like.php" method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post['_id']; ?>">
                <button type="submit" name="like">Like</button>
            </form>
            <p><?php echo $post['likes']; ?> Likes</p>
        </div>
    <?php endforeach; ?>
</body>
</html>
