<?php

require_once __DIR__ . '/vendor/autoload.php';

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;

$userCollection = $myDatabase->users;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eesnimi = $_POST['fname'];
    $perekonnanimi = $_POST['lname'];
    $email = $_POST['email'];
    $parool = sha1($_POST['password']);

    $kasutaja_id = uniqid();

    $userCollection->insertOne([
        '_id' => $kasutaja_id,
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
        <link rel="stylesheet" href="signup.css">
        <title>DTI tudengite portaal - loo kasutaja</title>
    </head>

    <body>
        <div class="wrapper">
            <div class="signup_container">
                <div class="signup-header">
                    <span>Tallinna Ülikooli Digitehnoloogiate Instituudi tudengiportaal<span>
                </div>

                <p>Loo kasutaja<p>
                <br>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="input_box">
                        <input type="text" placeholder="Eesnimi" name="fname" id="fname" class="input-field" required="" />
                    </div>

                    <br>

                    <div class="input_box">
                        <input type="text" placeholder="Perekonnanimi" name="lname" id="lname" class="input-field" required="" />
                    </div>

                    <br>

                    <div class="input_box">
                        <input type="text" placeholder="E-post" name="email" id="email" class="input-field" required="" />
                    </div>

                    <br>

                    <div class="input_box">
                        <input type="password" placeholder="Parool" name="password" id="password" class="input-field" required="" />
                    </div>

                    <br>

                    <div class="signup_box">
                        <input type="submit" name="signup" id="signup" class="input-submit" value="Loo konto" />
                    </div>
                    
                </form>

                <div class="go_login">
                    <a href="login.php">Konto juba olemas? Vajuta siia, et sisse logida!</a>
                </div>
                
            </div>
        </div>
    </body>
</html>
