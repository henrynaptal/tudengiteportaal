<?php
require_once __DIR__ . '/../vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$postCollection = $myDatabase->posts;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['kasutaja'])) {
    $kasutaja_id = $_SESSION['kasutaja']['_id'];
    $sisu = $_POST['sisu'];

    $postCollection->insertOne([
        'kasutaja' => $kasutaja,
        'kasutaja_id' => $kasutaja_id,
        'sisu' => $sisu,
        'likes' => 0, 
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);

    header('Location: home.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postituse loomine</title>
</head>
<body>
    <h2>Postituse loomine</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <textarea name="sisu" id="sisu" cols="30" rows="10" placeholder="Sisesta siia oma postituse sisu"></textarea>
        <br>
        <input type="submit" name="submit" value="Postita">
    </form>
</body>
</html>
