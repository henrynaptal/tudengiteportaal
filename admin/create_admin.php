<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$adminKollektsioon = $myDatabase->admins;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $admin = $adminKollektsioon->insertOne([
        'email' => $email, 
        'password' => $password
    ]);

    if ($admin) {
        $_SESSION['admin'] = true;
        header('Location: login_admin.php');
        exit;
    } else {
        $error = "Vale e-posti aadress või parool. Palun proovi uuesti.";
    }
}

var_dump($admin);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loo uus admin</title>
</head>
<body>
    <h1>Loo uus admin</h1>
    <form action="" method="POST">
        <div>
            <label for="email">E-post:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Parool:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Loo admin</button>
    </form>
</body>
</html>
