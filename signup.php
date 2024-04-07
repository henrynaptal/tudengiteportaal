<?php

require_once __DIR__ . '/vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

//connecting to specific database in mongoDB
$myDatabase = $databaseConnection->DTI_Database;

//connecting to our mongoDB Collections
$userCollection = $myDatabase->users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eesnimi = $_POST['fname'];
    $perekonnanimi = $_POST['lname'];
    $email = $_POST['email'];
    $parool = sha1($_POST['password']);

    $userCollection->insertOne([
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
        <input type="text" placeholder="Eesnimi" name="fname" id="fname" required="" />
        <br>
        <input type="text" placeholder="Perekonnanimi" name="lname" id="lname" required="" />
        <br>
        <input type="text" placeholder="Email" name="email" id="email" required="" />
        <br>
        <input type="text" placeholder="Parool" name="password" id="password" required="" />
        <br>
        <input type="submit" name="signup" id="signup" value="Registreeru" />
    </form>

    <a href="login.php">Kas sul on konto juba olemas? Logi sisse</a>
</body>

</html>