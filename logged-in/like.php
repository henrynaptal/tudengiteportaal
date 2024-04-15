<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($_SESSION['kasutaja'])) {
    exit('Kasutaja pole sisselogitud');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    $databaseConnection = new MongoDB\Client(
        'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
    );

    $myDatabase = $databaseConnection->DTI_Database;
    $postCollection = $myDatabase->posts;

    $post_id = $_POST['post_id'];
    $postCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($post_id)],
        ['$inc' => ['likes' => 1]]
    );


    $post = $postCollection->findOne(['_id' => new MongoDB\BSON\ObjectID($post_id)]);
    echo $post['likes'];
} else {
    exit('Vigane päring');
}
?>
