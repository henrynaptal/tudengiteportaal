<?php

require_once __DIR__ . '/vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;

$userCollection = $myDatabase->users;

// Kontrolli, kas vormi on postitatud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Võtke vormist kasutaja sisestatud andmed
    $email = $_POST['email'];
    $parool = $_POST['password'];

    // Otsi kasutajat andmebaasist, kellel on antud email ja parool
    $query = ['email' => $email, 'parool' => $parool];
    $user = $collection->findOne($query);

    // Kontrolli, kas kasutaja on leitud
    if ($user) {
        // Kui kasutaja on leitud, siis võite teha vajalikud toimingud, näiteks määrata sessioonimuutujad ja suunata nad profiililehele
        session_start();
        $_SESSION['kasutaja'] = $user;
        header('Location: profile.php');
        exit;
    } else {
        // Kui kasutajat ei leitud, kuvatakse sõnum
        $error_message = "Vale kasutajanimi või parool!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTI tudengite portaal - Logi sisse</title>
</head>
<body>
    <h2>Logi sisse</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="text" placeholder="Email" name="email" id="email" required=""/>
        <br>
        <input type="password" placeholder="Parool" name="password" id="password" required=""/>
        <br>
        <input type="submit" name="login" id="login" value="Logi sisse"/>
    </form>

    <p><?php if(isset($error_message)) echo $error_message; ?></p>

    <a href="signup.php">Kas sul pole kontot? Registreeru</a>
</body>
</html>
