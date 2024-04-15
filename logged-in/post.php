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
    <title>Postitus</title>
</head>
<body>
    <p><?php echo $post['sisu']; ?></p>
    <p>Autor: <?php echo $post['kasutaja']['eesnimi'] . ' ' . $post['kasutaja']['perekonnanimi']; ?></p>
    <p><?php echo $post['likes']; ?> Likes</p>
</body>
</html>
