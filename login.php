<?php

require_once __DIR__ . '/vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;

$userCollection = $myDatabase->users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $parool = sha1($_POST['password']);

    $query = ['email' => $email, 'parool' => $parool];
    $user = $userCollection->findOne($query);

    if ($user) {
        session_start();
        $_SESSION['kasutaja'] = $user;
        header('Location: logged-in/profile.php');
        exit;
    } else {
        $error_message = "Vale kasutajanimi või parool!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <title>DTI tudengite portaal - logi sisse</title>
    </head>

    <body>

        <div class="wrapper">
            <div class="login_container">
                <div class="login-header">
                    <span>Tallinna Ülikooli Digitehnoloogiate Instituudi tudengiportaal<span>
                </div>

                <p>Logi sisse<p>
                <br>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="input_box">
                        <input type="text" placeholder="E-post" name="email" id="email" class="input-field" required="" />
                    </div>

                    <br>

                    <div class="input_box">
                        <input type="password" placeholder="Parool" name="password" id="password" class="input-field" required="" />
                    </div>

                    <br>

                    <div class="login_box">
                        <input type="submit" name="login" id="login" class="input-submit" value="Logi sisse" />
                    </div>

                </form>

                <p><?php if(isset($error_message)) echo $error_message; ?></p>

                <a href="signup.php">Ei ole kontot? Vajuta siia!</a>
            </div>
        </div>
    </body>
</html>
