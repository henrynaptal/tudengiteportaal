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

$tunniplaaniKollektsioon = $myDatabase->tunniplaan;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aine = $_POST['aine'];
    $oppejoud = $_POST['oppejoud'];
    $algusaeg = $_POST['algusaeg'];
    $loppaeg = $_POST['loppaeg'];
    $nadalapaev = $_POST['nadalapaev'];

    $tunniplaaniKollektsioon->insertOne([
        'aine' => $aine,
        'oppejoud' => $oppejoud,
        'algusaeg' => $algusaeg,
        'loppaeg' => $loppaeg,
        'nadalapaev' => $nadalapaev
    ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>Uudis:</h1>
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
    <br>
    <h1>Tunniplaan:</h1>
    <form action="" method="POST">
        <div>
            <label for="aine">Aine:</label>
            <input type="text" id="aine" name="aine" required>
        </div>
        <br>
        <div>
            <label for="oppejoud">Õppejõud:</label>
            <input type="text" id="oppejoud" name="oppejoud" required>
        </div>
        <br>
        <div>
            <label for="algusaeg">Algusaeg:</label>
            <input type="text" id="algusaeg" name="algusaeg" required>
        </div>
        <br>
        <div>
            <label for="loppaeg">Lõppaeg:</label>
            <input type="text" id="loppaeg" name="loppaeg" required>
        </div>
        <br>
        <div>
            <label for="nadalapaev">Nädalapäev:</label>
            <input type="text" id="nadalapaev" name="nadalapaev" required>
        </div>
        <br>
        <button type="submit">Loo tunniplaan</button>
    </form>
</body>
</html>
