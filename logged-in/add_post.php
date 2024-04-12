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
        <link rel="stylesheet" href="add_post.css">
        <title>Postituse loomine</title>
    </head>

    <body>
        <div class="container">

            <div class="header">
                <nav class="navbar">
                    <ul>
                        <a href="home.php"><img src="https://www.tlu.ee/sites/default/files/2018-05/DTI-est_2.svg" class ="logo" alt="Tallinna Ülikool"></a>
                        <li><a href="news.php">Uudised</a></li>
                        <li><a href="schedule.php">Tunniplaan</a></li>
                        <li><a href="portfolio.php">Minu portfoolio</a></li>
                    </ul>

                    <div class="username">
                        <p>Heli Kopter</p>
                        <a href="edit_profile.php">Muudan andmeid</a>
                    </div>
                </nav>
            </div>

            <div class="wrapper">
                <aside class="sidebar"></aside>

                <div class="post_container">
                    <div class="post_header">
                        <h1>Lae üles uus projekt</h1>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="input_box">
                            <textarea name="sisu" id="sisu" cols="30" rows="10" placeholder="Sisesta siia oma postituse sisu"></textarea>
                        </div>

                        <br>

                        <div class="post_box">
                            <input type="submit" name="upload" id="upload" class="input-submit" value="Postitan"/>
                        </div>

                        <p><a href="javascript:history.go(-1)" title="Return to previous page">Tagasi</a></p>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
