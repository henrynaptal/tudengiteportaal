<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();
if (!isset($_SESSION['kasutaja'])) {
    header('Location: ../login.php');
    exit;
}

$databaseConnection = new MongoDB\Client(
    'mongodb+srv://Tenso:Dti2023@cluster0.v10lvza.mongodb.net/?tls=true&tlsCAFile=C%3A%5Cxampp%5Capache%5Cbin%5Ccurl-ca-bundle.crt'
);

$myDatabase = $databaseConnection->DTI_Database;
$postCollection = $myDatabase->posts;

$kasutaja = $_SESSION['kasutaja'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['kasutaja'])) {
    $kasutaja = $_SESSION['kasutaja'];
    $sisu = $_POST['sisu'];

    $postCollection->insertOne([
        'kasutaja' => $kasutaja,
        'sisu' => $sisu,
        'likes' => 0, 
        'timestamp' => new MongoDB\BSON\UTCDateTime()
    ]);

    header('Location: portfolio.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/d90f70bb05.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="add_post.css">
        <title>Postituse loomine</title>
    </head>

    <body>
        <div class="container">

            <div class="header">
                <nav class="navbar">
                    <ul>
                        <a href="home.php"><img src="https://www.tlu.ee/sites/default/files/2018-05/DTI-est_2.svg" class ="logo" alt="Tallinna Ülikool"></a>
                        <li><a href="posts.php">Projektid</a></li>
                        <li><a href="news.php">Uudised</a></li>
                        <li><a href="schedule.php">Tunniplaan</a></li>
                        <li><a href="portfolio.php">Minu portfoolio</a></li>
                    </ul>

                    <div class="username">
                        <p><?php echo $kasutaja->offsetGet('eesnimi') . " " . $kasutaja->offsetGet('perekonnanimi');?> </p>
                        <div class="icons">
                            <div class="data">
                                <a href="edit_profile.php"><i class="fa-solid fa-gear" style="color: #6bcaba;"></i></a>
                            </div>

                            <div class="out">
                                <a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #6bcaba;"></i></a>
                            </div>
                        </div>
                        
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

                        <div class="buttons">
                            <div class="back_box">
                                <input type="submit" name="go_back" id="go_back" class="back-submit" href="javascript:history.go(-1)" value="Katkestan"/>
                            </div>

                            <div class="post_box">
                                <input type="submit" name="upload" id="upload" class="input-submit" value="Postitan"/>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
