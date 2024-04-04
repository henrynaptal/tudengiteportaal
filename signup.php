<?php

require 'vendor/autoload.php'; // Laadige Composeri loodud autoload fail

use MongoDB\Client as MongoClient;

// ühendusstring
$connectionString = "mongodb://<kasutajanimi>:<parool>@<andmebaasi_host>:<port>/<andmebaasi_nimi>";

// loon MongoDB kliendi
$client = new MongoClient($connectionString);

// valin andmebaasi
$database = $client->selectDatabase('<andmebaasi_nimi>');

// valin kollektsiooni (tabel), kus kasutajate andmed on salvestatud
$collection = $database->selectCollection('<kasutajate_kollektsiooni_nimi>');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eesnimi = $_POST['fname'];
    $perekonnanimi = $_POST['lname'];
    $email = $_POST['email'];
    $parool = $_POST['password'];

    $collection->insertOne([
        'eesnimi' => $eesnimi,
        'perekonnanimi' => $perekonnanimi,
        'email' => $email,
        'parool' => $parool
    ]);

    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTI tudengite portaal</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="text" placeholder="Eesnimi" name="fname" id="fname" required=""/>
        <br>
        <input type="text" placeholder="Perekonnanimi" name="lname" id="lname" required=""/>
        <br>
        <input type="text" placeholder="Email" name="email" id="email" required=""/>
        <br>
        <input type="text" placeholder="Parool" name="password" id="password" required=""/>
        <br>
        <input type="submit" name="signup" id="signup" value="Registreeru"/>
    </form>

    <a href="login.php">Kas sul on konto juba olemas? Logi sisse</a>
</body>
</html>
