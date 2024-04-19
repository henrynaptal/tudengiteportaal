<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit;
}

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$uudisteKollektsioon = $myDatabase->news;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = "TLÜ";

    $uudisteKollektsioon->insertOne([
        'title' => $title,
        'content' => $content,
        'author' => $author,
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);

    /*if ($result->getInsertedCount() === 1) {
        echo "Uus postitus on edukalt loodud.";
    } else {
        echo "Midagi läks valesti, postituse loomine ebaõnnestus.";
    }*/

    //var_dump($uudisteKollektsioon);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loo uus postitus</title>
</head>
<body>
    <h1>Loo uus postitus</h1>
    <form action="" method="POST">
        <div>
            <label for="title">Pealkiri:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <br>
        <div>
            <label for="content">Sisu:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <button type="submit">Loo postitus</button>
    </form>
</body>
</html>