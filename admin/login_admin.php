<?php

require_once __DIR__ . '/../vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;

$adminKollektsioon = $myDatabase->admins;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $admin = $adminKollektsioon->findOne(['email' => $email, 'password' => $password]);

    if ($admin) {
        $_SESSION['admin'] = true;
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $error = "Vale e-posti aadress või parool. Palun proovi uuesti.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form action="" method="POST">
        <div>
            <label for="email">E-post:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Parool:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <button type="submit">Logi sisse</button>
    </form>
</body>
</html>